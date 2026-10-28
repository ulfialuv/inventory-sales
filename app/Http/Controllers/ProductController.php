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
        // Validasi data produk baru
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
                'unique:products,name',
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
                'gt:purchase_price',
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
        ], [
            'sku.required' => 'Kode SKU wajib diisi.',
            'sku.unique' => 'Kode SKU sudah digunakan oleh produk lain.',

            'name.required' => 'Nama produk wajib diisi.',
            'name.unique' => 'Nama produk sudah terdaftar. Silakan gunakan nama produk yang berbeda.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak ditemukan.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.numeric' => 'Harga beli harus berupa angka.',
            'purchase_price.min' => 'Harga beli tidak boleh kurang dari nol.',

            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.numeric' => 'Harga jual harus berupa angka.',
            'selling_price.gt' => 'Harga jual harus lebih tinggi daripada harga beli.',

            'stock.required' => 'Stok awal wajib diisi.',
            'stock.integer' => 'Stok awal harus berupa bilangan bulat.',
            'stock.min' => 'Stok awal tidak boleh kurang dari nol.',

            'minimum_stock.required' => 'Batas minimum stok wajib diisi.',
            'minimum_stock.integer' => 'Batas minimum stok harus berupa bilangan bulat.',
            'minimum_stock.min' => 'Batas minimum stok tidak boleh kurang dari nol.',
        ]);

        // Menyimpan produk jika semua validasi berhasil
        Product::create($validated);

        return redirect()
            ->route('products.index')
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
        // Validasi data saat produk diperbarui
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
                Rule::unique('products', 'name')->ignore($product->id),
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
                'gt:purchase_price',
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
        ], [
            'sku.required' => 'Kode SKU wajib diisi.',
            'sku.unique' => 'Kode SKU sudah digunakan oleh produk lain.',

            'name.required' => 'Nama produk wajib diisi.',
            'name.unique' => 'Nama produk sudah digunakan oleh produk lain.',

            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak ditemukan.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'purchase_price.numeric' => 'Harga beli harus berupa angka.',
            'purchase_price.min' => 'Harga beli tidak boleh kurang dari nol.',

            'selling_price.required' => 'Harga jual wajib diisi.',
            'selling_price.numeric' => 'Harga jual harus berupa angka.',
            'selling_price.gt' => 'Harga jual harus lebih tinggi daripada harga beli.',

            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'stock.min' => 'Stok tidak boleh kurang dari nol.',

            'minimum_stock.required' => 'Batas minimum stok wajib diisi.',
            'minimum_stock.integer' => 'Batas minimum stok harus berupa bilangan bulat.',
            'minimum_stock.min' => 'Batas minimum stok tidak boleh kurang dari nol.',
        ]);

        // Memperbarui produk jika semua validasi berhasil
        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        // Produk tidak boleh dihapus jika sudah digunakan dalam transaksi
        if (
            $product->purchaseItems()->exists() ||
            $product->saleItems()->exists()
        ) {
            return redirect()
                ->route('products.index')
                ->with(
                    'error',
                    'Produk tidak dapat dihapus karena sudah digunakan dalam transaksi.'
                );
        }

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}