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
    | Simpan transaksi langsung di toko
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
            $order = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->order_status === 'cancelled') {
                return 'cancelled';
            }

            if ($order->payment_status === 'paid') {
                return 'already_paid';
            }

            if ($order->payment_method === 'cash') {
                return 'invalid_method';
            }

            if (
                in_array($order->payment_method, ['transfer', 'qris', 'ewallet'], true)
                && empty($order->transfer_proof)
            ) {
                return 'no_proof';
            }

            $order->payment_status = 'paid';

            // Pembayaran lunas tidak otomatis menyelesaikan pesanan.
            if ($order->order_status === 'pending') {
                $order->order_status = 'processing';
            }

            $order->save();

            return 'success';
        });

        if ($result === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat dikonfirmasi.');
        }

        if ($result === 'already_paid') {
            return back()->with('error', 'Pembayaran pesanan ini sudah dikonfirmasi lunas.');
        }

        if ($result === 'invalid_method') {
            return back()->with(
                'error',
                'Pembayaran tunai saat transaksi langsung tidak perlu dikonfirmasi lagi.'
            );
        }

        if ($result === 'no_proof') {
            return back()->with(
                'error',
                'Pembeli belum mengunggah bukti pembayaran.'
            );
        }

        return back()->with(
            'success',
            'Pembayaran berhasil dikonfirmasi. Pesanan masuk ke tahap diproses.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Ubah status pesanan oleh Admin dan Staff
    |--------------------------------------------------------------------------
    */

    public function updateOrderStatus(Request $request, Sale $sale)
    {
        $validated = $request->validate([
            'order_status' => ['required', 'in:processing,shipped'],
        ]);

        $result = DB::transaction(function () use ($sale, $validated) {
            $order = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->order_status === 'cancelled') {
                return 'cancelled';
            }

            if ($order->order_status === 'completed') {
                return 'completed';
            }

            $newStatus = $validated['order_status'];

            if ($newStatus === 'processing') {
                if ($order->order_status !== 'pending') {
                    return 'invalid_transition';
                }

                // Pesanan transfer/QRIS harus sudah lunas.
                if (
                    in_array($order->payment_method, ['transfer', 'qris', 'ewallet'], true)
                    && $order->payment_status !== 'paid'
                ) {
                    return 'unpaid';
                }

                $order->order_status = 'processing';
            }

            if ($newStatus === 'shipped') {
                if ($order->order_status !== 'processing') {
                    return 'invalid_transition';
                }

                if (
                    in_array($order->payment_method, ['transfer', 'qris', 'ewallet'], true)
                    && $order->payment_status !== 'paid'
                ) {
                    return 'unpaid';
                }

                $order->order_status = 'shipped';
            }

            $order->save();

            return 'success';
        });

        if ($result === 'cancelled') {
            return back()->with('error', 'Pesanan sudah dibatalkan.');
        }

        if ($result === 'completed') {
            return back()->with('error', 'Pesanan sudah selesai.');
        }

        if ($result === 'invalid_transition') {
            return back()->with(
                'error',
                'Perubahan status tidak sesuai dengan tahap pesanan saat ini.'
            );
        }

        if ($result === 'unpaid') {
            return back()->with(
                'error',
                'Pembayaran harus dikonfirmasi sebelum pesanan diproses atau dikirim.'
            );
        }

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | Pelanggan mengonfirmasi barang sudah diterima
    |--------------------------------------------------------------------------
    */

    public function markReceived(Sale $sale)
    {
        $result = DB::transaction(function () use ($sale) {
            $order = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ((int) $order->user_id !== (int) auth()->id()) {
                abort(403, 'Kamu tidak memiliki akses ke pesanan ini.');
            }

            if ($order->order_status === 'cancelled') {
                return 'cancelled';
            }

            if ($order->order_status === 'received') {
                return 'already_received';
            }

            if ($order->order_status === 'completed') {
                return 'completed';
            }

            if ($order->order_status !== 'shipped') {
                return 'not_shipped';
            }

            $order->update([
                'order_status' => 'received',
            ]);

            return 'success';
        });

        if ($result === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat dikonfirmasi.');
        }

        if ($result === 'already_received') {
            return back()->with('error', 'Pesanan sudah dikonfirmasi diterima.');
        }

        if ($result === 'completed') {
            return back()->with('error', 'Pesanan ini sudah selesai.');
        }

        if ($result === 'not_shipped') {
            return back()->with(
                'error',
                'Pesanan dapat dikonfirmasi diterima setelah statusnya dikirim.'
            );
        }

        return back()->with(
            'success',
            'Konfirmasi penerimaan berhasil. Silakan tunggu Admin/Staff menyelesaikan pesanan.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Admin dan Staff menyelesaikan pesanan
    |--------------------------------------------------------------------------
    */

    public function completeOrder(Sale $sale)
    {
        $result = DB::transaction(function () use ($sale) {
            $order = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->order_status === 'cancelled') {
                return 'cancelled';
            }

            if ($order->order_status === 'completed') {
                return 'already_completed';
            }

            if ($order->order_status !== 'received') {
                return 'not_received';
            }

            // COD dianggap dibayar ketika Admin/Staff menyelesaikan
            // pesanan yang sudah dikonfirmasi diterima pelanggan.
            if ($order->payment_method === 'cod') {
                $order->payment_status = 'paid';
            } elseif ($order->payment_status !== 'paid') {
                return 'unpaid';
            }

            $order->order_status = 'completed';
            $order->save();

            return 'success';
        });

        if ($result === 'cancelled') {
            return back()->with('error', 'Pesanan yang dibatalkan tidak dapat diselesaikan.');
        }

        if ($result === 'already_completed') {
            return back()->with('error', 'Pesanan ini sudah selesai sebelumnya.');
        }

        if ($result === 'not_received') {
            return back()->with(
                'error',
                'Pelanggan harus mengonfirmasi penerimaan barang terlebih dahulu.'
            );
        }

        if ($result === 'unpaid') {
            return back()->with(
                'error',
                'Pembayaran harus dikonfirmasi lunas sebelum pesanan diselesaikan.'
            );
        }

        return back()->with(
            'success',
            'Pesanan berhasil diselesaikan.'
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
            $order = Sale::whereKey($sale->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($order->order_status === 'cancelled') {
                return 'already_cancelled';
            }

            if (
                $order->payment_status === 'paid'
                || in_array($order->order_status, ['shipped', 'received', 'completed'], true)
            ) {
                return 'already_processed';
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

        if ($result === 'already_processed') {
            return back()->with(
                'error',
                'Pesanan yang sudah lunas, dikirim, diterima, atau selesai tidak dapat dibatalkan melalui fitur ini.'
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
                || in_array($order->order_status, ['shipped', 'received', 'completed'], true)
            ) {
                return 'already_processed';
            }

            if ($order->order_status !== 'pending') {
                return 'not_pending';
            }

            foreach ($order->items()->get() as $item) {
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

        if ($result === 'already_processed') {
            return back()->with(
                'error',
                'Pesanan yang sudah diproses, dikirim, lunas, atau selesai tidak dapat dibatalkan.'
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
            'payment_method' => ['required', 'in:cod,transfer,qris,ewallet'],
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
    | Unggah bukti pembayaran transfer atau QRIS/e-wallet
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

        if (!in_array($sale->payment_method, ['transfer', 'qris', 'ewallet'], true)) {
            return back()->with(
                'error',
                'Unggah bukti hanya tersedia untuk pembayaran transfer atau QRIS/e-wallet.'
            );
        }

        if ($sale->payment_status === 'paid') {
            return back()->with('error', 'Pesanan ini sudah dikonfirmasi lunas.');
        }

        if ($sale->order_status !== 'pending') {
            return back()->with(
                'error',
                'Bukti pembayaran hanya dapat diunggah saat pesanan masih menunggu.'
            );
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
            'Bukti pembayaran berhasil diunggah. Tunggu konfirmasi Admin/Staff.'
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