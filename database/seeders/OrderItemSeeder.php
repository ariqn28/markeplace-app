<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        $items = [
            ['order_id' => 1, 'product_id' => 1, 'quantity' => 2, 'price' => 15000000],
            ['order_id' => 1, 'product_id' => 3, 'quantity' => 5, 'price' => 75000],
            ['order_id' => 2, 'product_id' => 2, 'quantity' => 1, 'price' => 5000000],
            ['order_id' => 3, 'product_id' => 4, 'quantity' => 2, 'price' => 300000],
        ];

        foreach ($items as $item) {
            OrderItem::create($item);
        }
    }
}
