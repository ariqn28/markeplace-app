<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Tampilkan semua order.
     */
    public function index(Request $request)
    {
        $query = Order::with('user');

        // Filter Status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }

        // Filter Tanggal
        if ($request->date_start) {
            $query->whereDate('created_at', '>=', $request->date_start);
        }

        // Search (ID Order atau Nama User)
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('id', 'like', '%' . $request->search . '%')
                  ->orWhereHas('user', fn($u) => $u->where('name', 'like', '%' . $request->search . '%'));
            });
        }

        $orders = $query->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Form buat order baru.
     */
    public function create()
    {
        $users = User::all();
        return view('orders.create', compact('users'));
    }

    /**
     * Simpan order baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'status'     => 'required|in:pending,processing,completed,cancelled',
            'total_price' => 'required|numeric|min:0',
        ]);

        Order::create($validated);

        return redirect()->route('orders.index')
                         ->with('success', 'Order berhasil dibuat.');
    }

    /**
     * Detail order.
     */
    public function show($id)
    {
        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    /**
     * Form edit order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $users = User::all();
        return view('orders.edit', compact('order', 'users'));
    }

    /**
     * Update order.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id'    => 'required|exists:users,id',
            'status'     => 'required|in:pending,processing,completed,cancelled',
            'total_price' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);

        return redirect()->route('orders.index')
                         ->with('success', 'Order berhasil diperbarui.');
    }

    /**
     * Update status order (Khusus Admin).
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan #' . $order->id . ' berhasil diperbarui menjadi ' . ucfirst($request->status));
    }

    /**
     * Hapus order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')
                         ->with('success', 'Order berhasil dihapus.');
    }
}
