<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-3xl text-white">
                    {{ __('Manajemen Produk') }}
                </h2>
                <a href="{{ route('products.create') }}" class="bg-white hover:bg-blue-50 text-blue-900 font-bold py-2 px-6 rounded-lg transition shadow-md">
                    + Tambah Produk
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <p class="font-semibold">{{ $message }}</p>
                </div>
            @endif

            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="bg-gradient-to-r from-blue-600 to-blue-500 px-6 py-4">
                    <h3 class="text-lg font-bold text-white">📦 Daftar Produk</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="bg-blue-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-blue-900 font-bold">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-blue-900 font-bold">Kategori</th>
                                <th class="px-6 py-3 text-left text-blue-900 font-bold">Harga</th>
                                <th class="px-6 py-3 text-left text-blue-900 font-bold">Stok</th>
                                <th class="px-6 py-3 text-left text-blue-900 font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                                <tr class="border-b hover:bg-blue-50 transition">
                                    <td class="px-6 py-3 text-gray-900 font-semibold">{{ $product->name }}</td>
                                    <td class="px-6 py-3"><span class="bg-blue-200 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">{{ $product->category->name }}</span></td>
                                    <td class="px-6 py-3 font-bold text-blue-600">Rp{{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-3 text-gray-700">{{ $product->stock }} unit</td>
                                    <td class="px-6 py-3 space-x-2">
                                        <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 text-white py-1 px-3 rounded text-sm">
                                            👁️ Lihat
                                        </a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="bg-yellow-500 text-white py-1 px-3 rounded text-sm">
                                            ✏️ Edit
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded text-sm" onclick="return confirm('Yakin ingin hapus?')">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="bg-blue-50 px-6 py-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
