<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'start_date' => ['nullable', 'date'],
            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
            ],
        ]);

        $purchases = Purchase::with(['supplier', 'user'])
            ->when($request->filled('start_date'), function ($query) use ($request) {
                $query->whereDate('purchase_date', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                $query->whereDate('purchase_date', '<=', $request->end_date);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        if (auth()->user()->role === 'staff') {
            return view('staff.purchases.index', compact('purchases'));
            }
            return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'purchase_date' => ['required', 'date'],
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
            $purchase = Purchase::create([
                'supplier_id' => $validated['supplier_id'],
                'user_id' => auth()->id(),
                'invoice_number' => 'PB-' . now()->format('YmdHis')
                    . '-' . strtoupper(bin2hex(random_bytes(3))),
                'purchase_date' => $validated['purchase_date'],
                'total' => 0,
                'notes' => $validated['notes'] ?? null,
            ]);

            $total = 0;

            foreach ($validated['items'] as $item) {
                $product = Product::whereKey($item['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $quantity = (int) $item['quantity'];
                $price = (float) $product->purchase_price;
                $subtotal = $price * $quantity;

                $purchase->items()->create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'purchase_price' => $price,
                    'subtotal' => $subtotal,
                ]);

                $product->increment('stock', $quantity);
                $total += $subtotal;
            }

            $purchase->update(['total' => $total]);
        });

        return redirect()->route('purchases.index')
            ->with('success', 'Transaksi pembelian berhasil disimpan. Stok sudah ditambahkan.');
    }
}
