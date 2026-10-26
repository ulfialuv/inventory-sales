<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function createProductTestCategory(string $name = 'Kategori Tes'): Category
{
    return Category::create([
        'name' => $name . ' ' . uniqid(),
    ]);
}

function createProductTest(array $overrides = []): Product
{
    $category = createProductTestCategory();

    return Product::create(array_merge([
        'category_id' => $category->id,
        'sku' => 'SKU-' . uniqid(),
        'name' => 'Produk Tes',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ], $overrides));
}

it('admin can create a product', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $category = createProductTestCategory();

    $response = $this->actingAs($admin)->post(route('products.store'), [
        'category_id' => $category->id,
        'sku' => 'SKU-TEST-001',
        'name' => 'Keyboard Tes',
        'purchase_price' => 100000,
        'selling_price' => 150000,
        'stock' => 20,
        'minimum_stock' => 5,
    ]);

    $response->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products', [
        'sku' => 'SKU-TEST-001',
        'name' => 'Keyboard Tes',
        'stock' => 20,
    ]);
});

it('rejects product with missing required fields', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(route('products.store'), []);

    $response->assertSessionHasErrors([
        'sku',
        'name',
        'category_id',
        'purchase_price',
        'selling_price',
        'stock',
        'minimum_stock',
    ]);

    $this->assertDatabaseCount('products', 0);
});

it('rejects duplicate product sku', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $product = createProductTest();

    $response = $this->actingAs($admin)->post(route('products.store'), [
        'category_id' => $product->category_id,
        'sku' => $product->sku,
        'name' => 'Produk Duplikat',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 5,
        'minimum_stock' => 1,
    ]);

    $response->assertSessionHasErrors('sku');

    $this->assertDatabaseCount('products', 1);
});

it('rejects negative product stock', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $category = createProductTestCategory();

    $response = $this->actingAs($admin)->post(route('products.store'), [
        'category_id' => $category->id,
        'sku' => 'SKU-NEGATIVE',
        'name' => 'Produk Stok Negatif',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => -1,
        'minimum_stock' => 0,
    ]);

    $response->assertSessionHasErrors('stock');

    $this->assertDatabaseMissing('products', [
        'sku' => 'SKU-NEGATIVE',
    ]);
});

it('admin can update a product', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $product = createProductTest();

    $response = $this->actingAs($admin)->put(
        route('products.update', $product),
        [
            'category_id' => $product->category_id,
            'sku' => $product->sku,
            'name' => 'Produk Sudah Diperbarui',
            'purchase_price' => 12000,
            'selling_price' => 18000,
            'stock' => 15,
            'minimum_stock' => 3,
        ]
    );

    $response->assertRedirect(route('products.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'name' => 'Produk Sudah Diperbarui',
        'purchase_price' => 12000,
        'selling_price' => 18000,
        'stock' => 15,
    ]);
});

it('admin can delete a product not used in transactions', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $product = createProductTest();

    $response = $this->actingAs($admin)->delete(
        route('products.destroy', $product)
    );

    $response->assertRedirect(route('products.index'));

    $this->assertDatabaseMissing('products', [
        'id' => $product->id,
    ]);
});

it('product search finds products by name', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $product = createProductTest([
        'name' => 'Laptop Khusus',
        'sku' => 'LAPTOP-001',
    ]);

    $response = $this->actingAs($admin)->get(
        route('products.index', ['search' => 'Laptop Khusus'])
    );

    $response->assertOk();
    $response->assertSee('Laptop Khusus');
});

it('product category filter only shows products in selected category', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $categoryA = createProductTestCategory('Kategori A');
    $categoryB = createProductTestCategory('Kategori B');

    Product::create([
        'category_id' => $categoryA->id,
        'sku' => 'KAT-A-001',
        'name' => 'Produk Kategori A',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    Product::create([
        'category_id' => $categoryB->id,
        'sku' => 'KAT-B-001',
        'name' => 'Produk Kategori B',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->get(
        route('products.index', ['category_id' => $categoryA->id])
    );

    $response->assertOk();
    $response->assertSee('Produk Kategori A');
    $response->assertDontSee('Produk Kategori B');
});

it('low stock filter only shows products at or below minimum stock', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    createProductTest([
        'sku' => 'LOW-001',
        'name' => 'Produk Stok Menipis',
        'stock' => 2,
        'minimum_stock' => 5,
    ]);

    createProductTest([
        'sku' => 'NORMAL-001',
        'name' => 'Produk Stok Normal',
        'stock' => 10,
        'minimum_stock' => 5,
    ]);

    createProductTest([
        'sku' => 'EMPTY-001',
        'name' => 'Produk Stok Habis',
        'stock' => 0,
        'minimum_stock' => 5,
    ]);

    $response = $this->actingAs($admin)->get(
        route('products.index', ['stock_filter' => 'low'])
    );

    $response->assertOk();
    $response->assertSee('Produk Stok Menipis');
    $response->assertDontSee('Produk Stok Normal');
    $response->assertDontSee('Produk Stok Habis');
});

it('empty stock filter only shows products with zero stock', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    createProductTest([
        'sku' => 'EMPTY-002',
        'name' => 'Produk Benar-benar Habis',
        'stock' => 0,
        'minimum_stock' => 2,
    ]);

    createProductTest([
        'sku' => 'AVAILABLE-002',
        'name' => 'Produk Masih Ada',
        'stock' => 5,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->get(
        route('products.index', ['stock_filter' => 'empty'])
    );

    $response->assertOk();
    $response->assertSee('Produk Benar-benar Habis');
    $response->assertDontSee('Produk Masih Ada');
});
