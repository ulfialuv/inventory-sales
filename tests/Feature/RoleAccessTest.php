<?php

use App\Models\User;

it('admin can access admin dashboard', function () {
    $admin = User::factory()->create([
        'role' => 'admin',
    ]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk();
});

it('staff can access staff dashboard', function () {
    $staff = User::factory()->create([
        'role' => 'staff',
    ]);

    $this->actingAs($staff)
        ->get(route('staff.dashboard'))
        ->assertOk();
});

it('user can access user dashboard', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($user)
        ->get(route('user.dashboard'))
        ->assertOk();
});

it('staff cannot access admin dashboard', function () {
    $staff = User::factory()->create([
        'role' => 'staff',
    ]);

    $this->actingAs($staff)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('user cannot access admin dashboard', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('user cannot access purchase page', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($user)
        ->get(route('purchases.index'))
        ->assertForbidden();
});

it('guest cannot access admin dashboard', function () {
    $this->get(route('admin.dashboard'))
        ->assertRedirect('/login');
});


it('staff cannot access admin management pages', function () {
    $staff = User::factory()->create([
        'role' => 'staff',
    ]);

    $this->actingAs($staff)
        ->get(route('categories.index'))
        ->assertForbidden();

    $this->actingAs($staff)
        ->get(route('products.index'))
        ->assertForbidden();

    $this->actingAs($staff)
        ->get(route('suppliers.index'))
        ->assertForbidden();

    $this->actingAs($staff)
        ->get(route('users.index'))
        ->assertForbidden();
});

it('user cannot access internal sales pages', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($user)
        ->get(route('sales.index'))
        ->assertForbidden();

    $this->actingAs($user)
        ->get(route('sales.create'))
        ->assertForbidden();
});

it('user cannot access reports', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($user)
        ->get(route('reports.index'))
        ->assertForbidden();
});

use App\Models\Sale;


it('user cannot cancel another users order', function () {
    $owner = User::factory()->create([
        'role' => 'user',
    ]);

    $otherUser = User::factory()->create([
        'role' => 'user',
    ]);

    $sale = Sale::create([
        'user_id' => $owner->id,
        'invoice_number' => 'TEST-' . uniqid(),
        'sale_date' => now()->toDateString(),
        'total' => 100000,
        'payment_method' => 'transfer',
        'payment_status' => 'pending',
        'order_status' => 'pending',
    ]);

    $this->actingAs($otherUser)
        ->patch(route('user.orders.cancel', $sale))
        ->assertForbidden();
});

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

it('user cannot upload transfer proof for another users order', function () {
    Storage::fake('public');

    $owner = User::factory()->create([
        'role' => 'user',
    ]);

    $otherUser = User::factory()->create([
        'role' => 'user',
    ]);

    $sale = Sale::create([
        'user_id' => $owner->id,
        'invoice_number' => 'TEST-' . uniqid(),
        'sale_date' => now()->toDateString(),
        'total' => 100000,
        'payment_method' => 'transfer',
        'payment_status' => 'pending',
        'order_status' => 'pending',
    ]);

    $this->actingAs($otherUser)
        ->post(route('user.orders.transfer-proof', $sale), [
            'transfer_proof' => UploadedFile::fake()->create(
                'bukti.jpg',
                100,
                'image/jpeg'
            ),
        ])
        ->assertForbidden();
});


it('user can only see their own orders', function () {
    $owner = User::factory()->create([
        'role' => 'user',
    ]);

    $otherUser = User::factory()->create([
        'role' => 'user',
    ]);

    $sale = Sale::create([
        'user_id' => $owner->id,
        'invoice_number' => 'TEST-' . uniqid(),
        'sale_date' => now()->toDateString(),
        'total' => 100000,
        'payment_method' => 'transfer',
        'payment_status' => 'pending',
        'order_status' => 'pending',
    ]);

    $this->actingAs($otherUser)
        ->get(route('user.orders'))
        ->assertOk()
        ->assertDontSee($sale->invoice_number);
});

it('user cannot access category and supplier management pages', function () {
    $user = User::factory()->create([
        'role' => 'user',
    ]);

    $this->actingAs($user)
        ->get(route('categories.index'))
        ->assertForbidden();

    $this->actingAs($user)
        ->get(route('suppliers.index'))
        ->assertForbidden();
});
