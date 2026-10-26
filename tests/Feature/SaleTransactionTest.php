<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('sale transaction decreases product stock', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Penjualan Tes',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'SALE-' . uniqid(),
        'name' => 'Produk Penjualan Tes',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 2,
    ]);

    $response = $this->actingAs($admin)->post(route('sales.store'), [
        'sale_date' => now()->toDateString(),
        'notes' => 'Tes transaksi penjualan',
        'items' => [
            [
                'product_id' => $product->id,
                'quantity' => 3,
            ],
        ],
    ]);

    $response->assertRedirect(route('sales.index'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 7,
    ]);

    $sale = Sale::where('notes', 'Tes transaksi penjualan')
        ->firstOrFail();

    $this->assertDatabaseHas('sale_items', [
        'sale_id' => $sale->id,
        'product_id' => $product->id,
        'quantity' => 3,
        'selling_price' => 15000,
        'subtotal' => 45000,
    ]);

    $this->assertEquals(45000, (float) $sale->total);
});

it('rejects sale quantity exceeding stock without changing stock', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Stok Tidak Cukup',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'SALE-' . uniqid(),
        'name' => 'Produk Stok Terbatas',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 2,
        'minimum_stock' => 1,
    ]);

    $response = $this->actingAs($admin)->post(route('sales.store'), [
        'sale_date' => now()->toDateString(),
        'items' => [
            [
                'product_id' => $product->id,
                'quantity' => 5,
            ],
        ],
    ]);

    $response->assertSessionHasErrors('items');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 2,
    ]);

    $this->assertDatabaseCount('sales', 0);
});

it('rolls back entire sale when one product has insufficient stock', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $category = Category::create([
        'name' => 'Kategori Rollback Penjualan',
    ]);

    $firstProduct = Product::create([
        'category_id' => $category->id,
        'sku' => 'SALE-' . uniqid(),
        'name' => 'Produk Stok Cukup',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 10,
        'minimum_stock' => 1,
    ]);

    $secondProduct = Product::create([
        'category_id' => $category->id,
        'sku' => 'SALE-' . uniqid(),
        'name' => 'Produk Stok Kurang',
        'purchase_price' => 20000,
        'selling_price' => 25000,
        'stock' => 2,
        'minimum_stock' => 1,
    ]);

    $response = $this->actingAs($admin)->post(route('sales.store'), [
        'sale_date' => now()->toDateString(),
        'notes' => 'Tes rollback penjualan',
        'items' => [
            [
                'product_id' => $firstProduct->id,
                'quantity' => 3,
            ],
            [
                'product_id' => $secondProduct->id,
                'quantity' => 5,
            ],
        ],
    ]);

    $response->assertSessionHasErrors('items');

    $this->assertDatabaseHas('products', [
        'id' => $firstProduct->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseHas('products', [
        'id' => $secondProduct->id,
        'stock' => 2,
    ]);

    $this->assertDatabaseCount('sales', 0);
    $this->assertDatabaseCount('sale_items', 0);
});

it('rejects checkout when cart quantity exceeds current stock', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $category = Category::create([
        'name' => 'Kategori Checkout Tes',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'CART-' . uniqid(),
        'name' => 'Produk Checkout Tes',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 2,
        'minimum_stock' => 1,
    ]);

    $this->actingAs($user);

    session([
        'cart' => [
            $product->id => 5,
        ],
    ]);

    $response = $this->post(route('cart.placeOrder'), [
        'payment_method' => 'cash',
        'notes' => 'Tes checkout stok tidak cukup',
    ]);

    $response->assertSessionHasErrors('cart');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 2,
    ]);

    $this->assertDatabaseCount('sales', 0);
});

it('restores product stock when user cancels pending order', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $category = Category::create([
        'name' => 'Kategori Batal Pesanan',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'CANCEL-' . uniqid(),
        'name' => 'Produk Pesanan Batal',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 7,
        'minimum_stock' => 1,
    ]);

    $sale = Sale::create([
        'user_id' => $user->id,
        'invoice_number' => 'TEST-' . uniqid(),
        'sale_date' => now()->toDateString(),
        'total' => 45000,
        'payment_method' => 'cash',
        'payment_status' => 'pending',
        'order_status' => 'pending',
    ]);

    SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => $product->id,
        'quantity' => 3,
        'selling_price' => 15000,
        'subtotal' => 45000,
    ]);

    $response = $this->actingAs($user)->patch(
        route('user.orders.cancel', $sale)
    );

    $response->assertRedirect(route('user.orders'));

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseHas('sales', [
        'id' => $sale->id,
        'order_status' => 'cancelled',
    ]);
});

it('does not restore stock when user cancels an already paid order', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $category = Category::create([
        'name' => 'Kategori Pesanan Dibayar',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'PAID-' . uniqid(),
        'name' => 'Produk Sudah Dibayar',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 7,
        'minimum_stock' => 1,
    ]);

    $sale = Sale::create([
        'user_id' => $user->id,
        'invoice_number' => 'TEST-' . uniqid(),
        'sale_date' => now()->toDateString(),
        'total' => 45000,
        'payment_method' => 'cash',
        'payment_status' => 'paid',
        'order_status' => 'completed',
    ]);

    SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => $product->id,
        'quantity' => 3,
        'selling_price' => 15000,
        'subtotal' => 45000,
    ]);

    $response = $this->actingAs($user)->patch(
        route('user.orders.cancel', $sale)
    );

    $response->assertRedirect();
    $response->assertSessionHas('error');

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 7,
    ]);

    $this->assertDatabaseHas('sales', [
        'id' => $sale->id,
        'order_status' => 'completed',
    ]);
});

it('restores product stock when admin cancels pending order', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $category = Category::create([
        'name' => 'Kategori Admin Batal',
    ]);

    $product = Product::create([
        'category_id' => $category->id,
        'sku' => 'ADMIN-CANCEL-' . uniqid(),
        'name' => 'Produk Dibatalkan Admin',
        'purchase_price' => 10000,
        'selling_price' => 15000,
        'stock' => 7,
        'minimum_stock' => 1,
    ]);

    $sale = Sale::create([
        'user_id' => $user->id,
        'invoice_number' => 'TEST-' . uniqid(),
        'sale_date' => now()->toDateString(),
        'total' => 45000,
        'payment_method' => 'cash',
        'payment_status' => 'pending',
        'order_status' => 'pending',
    ]);

    SaleItem::create([
        'sale_id' => $sale->id,
        'product_id' => $product->id,
        'quantity' => 3,
        'selling_price' => 15000,
        'subtotal' => 45000,
    ]);

    $response = $this->actingAs($admin)->patch(
        route('sales.cancelOrder', $sale)
    );

    $response->assertRedirect();

    $this->assertDatabaseHas('products', [
        'id' => $product->id,
        'stock' => 10,
    ]);

    $this->assertDatabaseHas('sales', [
        'id' => $sale->id,
        'order_status' => 'cancelled',
    ]);
});
