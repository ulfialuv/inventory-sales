<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\User;
use App\Models\PurchaseItem;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('purchase transaction increases product stock', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Tes',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Tes',
        'phone' => '08123456789',
        'address' => 'Alamat Tes',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'TEST-' . uniqid(),
        'name' => 'Produk Tes',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->post(
        route('purchases.store'),
        [
            'supplier_id' => $supplier->id,
            'purchase_date' => now()->toDateString(),
            'notes' => 'Tes transaksi pembelian',
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 5,
                ],
            ],
        ]
    );

    $response->assertRedirect(route('purchases.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 15,
    ]);

    $purchase = Purchase::where(
        'notes',
        'Tes transaksi pembelian'
    )->firstOrFail();

    $this->assertDatabaseHas('purchase_items', [
        'purchase_id' => $purchase->id,
        'product_id' => $product->id,
        'quantity' => 5,
        'purchase_price' => 10000,
        'subtotal' => 50000,
    ]);

    $this->assertEquals(50000, (float) $purchase->total);
});

it('rejects invalid purchase quantity without changing stock', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Validasi',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Validasi',
        'phone' => '08123456789',
        'address' => 'Alamat Validasi',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'TEST-' . uniqid(),
        'name' => 'Produk Validasi',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->post(
        route('purchases.store'),
        [
            'supplier_id' => $supplier->id,
            'purchase_date' => now()->toDateString(),
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 0,
                ],
            ],
        ]
    );

    $response->assertSessionHasErrors('items.0.quantity');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseCount('purchases', 0);
});

it('rejects duplicate products in one purchase', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Duplikat',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Duplikat',
        'phone' => '08123456789',
        'address' => 'Alamat Duplikat',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'TEST-' . uniqid(),
        'name' => 'Produk Duplikat',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->post(
        route('purchases.store'),
        [
            'supplier_id' => $supplier->id,
            'purchase_date' => now()->toDateString(),
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                ],
                [
                    'product_id' => $product->id,
                    'quantity' => 3,
                ],
            ],
        ]
    );

    $response->assertSessionHasErrors([
        'items.0.product_id',
        'items.1.product_id',
    ]);

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseCount('purchases', 0);
});

it('rejects nonexistent product without creating purchase or changing stock', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $category = Category::create([
        'name' => 'Kategori Produk Tidak Valid',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Produk Tidak Valid',
        'phone' => '08123456789',
        'address' => 'Alamat Tes',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'TEST-' . uniqid(),
        'name' => 'Produk Tes',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->post(route('purchases.store'), [
        'supplier_id' => $supplier->id,
        'purchase_date' => now()->toDateString(),
        'items' => [
            [
                'product_id' => 999999,
                'quantity' => 5,
            ],
        ],
    ]);

    $response->assertSessionHasErrors('items.0.product_id');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseCount('purchases', 0);
});
it('calculates the correct total and increases stock for multiple products', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Multi Produk',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Multi Produk',
        'phone' => '08123456789',
        'address' => 'Medan',
    ]);

    $productA = Product::create([
        'category_id' => $category->id,
        'sku' => 'MULTI-A-' . uniqid(),
        'name' => 'Produk A',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $productB = Product::create([
        'category_id' => $category->id,
        'sku' => 'MULTI-B-' . uniqid(),
        'name' => 'Produk B',
        'purchase_price' => 20000,
        'selling_price' => 25000,
        'stock' => 20,
        'minimum_stock' => 3,
    ]);

    $response = $this->actingAs($admin)->post(
        route('purchases.store'),
        [
            'supplier_id' => $supplier->id,
            'purchase_date' => now()->toDateString(),
            'notes' => 'Tes pembelian beberapa produk',
            'items' => [
                [
                    'product_id' => $productA->id,
                    'quantity' => 3,
                ],
                [
                    'product_id' => $productB->id,
                    'quantity' => 4,
                ],
            ],
        ]
    );

    $response->assertRedirect(route('purchases.index'));

    $this->assertDatabaseHas('products', [
        'id' => $productA->id,
        'stock' => 13,
    ]);

    $this->assertDatabaseHas('products', [
        'id' => $productB->id,
        'stock' => 24,
    ]);

    $purchase = Purchase::where(
        'notes',
        'Tes pembelian beberapa produk'
    )->firstOrFail();

    $this->assertEquals(110000, (float) $purchase->total);

    $this->assertDatabaseHas('purchase_items', [
        'purchase_id' => $purchase->id,
        'product_id' => $productA->id,
        'quantity' => 3,
        'subtotal' => 30000,
    ]);

    $this->assertDatabaseHas('purchase_items', [
        'purchase_id' => $purchase->id,
        'product_id' => $productB->id,
        'quantity' => 4,
        'subtotal' => 80000,
    ]);

    $this->assertDatabaseCount('purchases', 1);
    $this->assertDatabaseCount('purchase_items', 2);
});
it('rejects purchase with nonexistent supplier', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $response = $this->actingAs($admin)->post(
        route('purchases.store'),
        [
            'supplier_id' => 999999,
            'purchase_date' => now()->toDateString(),
            'items' => [
                [
                    'product_id' => 999999,
                    'quantity' => 1,
                ],
            ],
        ]
    );

    $response->assertSessionHasErrors([
        'supplier_id',
        'items.0.product_id',
    ]);

    $this->assertDatabaseCount('purchases', 0);
    $this->assertDatabaseCount('purchase_items', 0);
});

it('rejects purchase with invalid purchase date', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Tanggal Invalid',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Tanggal Invalid',
        'phone' => '08123456789',
        'address' => 'Medan',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'DATE-' . uniqid(),
        'name' => 'Produk Tes Tanggal',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->post(
        route('purchases.store'),
        [
            'supplier_id' => $supplier->id,
            'purchase_date' => 'bukan-tanggal',
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                ],
            ],
        ]
    );

    $response->assertSessionHasErrors('purchase_date');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseCount('purchases', 0);
    $this->assertDatabaseCount('purchase_items', 0);
});
it('rolls back purchase when saving item fails', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Rollback',
    ]);

    $supplier = Supplier::create([
        'name' => 'Pemasok Rollback',
        'phone' => '08123456789',
        'address' => 'Medan',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'ROLLBACK-' . uniqid(),
        'name' => 'Produk Rollback',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    PurchaseItem::creating(function () {
        throw new \RuntimeException('Tes rollback');
    });

    $this->withoutExceptionHandling();

    try {
        $this->actingAs($admin)->post(route('purchases.store'), [
            'supplier_id' => $supplier->id,
            'purchase_date' => now()->toDateString(),
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 5,
                ],
            ],
        ]);

        $this->fail('Seharusnya transaksi gagal.');
    } catch (\RuntimeException $exception) {
        $this->assertSame('Tes rollback', $exception->getMessage());
    }

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseCount('purchases', 0);
    $this->assertDatabaseCount('purchase_items', 0);
});