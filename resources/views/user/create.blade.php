<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Konfirmasi Pembelian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h3 class="text-lg font-bold mb-4">Produk yang akan dibeli:</h3>
                    
                    <div class="flex items-center mb-6 border p-4 rounded-lg bg-gray-50">
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-800">{{ $product->name }}</h4>
                            <p class="text-gray-600">{{ $product->category->name ?? 'Umum' }}</p>
                            <p class="text-blue-600 font-bold mt-2 text-lg">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                            <p class="text-sm text-gray-500 mt-1">Sisa Stok: {{ $product->stock }}</p>
                        </div>
                    </div>

                    <form action="{{ route('user.orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="mb-4">
                            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Pembelian:</label>
                            <input type="number" name="quantity" id="quantity" min="1" max="{{ $product->stock }}" value="1" 
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="flex items-center justify-between mt-6">
                            <a href="{{ route('dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition shadow">
                                Batal
                            </a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded focus:outline-none focus:shadow-outline transition">
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>