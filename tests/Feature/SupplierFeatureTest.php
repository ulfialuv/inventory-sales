<?php

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('admin can create a supplier', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(
        route('suppliers.store'),
        [
            'name' => 'PT Supplier Tes',
            'phone' => '081234567890',
            'address' => 'Medan',
            'email' => 'supplier@example.com',
        ]
    );

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'name' => 'PT Supplier Tes',
        'phone' => '081234567890',
        'address' => 'Medan',
        'email' => 'supplier@example.com',
    ]);
});

it('rejects supplier with missing name', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(
        route('suppliers.store'),
        [
            'name' => '',
            'phone' => '081234567890',
            'address' => 'Medan',
            'email' => 'supplier@example.com',
        ]
    );

    $response->assertSessionHasErrors('name');

    $this->assertDatabaseCount('suppliers', 0);
});

it('admin can update a supplier', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $supplier = Supplier::create([
        'name' => 'Supplier Lama',
        'phone' => '081111111111',
        'address' => 'Alamat Lama',
        'email' => 'lama@example.com',
    ]);

    $response = $this->actingAs($admin)->put(
        route('suppliers.update', $supplier),
        [
            'name' => 'Supplier Baru',
            'phone' => '082222222222',
            'address' => 'Alamat Baru',
            'email' => 'baru@example.com',
        ]
    );

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
        'name' => 'Supplier Baru',
        'phone' => '082222222222',
        'address' => 'Alamat Baru',
        'email' => 'baru@example.com',
    ]);
});

it('admin can delete a supplier without purchases', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $supplier = Supplier::create([
        'name' => 'Supplier Hapus',
        'phone' => '083333333333',
        'address' => 'Medan',
        'email' => 'hapus@example.com',
    ]);

    $response = $this->actingAs($admin)->delete(
        route('suppliers.destroy', $supplier)
    );

    $response->assertRedirect(route('suppliers.index'));

    $this->assertDatabaseMissing('suppliers', [
        'id' => $supplier->id,
    ]);
});

it('admin can open supplier list', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Supplier::create([
        'name' => 'Supplier Tampilan',
        'phone' => '084444444444',
        'address' => 'Medan',
        'email' => 'tampilan@example.com',
    ]);

    $response = $this->actingAs($admin)->get(
        route('suppliers.index')
    );

    $response->assertOk();
    $response->assertSee('Supplier Tampilan');
});

it('does not delete a supplier that has purchases', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $supplier = Supplier::create([
        'name' => 'Supplier Sudah Transaksi',
        'phone' => '081234567890',
        'address' => 'Medan',
        'email' => 'transaksi@example.com',
    ]);

    \App\Models\Purchase::create([
        'supplier_id' => $supplier->id,
        'user_id' => $admin->id,
        'invoice_number' => 'INV-TEST-001',
        'purchase_date' => now()->toDateString(),
        'total' => 100000,
        'notes' => 'Pembelian untuk pengujian',
    ]);

    $response = $this->actingAs($admin)->delete(
        route('suppliers.destroy', $supplier)
    );

    $response->assertRedirect(route('suppliers.index'));

    $response->assertSessionHas(
        'error',
        'Pemasok tidak bisa dihapus karena sudah digunakan dalam transaksi pembelian.'
    );

    $this->assertDatabaseHas('suppliers', [
        'id' => $supplier->id,
    ]);
});
