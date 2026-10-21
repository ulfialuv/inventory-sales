<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Daftar transaksi Admin dan Staff
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'search' => ['nullable', 'string', 'max:255'],
        ]);

        $sales = Sale::with(['user', 'items.product'])
            ->when($request->filled('start_date'), function ($query) use ($request) {
                $query->whereDate('sale_date', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                $query->whereDate('sale_date', '<=', $request->end_date);
            })
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        if (auth()->user()->role === 'staff') {
            return view('staff.sales.index', compact('sales'));
        }

        return view('sales.index', compact('sales'));
    }

    /*
    |--------------------------------------------------------------------------
    | Form transaksi penjualan Admin dan Staff
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('sales.create', compact('products'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan transaksi penjualan Admin dan Staff
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sale_date' => ['required', 'date'],
            'notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => [
                'required',
                'distinct',
                'exists:products,id',
            ],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        DB::transaction(function () use ($validated) {
            $sale = Sale::create([
                'user_id' => auth()->id(),
                'invoice_number' => $this->generateInvoiceNumber(),
                'sale_date' => $validated['sale_date'],
                'total' => 0,
                'notes' => $validated['notes'] ?? null,
                'payment_method' => 'cash',
                'payment_status' => 'paid',
                'order_status' => 'completed',
            ]);

            $total = 0;

            foreach ($validated['items'] as $item) {
                $product = Product::whereKey($item['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $quantity = (int) $item['quantity'];

                if ($product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'items' => "Stok {$product->name} tidak mencukupi. Stok tersedia: {$product->stock}.",
                    ]);
                }

                $price = (float) $product->selling_price;
                $subtotal = $price * $quantity;

                $sale->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'selling_price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $quantity);
                $total += $subtotal;
            }

            $sale->update(['total' => $total]);
        });

        return redirect()->route('sales.index')
            ->with('success', 'Transaksi penjualan berhasil. Stok produk sudah dikurangi.');
    }

    /*
    |--------------------------------------------------------------------------
    | Konfirmasi pembayaran oleh Admin dan Staff
    |--------------------------------------------------------------------------
    */

    public function confirmPayment(Sale $sale)
    {
        $result = DB::transaction(function () use ($sale) {
            $sale = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($sale->order_status === 'cancelled') {
                return 'cancelled';
            }

            if ($sale->payment_status === 'paid') {
                return 'already_paid';
            }

            if (
                $sale->payment_method === 'transfer'
                && empty($sale->transfer_proof)
            ) {
                return 'no_proof';
            }

            $sale->update([
                'payment_status' => 'paid',
                'order_status' => 'completed',
            ]);

            return 'success';
        });

        if ($result === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat dikonfirmasi.');
        }

        if ($result === 'already_paid') {
            return back()->with('error', 'Pembayaran pesanan ini sudah dikonfirmasi lunas.');
        }

        if ($result === 'no_proof') {
            return back()->with('error', 'Bukti transfer belum diunggah oleh pembeli.');
        }

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi. Pesanan sekarang berstatus selesai.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Batalkan pesanan Admin dan Staff
    |--------------------------------------------------------------------------
    */

    public function cancelOrder(Sale $sale)
    {
        $result = DB::transaction(function () use ($sale) {
            $sale = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($sale->order_status === 'cancelled') {
                return 'already_cancelled';
            }

            if (
                $sale->payment_status === 'paid'
                || $sale->order_status === 'completed'
            ) {
                return 'already_completed';
            }

            $items = $sale->items()->get();

            foreach ($items as $item) {
                $product = Product::whereKey($item->product_id)
                    ->lockForUpdate()
                    ->first();

                if ($product) {
                    $product->increment('stock', (int) $item->quantity);
                }
            }

            $sale->update([
                'order_status' => 'cancelled',
            ]);

            return 'success';
        });

        if ($result === 'already_cancelled') {
            return back()->with('error', 'Pesanan ini sudah dibatalkan sebelumnya.');
        }

        if ($result === 'already_completed') {
            return back()->with(
                'error',
                'Pesanan yang sudah selesai atau lunas tidak dapat dibatalkan melalui fitur ini.'
            );
        }

        return back()->with(
            'success',
            'Pesanan berhasil dibatalkan dan stok produk sudah dikembalikan.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Batalkan pesanan milik Pembeli sendiri
    |--------------------------------------------------------------------------
    */

    public function cancelMyOrder(Sale $sale)
    {
        $result = DB::transaction(function () use ($sale) {
            $order = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ((int) $order->user_id !== (int) auth()->id()) {
                abort(403, 'Kamu tidak memiliki akses ke pesanan ini.');
            }

            if ($order->order_status === 'cancelled') {
                return 'already_cancelled';
            }

            if (
                $order->payment_status === 'paid'
                || $order->order_status === 'completed'
            ) {
                return 'already_completed';
            }

            if ($order->order_status !== 'pending') {
                return 'not_pending';
            }

            $items = $order->items()->get();

            foreach ($items as $item) {
                $product = Product::whereKey($item->product_id)
                    ->lockForUpdate()
                    ->first();

                if ($product) {
                    $product->increment('stock', (int) $item->quantity);
                }
            }

            $order->update([
                'order_status' => 'cancelled',
            ]);

            return 'success';
        });

        if ($result === 'already_cancelled') {
            return back()->with('error', 'Pesanan ini sudah dibatalkan sebelumnya.');
        }

        if ($result === 'already_completed') {
            return back()->with(
                'error',
                'Pesanan yang sudah lunas atau selesai tidak dapat dibatalkan.'
            );
        }

        if ($result === 'not_pending') {
            return back()->with(
                'error',
                'Pesanan ini tidak lagi menunggu sehingga tidak dapat dibatalkan.'
            );
        }

        return redirect()->route('user.orders')
            ->with('success', 'Pesanan berhasil dibatalkan dan stok barang telah dikembalikan.');
    }

    /*
    |--------------------------------------------------------------------------
    | Tambahkan produk ke keranjang Pembeli
    |--------------------------------------------------------------------------
    */

    public function addToCart(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($validated['product_id']);
        $cart = session()->get('cart', []);
        $productId = (int) $product->id;
        $currentQuantity = (int) ($cart[$productId] ?? 0);
        $newQuantity = $currentQuantity + (int) $validated['quantity'];

        if ($newQuantity > $product->stock) {
            return back()->withErrors([
                'cart' => "Stok {$product->name} hanya tersedia {$product->stock} unit.",
            ]);
        }

        $cart[$productId] = $newQuantity;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    /*
    |--------------------------------------------------------------------------
    | Tampilkan keranjang Pembeli
    |--------------------------------------------------------------------------
    */

    public function cart()
    {
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        $items = $products->map(function ($product) use ($cart) {
            $quantity = (int) $cart[$product->id];

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => (float) $product->selling_price * $quantity,
            ];
        });

        $total = $items->sum('subtotal');

        return view('cart.index', compact('items', 'total'));
    }

    /*
    |--------------------------------------------------------------------------
    | Ubah jumlah produk di keranjang
    |--------------------------------------------------------------------------
    */

    public function updateCart(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int) $validated['quantity'];

        if ($quantity > $product->stock) {
            return back()->withErrors([
                'cart' => "Stok {$product->name} hanya tersedia {$product->stock} unit.",
            ]);
        }

        $cart = session()->get('cart', []);

        if (!array_key_exists($product->id, $cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $cart[$product->id] = $quantity;
        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus produk dari keranjang
    |--------------------------------------------------------------------------
    */

    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);

        unset($cart[$product->id]);

        session()->put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    /*
    |--------------------------------------------------------------------------
    | Halaman checkout Pembeli
    |--------------------------------------------------------------------------
    */

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        if ($products->count() !== count($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Ada produk yang sudah tidak tersedia. Periksa keranjangmu.');
        }

        $items = $products->map(function ($product) use ($cart) {
            $quantity = (int) $cart[$product->id];

            return [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => (float) $product->selling_price * $quantity,
            ];
        });

        $total = $items->sum('subtotal');

        return view('cart.checkout', compact('items', 'total'));
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan pesanan Pembeli
    |--------------------------------------------------------------------------
    */

    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:cash,transfer'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang belanja masih kosong.');
        }

        $sale = DB::transaction(function () use ($validated, $cart) {
            $sale = Sale::create([
                'user_id' => auth()->id(),
                'invoice_number' => $this->generateInvoiceNumber(),
                'sale_date' => now()->toDateString(),
                'total' => 0,
                'notes' => $validated['notes'] ?? null,
                'payment_method' => $validated['payment_method'],
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            $total = 0;

            foreach ($cart as $productId => $requestedQuantity) {
                $product = Product::whereKey($productId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $quantity = (int) $requestedQuantity;

                if ($quantity < 1 || $product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok {$product->name} tidak mencukupi. Stok tersedia: {$product->stock}. Silakan periksa keranjang.",
                    ]);
                }

                $price = (float) $product->selling_price;
                $subtotal = $price * $quantity;

                $sale->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'selling_price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $product->decrement('stock', $quantity);
                $total += $subtotal;
            }

            $sale->update(['total' => $total]);

            return $sale;
        });

        session()->forget('cart');

        return redirect()->route('user.orders')
            ->with('success', 'Pesanan berhasil dibuat. Nomor pesanan: ' . $sale->invoice_number);
    }

    /*
    |--------------------------------------------------------------------------
    | Riwayat pesanan Pembeli
    |--------------------------------------------------------------------------
    */

    public function myOrders()
    {
        $orders = Sale::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.orders', compact('orders'));
    }

    /*
    |--------------------------------------------------------------------------
    | Unggah bukti pembayaran transfer
    |--------------------------------------------------------------------------
    */

    public function uploadTransferProof(Request $request, Sale $sale)
    {
        $request->validate([
            'transfer_proof' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        abort_unless((int) $sale->user_id === (int) auth()->id(), 403);

        if ($sale->payment_method !== 'transfer') {
            return back()->with('error', 'Pesanan ini tidak menggunakan transfer bank.');
        }

        if ($sale->payment_status === 'paid') {
            return back()->with('error', 'Pesanan ini sudah dikonfirmasi lunas.');
        }

        if ($sale->order_status === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat menerima pembayaran.');
        }

        $path = $request->file('transfer_proof')
            ->store('transfer-proofs', 'public');

        if ($sale->transfer_proof) {
            Storage::disk('public')->delete($sale->transfer_proof);
        }

        $sale->update([
            'transfer_proof' => $path,
            'payment_status' => 'waiting_confirmation',
        ]);

        return back()->with(
            'success',
            'Bukti transfer berhasil diunggah. Silakan tunggu konfirmasi Admin/Staff.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Membuat nomor invoice unik
    |--------------------------------------------------------------------------
    */

    private function generateInvoiceNumber(): string
    {
        do {
            $invoice = 'PJ-' . now()->format('YmdHis')
                . '-' . strtoupper(bin2hex(random_bytes(3)));
        } while (Sale::where('invoice_number', $invoice)->exists());

        return $invoice;
    }
}