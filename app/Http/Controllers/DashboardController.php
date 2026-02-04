<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan:
     * - Statistik jumlah produk, kategori, dan order
     * - Produk terbaru
     * - Order terbaru
     * - Data kategori untuk grafik Chart.js
     * - Tambahan: total revenue & distribusi order per kategori
     */
    public function index()
    {
        // LOGIC USER: Jika bukan admin, tampilkan katalog produk untuk order
        // Pastikan tabel users memiliki kolom 'role' atau sesuaikan kondisinya
        if (!Auth::user()->is_admin) {
            $query = Product::where('stock', '>', 0);
            if (request('search')) {
                $query->where('name', 'like', '%' . request('search') . '%');
            }
            if (request('category')) {
                $query->where('category_id', request('category'));
            }

            $products = $query->latest()->paginate(8);
            $categories = Category::all();
            return view('user.dashboard', compact('products', 'categories'));
        }

        // LOGIC ADMIN: Tampilkan statistik
        // Statistik jumlah entitas
        $productsCount   = Product::count();
        $categoriesCount = Category::count();
        $ordersCount     = Order::count();
        // Balance: Hanya hitung order yang statusnya bukan pending atau cancelled (uang masuk)
        $totalRevenue    = Order::whereNotIn('status', ['pending', 'cancelled'])->sum('total_price');

        // Produk terbaru (5 item)
        $latestProductsQuery = Product::with('category')->latest();
        if (request('search')) {
            $latestProductsQuery->where('name', 'like', '%' . request('search') . '%');
        }
        $latestProducts = $latestProductsQuery->take(5)->get();

        // Order terbaru (5 item)
        $latestOrders    = Order::latest()
                                ->take(5)
                                ->get();

        // Data kategori untuk grafik produk per kategori
        $categories      = Category::withCount('products')->get();
        $categoryNames   = $categories->pluck('name')->toArray();
        $productCounts   = $categories->pluck('products_count')->toArray();

        // Data order per kategori (grafik tambahan)
        $orderPerCategory = Category::withCount(['products as orders_count' => function ($query) {
            $query->join('order_items', 'products.id', '=', 'order_items.product_id');
        }])->get();

        $orderCategoryNames = $orderPerCategory->pluck('name')->toArray();
        $orderCounts        = $orderPerCategory->pluck('orders_count')->toArray();

        // Kirim semua data ke view dashboard.blade.php
        return view('dashboard', compact(
            'productsCount',
            'categoriesCount',
            'ordersCount',
            'totalRevenue',
            'latestProducts',
            'latestOrders',
            'categoryNames',
            'productCounts',
            'orderCategoryNames',
            'orderCounts'
        ));
    }
}
