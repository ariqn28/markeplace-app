<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Produk gadget dan elektronik'],
            ['name' => 'Fashion', 'description' => 'Pakaian dan aksesoris'],
            ['name' => 'Makanan', 'description' => 'Produk makanan dan minuman'],
            ['name' => 'Olahraga', 'description' => 'Peralatan olahraga'],
            ['name' => 'Rumah Tangga', 'description' => 'Perabotan rumah'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
