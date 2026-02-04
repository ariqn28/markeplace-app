<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserOrderController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Semua route web aplikasi marketplace.
|
*/

// Halaman welcome
Route::get('/', function () {
    return view('welcome');
});

// Route untuk Autocomplete Search (Public)
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// Dashboard utama (bisa diarahkan sesuai role)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group route dengan middleware auth
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Admin Dashboard Routes
    |--------------------------------------------------------------------------
    | CRUD untuk kategori, produk, order, order item
    | Hanya bisa diakses oleh admin (middleware isAdmin)
    */
    Route::middleware('isAdmin')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('order-items', OrderItemController::class);

        // Opsional: route khusus update status order
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');
    });

    /*
    |--------------------------------------------------------------------------
    | User Dashboard Routes
    |--------------------------------------------------------------------------
    | Riwayat pesanan milik user login
    */
    Route::get('/my-orders', [UserOrderController::class, 'index'])->name('user.orders.index');
    Route::get('/my-orders/{order}', [UserOrderController::class, 'show'])->name('user.orders.show');
    
    // Payment Routes
    Route::get('/my-orders/{order}/payment', [UserOrderController::class, 'showPayment'])->name('user.orders.payment');
    Route::post('/my-orders/{order}/payment', [UserOrderController::class, 'processPayment'])->name('user.orders.pay');
    Route::get('/my-orders/{order}/receipt', [UserOrderController::class, 'showReceipt'])->name('user.orders.receipt');

    // Route untuk User melakukan Order (Beli Produk)
    Route::get('/order/create/{product}', [UserOrderController::class, 'create'])->name('user.orders.create');
    Route::post('/order/store', [UserOrderController::class, 'store'])->name('user.orders.store');

    // Route Keranjang Belanja (Cart)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Route bawaan untuk auth (login, register, dll)
require __DIR__.'/auth.php';