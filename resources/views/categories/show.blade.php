<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                👁️ {{ __('Detail Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">📝 Nama Kategori</label>
                    <p class="text-blue-800 font-semibold">{{ $category->name }}</p>
                </div>

                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">📄 Deskripsi</label>
                    <p class="text-blue-800">{{ $category->description ?? '-' }}</p>
                </div>

                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">📊 Jumlah Produk</label>
                    <p class="text-lg text-blue-600 font-bold">{{ $category->products->count() }} produk</p>
                </div>

                @if($category->products->count() > 0)
                    <div class="mb-6 pb-4">
                        <label class="block text-sm font-semibold text-blue-900 mb-3">📦 Produk dalam Kategori</label>
                        <div class="grid gap-2">
                            @foreach($category->products as $product)
                                <div class="bg-blue-50 border-l-4 border-blue-500 p-3 rounded">
                                    <p class="text-blue-800">{{ $product->name }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="flex gap-3">
                    <a href="{{ route('categories.edit', $category->id) }}" class="flex-1 bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                        ✏️ Edit
                    </a>
                    <a href="{{ route('categories.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                        ↩️ Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
