<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                ✏️ {{ __('Edit Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-semibold text-blue-900 mb-2">
                            📝 Nama Produk
                        </label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="description" class="block text-sm font-semibold text-blue-900 mb-2">
                            📄 Deskripsi
                        </label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="image" class="block text-sm font-semibold text-blue-900 mb-2">
                            🖼️ Gambar Produk
                        </label>
                        @if($product->image)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="h-32 w-auto object-cover rounded-lg border border-gray-300 shadow-sm">
                                <p class="text-xs text-gray-500 mt-1">Gambar saat ini</p>
                                <div class="mt-2">
                                    <input type="checkbox" name="remove_image" id="remove_image" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                                    <label for="remove_image" class="ml-2 text-sm text-red-600 font-semibold">Hapus gambar saat ini</label>
                                </div>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" accept="image/*">
                        <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                        @error('image')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="category_id" class="block text-sm font-semibold text-blue-900 mb-2">
                            📂 Kategori
                        </label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="price" class="block text-sm font-semibold text-blue-900 mb-2">
                            💰 Harga (Rp)
                        </label>
                        <input type="number" id="price" name="price" step="0.01" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="stock" class="block text-sm font-semibold text-blue-900 mb-2">
                            📊 Stok
                        </label>
                        <input type="number" id="stock" name="stock" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 transition">
                            ✅ Update
                        </button>
                        <a href="{{ route('products.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center hover:bg-gray-500 transition">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>