<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="font-bold text-3xl text-white">
                {{ __('Katalog Produk') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Pesan Sukses/Error -->
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Search & Filter Section -->
            <div class="mb-8 bg-white p-6 rounded-xl shadow-xl">
                <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center">
                    <div class="flex-1 w-full relative">
                        <input type="text" id="search-input" name="search" value="{{ request('search') }}" placeholder="Cari produk yang Anda inginkan..." autocomplete="off" class="w-full pl-4 pr-10 py-2 border-2 border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <div id="search-results" class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden max-h-60 overflow-y-auto"></div>
                    </div>
                    
                    <div class="w-full md:w-1/4">
                        <select name="category" class="w-full border border-gray-300 rounded-lg py-2 px-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition" onchange="this.form.submit()">
                            <option value="" class="text-gray-700">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition shadow-lg">
                        Cari
                    </button>
                    
                    @if(request('search') || request('category'))
                        <a href="{{ route('dashboard') }}" class="w-full md:w-auto text-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-2 px-4 rounded-lg transition border border-gray-300 shadow-md">
                            Reset
                        </a>
                    @endif
                </form>
            </div>

            <!-- Grid Produk -->
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    <div class="bg-white overflow-hidden shadow-lg rounded-xl flex flex-col h-full transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        <!-- Gambar Placeholder (bisa diganti storage jika ada upload gambar) -->
                        <div class="h-48 bg-gray-100 flex items-center justify-center overflow-hidden border-b border-gray-200">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @endif
                        </div>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <h3 class="text-xl font-extrabold text-gray-900 mb-1">{{ $product->name }}</h3>
                            <p class="text-xs text-blue-600 font-semibold mb-2">{{ $product->category->name ?? 'Umum' }}</p>
                            <p class="text-gray-700 text-sm flex-1 mb-4">{{ Str::limit($product->description, 70) }}</p>
                            
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-xl font-bold text-blue-700">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-sm text-gray-600">Stok: {{ $product->stock }}</span>
                            </div>

                            <div class="mt-auto flex gap-2">
                                <a href="{{ route('user.orders.create', $product->id) }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg text-center transition duration-150 ease-in-out border border-gray-300 shadow-sm">
                                    Beli
                                </a>
                                <form action="{{ route('cart.store') }}" method="POST" class="flex-1" onsubmit="this.querySelector('button').disabled = true; this.querySelector('button').innerText = 'Menambahkan...';">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-150 ease-in-out">
                                        + Keranjang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 p-4 bg-white rounded-xl shadow-lg">
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');

            searchInput.addEventListener('input', function() {
                const query = this.value;
                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    searchResults.innerHTML = '';
                    return;
                }

                fetch(`{{ route('products.search') }}?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        if (data.length > 0) {
                            searchResults.classList.remove('hidden');
                            data.forEach(product => {
                                const item = document.createElement('div');
                                item.classList.add('px-4', 'py-2', 'hover:bg-blue-50', 'cursor-pointer', 'border-b', 'last:border-b-0', 'text-gray-700');
                                item.textContent = product.name;
                                item.addEventListener('click', function() {
                                    searchInput.value = product.name;
                                    searchResults.classList.add('hidden');
                                    searchInput.form.submit();
                                });
                                searchResults.appendChild(item);
                            });
                        } else {
                            searchResults.classList.add('hidden');
                        }
                    });
            });

            // Sembunyikan hasil saat klik di luar
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                    searchResults.classList.add('hidden');
                }
            });
        });
    </script>
</x-app-layout>