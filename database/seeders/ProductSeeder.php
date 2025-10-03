<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Air Mineral 300ml',
                'volume' => 300,
                'price' => 1000,
                'is_active' => true,
                'description' => 'Air mineral kemasan 300ml'
            ],
            [
                'name' => 'Air Mineral 500ml',
                'volume' => 500,
                'price' => 1500,
                'is_active' => true,
                'description' => 'Air mineral kemasan 500ml'
            ],
            [
                'name' => 'Air Mineral 800ml',
                'volume' => 800,
                'price' => 2000,
                'is_active' => true,
                'description' => 'Air mineral kemasan 800ml'
            ],
            [
                'name' => 'Air Mineral 1000ml',
                'volume' => 1000,
                'price' => 2500,
                'is_active' => true,
                'description' => 'Air mineral kemasan 1000ml - 1 Liter'
            ],
            [
                'name' => 'Air Mineral 1500ml',
                'volume' => 1500,
                'price' => 3000,
                'is_active' => true,
                'description' => 'Air mineral kemasan 1500ml - 1.5 Liter'
            ],
            [
                'name' => 'Air Mineral 1800ml',
                'volume' => 1800,
                'price' => 3500,
                'is_active' => true,
                'description' => 'Air mineral kemasan 1800ml - 1.8 Liter'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}