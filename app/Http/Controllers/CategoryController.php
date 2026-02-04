<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Tampilkan semua kategori.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Detail kategori.
     */
    public function show($id)
    {
        $category = Category::with('products')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Form edit kategori.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update kategori.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Hapus kategori.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'Kategori berhasil dihapus.');
    }
}
