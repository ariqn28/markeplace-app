<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan semua seeder sesuai urutan
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
        ]);

        // Recalculate total_price per order
        foreach (Order::with('orderItems')->get() as $order) {
            $order->update([
                'total_price' => $order->orderItems->sum(
                    fn($item) => $item->quantity * $item->price
                ),
            ]);
        }
    }
}
