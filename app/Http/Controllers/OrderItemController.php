<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

class OrderItemController extends Controller
{
    /**
     * Tampilkan semua order item.
     */
    public function index()
    {
        $orderItems = OrderItem::with(['order', 'product'])->paginate(10);
        return view('order-items.index', compact('orderItems'));
    }

    /**
     * Form buat order item baru.
     */
    public function create()
    {
        $orders = Order::all();
        $products = Product::all();
        return view('order-items.create', compact('orders', 'products'));
    }

    /**
     * Simpan order item baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        OrderItem::create($validated);

        return redirect()->route('order-items.index')
                         ->with('success', 'Order item berhasil ditambahkan.');
    }

    /**
     * Detail order item.
     */
    public function show($id)
    {
        $orderItem = OrderItem::with(['order', 'product'])->findOrFail($id);
        return view('order-items.show', compact('orderItem'));
    }

    /**
     * Form edit order item.
     */
    public function edit($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orders = Order::all();
        $products = Product::all();
        return view('order-items.edit', compact('orderItem', 'orders', 'products'));
    }

    /**
     * Update order item.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'order_id'   => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'price'      => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update($validated);

        return redirect()->route('order-items.index')
                         ->with('success', 'Order item berhasil diperbarui.');
    }

    /**
     * Hapus order item.
     */
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return redirect()->route('order-items.index')
                         ->with('success', 'Order item berhasil dihapus.');
    }
}
