<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Statistik Utama -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Pendapatan -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Pendapatan</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</div>
                </div>

                <!-- Total Order -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Pesanan</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $ordersCount }}</div>
                </div>

                <!-- Total Produk -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Produk</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $productsCount }}</div>
                </div>

                <!-- Total Kategori -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm font-medium uppercase">Total Kategori</div>
                    <div class="mt-2 text-3xl font-bold text-gray-900">{{ $categoriesCount }}</div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Distribusi Produk per Kategori</h3>
                    <canvas id="productsChart"></canvas>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Pesanan per Kategori</h3>
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>

            <!-- Tabel Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Order Terbaru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Pesanan Terbaru</h3>
                        <a href="{{ route('orders.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-200">
                            @foreach($latestOrders as $order)
                                <li class="py-3 flex justify-between items-center">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Order #{{ $order->id }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->user->name }} • {{ $order->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-gray-900">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : ($order->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Produk Terbaru -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">Produk Baru Ditambahkan</h3>
                        <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-gray-200">
                            @foreach($latestProducts as $product)
                                <li class="py-3 flex items-center">
                                    @if($product->image)
                                        <img class="h-10 w-10 rounded-full object-cover mr-3" src="{{ asset('storage/' . $product->image) }}" alt="">
                                    @else
                                        <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center mr-3 text-gray-500">
                                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
                                    </div>
                                    <div class="text-sm font-bold text-gray-900">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxProducts = document.getElementById('productsChart').getContext('2d');
        new Chart(ctxProducts, {
            type: 'doughnut',
            data: {
                labels: @json($categoryNames),
                datasets: [{
                    label: 'Jumlah Produk',
                    data: @json($productCounts),
                    backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#EC4899'],
                }]
            }
        });

        const ctxOrders = document.getElementById('ordersChart').getContext('2d');
        new Chart(ctxOrders, {
            type: 'bar',
            data: {
                labels: @json($orderCategoryNames),
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: @json($orderCounts),
                    backgroundColor: '#3B82F6',
                }]
            },
            options: { scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } } }
        });
    </script>
</x-app-layout>