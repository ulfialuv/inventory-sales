<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('admin can create a category', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(
        route('categories.store'),
        ['name' => 'Kategori Elektronik']
    );

    $response->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', [
        'name' => 'Kategori Elektronik',
    ]);
});

it('rejects category with missing name', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post(
        route('categories.store'),
        ['name' => '']
    );

    $response->assertSessionHasErrors('name');

    $this->assertDatabaseCount('categories', 0);
});

it('rejects duplicate category name', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Category::create(['name' => 'Elektronik']);

    $response = $this->actingAs($admin)->post(
        route('categories.store'),
        ['name' => 'Elektronik']
    );

    $response->assertSessionHasErrors('name');

    $this->assertDatabaseCount('categories', 1);
});

it('admin can update a category', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $category = Category::create([
        'name' => 'Kategori Lama',
    ]);

    $response = $this->actingAs($admin)->put(
        route('categories.update', $category),
        ['name' => 'Kategori Baru']
    );

    $response->assertRedirect(route('categories.index'));

    $this->assertDatabaseHas('categories', [
        'id' => $category->id,
        'name' => 'Kategori Baru',
    ]);
});

it('admin can delete an unused category', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $category = Category::create([
        'name' => 'Kategori Hapus',
    ]);

    $response = $this->actingAs($admin)->delete(
        route('categories.destroy', $category)
    );

    $response->assertRedirect(route('categories.index'));

    $this->assertDatabaseMissing('categories', [
        'id' => $category->id,
    ]);
});

it('category list can be opened by admin', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    Category::create([
        'name' => 'Kategori Tampilan',
    ]);

    $response = $this->actingAs($admin)->get(
        route('categories.index')
    );

    $response->assertOk();
    $response->assertSee('Kategori Tampilan');
});
