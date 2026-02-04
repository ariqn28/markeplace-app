<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Tampilkan isi keranjang
    public function index()
    {
        // Proteksi: Admin tidak boleh masuk keranjang
        if (Auth::user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Admin tidak memiliki fitur keranjang.');
        }

        $cartItems = CartItem::with('product')->where('user_id', Auth::id())->get();
        return view('cart.index', compact('cartItems'));
    }

    // Tambah produk ke keranjang
    public function store(Request $request)
    {
        if (Auth::user()->is_admin) {
            return back()->with('error', 'Admin tidak dapat berbelanja.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek apakah produk sudah ada di keranjang user ini
        $cartItem = CartItem::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            // Jika sudah ada, update quantity
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($newQuantity > $product->stock) {
                return back()->with('error', 'Stok tidak mencukupi untuk menambah jumlah tersebut.');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            // Jika belum ada, buat baru
            if ($request->quantity > $product->stock) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }
            CartItem::create([
                'user_id'    => Auth::id(),
                'product_id' => $product->id,
                'quantity'   => $request->quantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return back()->with('success', 'Item dihapus dari keranjang.');
    }

    // Proses Checkout (Beli semua yang ada di keranjang)
    public function checkout(Request $request)
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('dashboard');
        }

        $request->validate([
            'selected_items' => 'required|array|min:1',
        ], [
            'selected_items.required' => 'Pilih setidaknya satu produk untuk di-checkout.',
        ]);

        $cartItems = CartItem::with('product')
            ->where('user_id', Auth::id())
            ->whereIn('id', $request->selected_items)
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Keranjang belanja Anda kosong.');
        }

        try {
            DB::transaction(function () use ($cartItems) {
                $totalPrice = 0;

                // Hitung total dan validasi stok lagi
                foreach ($cartItems as $item) {
                    if ($item->product->stock < $item->quantity) {
                        throw new \Exception('Stok produk ' . $item->product->name . ' tidak mencukupi.');
                    }
                    $totalPrice += $item->product->price * $item->quantity;
                }

                // Buat Order
                $order = Order::create([
                    'user_id'     => Auth::id(),
                    'status'      => 'pending',
                    'total_price' => $totalPrice,
                ]);

                // Pindahkan item keranjang ke OrderItem & Kurangi Stok
                foreach ($cartItems as $item) {
                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $item->product_id,
                        'quantity'   => $item->quantity,
                        'price'      => $item->product->price,
                    ]);

                    $item->product->decrement('stock', $item->quantity);
                    $item->delete(); // Hapus dari keranjang
                }
            });
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal Checkout: ' . $e->getMessage());
        }

        return redirect()->route('user.orders.index')->with('success', 'Checkout berhasil! Pesanan sedang diproses.');
    }
}