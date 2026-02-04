<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $orders = [
            ['user_id' => 1, 'status' => 'pending', 'total_price' => 0],
            ['user_id' => 1, 'status' => 'paid', 'total_price' => 0],
            ['user_id' => 2, 'status' => 'shipped', 'total_price' => 0],
        ];

        foreach ($orders as $order) {
            Order::create($order);
        }
    }
}
