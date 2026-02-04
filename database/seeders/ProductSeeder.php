<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            ['name' => 'Laptop Gaming', 'description' => 'Laptop dengan GPU RTX', 'price' => 15000000, 'stock' => 10, 'category_id' => 1],
            ['name' => 'Smartphone', 'description' => 'Android terbaru', 'price' => 5000000, 'stock' => 20, 'category_id' => 1],
            ['name' => 'Kaos Polos', 'description' => 'Kaos bahan katun', 'price' => 75000, 'stock' => 50, 'category_id' => 2],
            ['name' => 'Sepatu Sneakers', 'description' => 'Sneakers casual', 'price' => 300000, 'stock' => 30, 'category_id' => 2],
            ['name' => 'Keripik Kentang', 'description' => 'Snack ringan', 'price' => 15000, 'stock' => 100, 'category_id' => 3],
            ['name' => 'Minuman Soda', 'description' => 'Minuman berkarbonasi', 'price' => 10000, 'stock' => 80, 'category_id' => 3],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
