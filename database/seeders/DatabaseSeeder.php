<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::firstOrCreate(
            ['email' => 'admin@inventory.test'],
            [
                'name' => 'Admin Inventory',
                'password' => 'admin12345',
                'role' => 'admin',
            ]
        );

        // Akun Staff
        User::firstOrCreate(
            ['email' => 'staff@inventory.test'],
            [
                'name' => 'Staff Inventory',
                'password' => 'staff12345',
                'role' => 'staff',
            ]
        );

        // Akun User
        User::firstOrCreate(
            ['email' => 'user@inventory.test'],
            [
                'name' => 'User Inventory',
                'password' => 'user12345',
                'role' => 'user',
            ]
        );

        $this->call([
            CategorySeeder::class,
            SupplierSeeder::class,
            ProductSeeder::class,
        ]);
    }
}