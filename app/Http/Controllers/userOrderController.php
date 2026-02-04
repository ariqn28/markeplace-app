<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class UserOrderController extends Controller
{
    /**
     * Tampilkan daftar order milik user login.
     */
    public function index()
    {
        // Ambil semua order milik user login, lengkap dengan item & produk
        $orders = Order::with('orderItems.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.index', compact('orders'));
    }

    /**
     * Tampilkan detail order tertentu milik user login.
     */
    public function show(Order $order)
    {
        // Pastikan order memang milik user login
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Anda tidak berhak melihat order ini.');
        }

        $order->load('orderItems.product');

        return view('user.show', compact('order'));
    }

    /**
     * Tampilkan form untuk membuat order baru (User).
     */
    public function create(Product $product)
    {
        return view('user.create', compact('product'));
    }

    /**
     * Simpan order baru dari User.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek stok
        if ($product->stock < $request->quantity) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi. Sisa stok: ' . $product->stock]);
        }

        // Buat Order
        $order = Order::create([
            'user_id'     => auth()->id(),
            'status'      => 'pending',
            'total_price' => $product->price * $request->quantity,
        ]);

        // Buat Order Item
        $order->orderItems()->create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'price'      => $product->price,
        ]);

        // Kurangi Stok
        $product->decrement('stock', $request->quantity);

        return redirect()->route('user.orders.index')
                         ->with('success', 'Pesanan berhasil dibuat! Menunggu konfirmasi admin.');
    }

    /**
     * Tampilkan halaman pembayaran.
     */
    public function showPayment(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        if ($order->status !== 'pending') return redirect()->route('user.orders.show', $order);

        return view('user.payment', compact('order'));
    }

    /**
     * Proses pembayaran (Simulasi).
     */
    public function processPayment(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);

        // Validasi metode pembayaran dipilih
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,ewallet,credit_card',
        ]);
        
        // Update status menjadi 'processing' atau 'completed'
        $order->update(['status' => 'processing']);

        return redirect()->route('user.orders.receipt', $order)->with('success', 'Pembayaran berhasil!');
    }

    /**
     * Tampilkan struk pembayaran.
     */
    public function showReceipt(Order $order)
    {
        if ($order->user_id !== auth()->id()) abort(403);
        
        return view('user.receipt', compact('order'));
    }
}