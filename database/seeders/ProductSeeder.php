<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'sku' => 'ELK001',
                'name' => 'Mouse Wireless',
                'category' => 'Elektronik',
                'purchase_price' => 75000,
                'selling_price' => 100000,
                'stock' => 20,
                'minimum_stock' => 5,
            ],
            [
                'sku' => 'ELK002',
                'name' => 'Keyboard USB',
                'category' => 'Elektronik',
                'purchase_price' => 100000,
                'selling_price' => 135000,
                'stock' => 15,
                'minimum_stock' => 5,
            ],
            [
                'sku' => 'ATK001',
                'name' => 'Buku Tulis',
                'category' => 'Alat Tulis',
                'purchase_price' => 4000,
                'selling_price' => 6000,
                'stock' => 50,
                'minimum_stock' => 10,
            ],
            [
                'sku' => 'ATK002',
                'name' => 'Pulpen',
                'category' => 'Alat Tulis',
                'purchase_price' => 2000,
                'selling_price' => 3500,
                'stock' => 100,
                'minimum_stock' => 20,
            ],
            [
                'sku' => 'KNT001',
                'name' => 'Kertas A4',
                'category' => 'Perlengkapan Kantor',
                'purchase_price' => 45000,
                'selling_price' => 55000,
                'stock' => 25,
                'minimum_stock' => 5,
            ],
            [
                'sku' => 'AKS001',
                'name' => 'Flashdisk 32GB',
                'category' => 'Aksesoris Komputer',
                'purchase_price' => 60000,
                'selling_price' => 85000,
                'stock' => 12,
                'minimum_stock' => 3,
            ],
            [
                'sku' => 'RTG001',
                'name' => 'Lampu LED',
                'category' => 'Peralatan Rumah Tangga',
                'purchase_price' => 15000,
                'selling_price' => 22000,
                'stock' => 30,
                'minimum_stock' => 5,
            ],
        ];

        foreach ($products as $item) {
            $category = Category::where(
                'name',
                $item['category']
            )->firstOrFail();

            Product::firstOrCreate(
                ['sku' => $item['sku']],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'purchase_price' => $item['purchase_price'],
                    'selling_price' => $item['selling_price'],
                    'stock' => $item['stock'],
                    'minimum_stock' => $item['minimum_stock'],
                ]
            );
        }
    }
}
