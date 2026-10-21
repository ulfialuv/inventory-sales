<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil produk beserta kategorinya
        $query = Product::with('category');

        // Pencarian berdasarkan nama produk atau SKU
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter berdasarkan status stok
        if ($request->stock_filter === 'low') {
            // Stok menipis: stok lebih dari nol dan tidak melebihi stok minimum
            $query->where('stock', '>', 0)
                ->whereColumn('stock', '<=', 'minimum_stock');

        } elseif ($request->stock_filter === 'available') {
            // Stok tersedia: stok melebihi stok minimum
            $query->where('stock', '>', 0)
                ->whereColumn('stock', '>', 'minimum_stock');

        } elseif ($request->stock_filter === 'empty') {
            // Stok habis
            $query->where('stock', '<=', 0);
        }

        // Mengambil data produk dengan pagination
        $products = $query->latest()
            ->paginate(10)
            ->withQueryString();

        // Mengambil kategori untuk filter
        $categories = Category::orderBy('name')->get();

        // Jika halaman dibuka oleh staff
        if ($request->routeIs('staff.products.index')) {
            return view('staff.products.index', compact(
                'products',
                'categories'
            ));
        }

        // Halaman produk admin
        return view('products.index', compact(
            'products',
            'categories'
        ));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sku' => [
                'required',
                'string',
                'max:50',
                'unique:products,sku',
            ],
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
            'minimum_stock' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact(
            'product',
            'categories'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'sku' => [
                'required',
                'string',
                'max:50',
                Rule::unique('products', 'sku')->ignore($product->id),
            ],
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'category_id' => [
                'required',
                'exists:categories,id',
            ],
            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'stock' => [
                'required',
                'integer',
                'min:0',
            ],
            'minimum_stock' => [
                'required',
                'integer',
                'min:0',
            ],
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Produk tidak boleh dihapus jika sudah digunakan dalam transaksi
        if (
            $product->purchaseItems()->exists() ||
            $product->saleItems()->exists()
        ) {
            return redirect()->route('products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena sudah digunakan dalam transaksi.'
                );
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}