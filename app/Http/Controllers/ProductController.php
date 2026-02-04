<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Tampilkan semua produk.
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Form tambah produk.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Simpan produk baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Detail produk.
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Form edit produk.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update produk.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        $product = Product::findOrFail($id);

        // Logika untuk update/hapus gambar
        if ($request->hasFile('image')) {
            // Jika ada gambar baru, hapus yang lama
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Simpan gambar baru
            $validated['image'] = $request->file('image')->store('products', 'public');
        } elseif ($request->has('remove_image')) {
            // Jika tidak ada gambar baru TAPI ada request hapus gambar
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Set path gambar jadi null
            $validated['image'] = null;
        }

        $product->update($validated);

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * API untuk autocomplete search.
     */
    public function search(Request $request)
    {
        $query = $request->get('query');
        
        if (!$query) {
            return response()->json([]);
        }

        $products = Product::where('name', 'like', "%{$query}%")
                           ->limit(5)
                           ->get();

        return response()->json($products);
    }
}
