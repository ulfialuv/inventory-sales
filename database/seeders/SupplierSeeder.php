<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT Sumber Makmur',
                'phone' => '081234567801',
                'address' => 'Medan, Sumatera Utara',
                'email' => 'sumbermakmur@example.com',
            ],
            [
                'name' => 'CV Berkah Jaya',
                'phone' => '081234567802',
                'address' => 'Binjai, Sumatera Utara',
                'email' => 'berkahjaya@example.com',
            ],
            [
                'name' => 'PT Mitra Sejahtera',
                'phone' => '081234567803',
                'address' => 'Deli Serdang, Sumatera Utara',
                'email' => 'mitrasejahtera@example.com',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(
                ['email' => $supplier['email']],
                $supplier
            );
        }
    }
}
