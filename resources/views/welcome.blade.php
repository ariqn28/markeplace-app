<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Marketplace') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased">
    {{-- Navbar --}}
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 border-b-4 border-blue-500 shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="/" class="flex items-center gap-2 shrink-0">
                    <svg class="w-8 h-8 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                    </svg>
                    <span class="text-xl font-bold text-white">Marketplace</span>
                </a>

                {{-- Search Bar --}}
                <div class="hidden md:block flex-1 max-w-lg mx-8">
                    <form action="{{ route('dashboard') }}" method="GET" class="relative" autocomplete="off">
                        <input type="text" id="searchInput" name="search" placeholder="Cari produk..." class="w-full bg-blue-800 text-blue-100 border-none rounded-full py-2 px-4 pr-10 focus:ring-2 focus:ring-blue-400 placeholder-blue-300 focus:outline-none">
                        <button type="submit" class="absolute inset-y-0 right-0 pr-3 flex items-center text-blue-300 hover:text-white transition">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </button>
                        <div id="searchResults" class="absolute w-full bg-white text-gray-900 rounded-lg shadow-lg mt-1 z-50 hidden overflow-hidden border border-gray-200"></div>
                    </form>
                </div>

                <div class="flex items-center space-x-4 shrink-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-white border border-blue-400 hover:bg-blue-600 rounded-lg transition font-semibold">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg">Register</a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="min-h-screen bg-gradient-to-br from-blue-900 via-blue-800 to-blue-600 flex items-center justify-center px-4">
        <div class="max-w-6xl mx-auto text-center">
            <div class="mb-6 animate-bounce">
                <svg class="w-24 h-24 mx-auto text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                </svg>
            </div>
            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Marketplace <span class="text-blue-300">Terpercaya</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Platform marketplace terbaik untuk menjual dan membeli produk berkualitas dengan jaminan keamanan transaksi terpercaya.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-8 py-4 bg-blue-600 text-white font-bold text-lg rounded-lg hover:bg-blue-700 transition shadow-lg border border-blue-400">
                        Akses Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-blue-600 text-white font-bold text-lg rounded-lg hover:bg-blue-700 transition shadow-lg border border-blue-400">
                        Mulai Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="px-8 py-4 bg-blue-500 text-white font-bold text-lg rounded-lg shadow-lg">
                        Login
                    </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-800 bg-opacity-50 backdrop-blur p-6 rounded-lg">
                    <svg class="w-12 h-12 mx-auto text-blue-300 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a1 1 0 011-1h8a1 1 0 011 1v2a1 1 0 11-2 0V8H7v1a1 1 0 11-2 0zm0 4v2a1 1 0 001 1h8a1 1 0 001-1v-2a1 1 0 11 2 0v2a3 3 0 01-3 3H6a3 3 0 01-3-3v-2a1 1 0 112 0z" clip-rule="evenodd"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">Aman & Terpercaya</h3>
                    <p class="text-blue-200">Sistem keamanan berlapis untuk melindungi setiap transaksi Anda</p>
                </div>
                
                <div class="bg-blue-800 bg-opacity-50 backdrop-blur p-6 rounded-lg">
                    <svg class="w-12 h-12 mx-auto text-blue-300 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">Berbagai Pilihan</h3>
                    <p class="text-blue-200">Ribuan produk dari kategori yang beragam tersedia setiap hari</p>
                </div>
                
                <div class="bg-blue-800 bg-opacity-50 backdrop-blur p-6 rounded-lg">
                    <svg class="w-12 h-12 mx-auto text-blue-300 mb-3" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                    <h3 class="text-xl font-bold text-white mb-2">Performa Optimal</h3>
                    <p class="text-blue-200">Sistem yang cepat dan responsif untuk pengalaman berbelanja terbaik</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 px-4 bg-gradient-to-b from-blue-100 to-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-blue-900 mb-16">Fitur Unggulan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-16">
                <div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Manajemen Produk</h3>
                    <p class="text-gray-700 mb-4">Kelola ribuan produk dengan mudah. Tambah, edit, atau hapus produk dalam beberapa klik. Organisir produk berdasarkan kategori untuk kemudahan pencarian.</p>
                    <ul class="space-y-2 text-gray-600">
                        <li>✓ Tambah produk unlimited</li>
                        <li>✓ Kelola stok produk</li>
                        <li>✓ Atur harga fleksibel</li>
                    </ul>
                </div>
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg p-8 text-white shadow-lg">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                    </svg>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg p-8 text-white shadow-lg order-2 md:order-1">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
                <div class="order-1 md:order-2">
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Kelola Order dengan Mudah</h3>
                    <p class="text-gray-700 mb-4">Pantau semua pesanan pelanggan secara real-time. Kelola status order dari pending hingga selesai dengan dashboard intuitif.</p>
                    <ul class="space-y-2 text-gray-600">
                        <li>✓ Lacak order real-time</li>
                        <li>✓ Ubah status order</li>
                        <li>✓ Laporan penjualan lengkap</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-blue-900 text-blue-100 py-8 px-4 text-center">
        <p>&copy; 2026 Marketplace. Semua hak dilindungi.</p>
    </footer>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', function() {
            const query = this.value;
            if (query.length < 2) {
                searchResults.classList.add('hidden');
                return;
            }

            fetch(`/products/search?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    if (data.length > 0) {
                        searchResults.classList.remove('hidden');
                        data.forEach(product => {
                            const div = document.createElement('div');
                            div.className = 'p-3 hover:bg-gray-100 cursor-pointer border-b last:border-b-0 flex justify-between items-center';
                            div.innerHTML = `
                                <span class="font-semibold">${product.name}</span>
                                <span class="text-xs text-blue-600 font-bold">Rp${new Intl.NumberFormat('id-ID').format(product.price)}</span>
                            `;
                            div.addEventListener('click', () => {
                                searchInput.value = product.name;
                                searchResults.classList.add('hidden');
                                searchInput.closest('form').submit();
                            });
                            searchResults.appendChild(div);
                        });
                    } else {
                        searchResults.classList.add('hidden');
                    }
                });
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
