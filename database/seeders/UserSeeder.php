<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@inventory.test'],
            [
                'name' => 'Admin Inventory',
                'password' => 'admin12345',
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@inventory.test'],
            [
                'name' => 'Staff Inventory',
                'password' => 'staff12345',
                'role' => 'staff',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@inventory.test'],
            [
                'name' => 'User Pembeli',
                'password' => 'user12345',
                'role' => 'user',
            ]
        );
    }
}
