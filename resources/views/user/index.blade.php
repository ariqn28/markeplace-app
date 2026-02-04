<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                📦 {{ __('Riwayat Pesanan Saya') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <p class="font-semibold">{{ $message }}</p>
                </div>
            @endif

            @if($orders->isEmpty())
                <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                    <div class="text-6xl mb-4">🛍️</div>
                    <h3 class="text-xl font-bold text-gray-700 mb-2">Belum ada pesanan</h3>
                    <p class="text-gray-500 mb-6">Anda belum pernah melakukan transaksi apapun.</p>
                    <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition shadow-md">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full">
                            <thead class="bg-blue-50 border-b border-blue-100">
                                <tr>
                                    <th class="px-6 py-4 text-left text-blue-900 font-bold">Order ID</th>
                                    <th class="px-6 py-4 text-left text-blue-900 font-bold">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-blue-900 font-bold">Total Harga</th>
                                    <th class="px-6 py-4 text-left text-blue-900 font-bold">Status</th>
                                    <th class="px-6 py-4 text-left text-blue-900 font-bold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($orders as $order)
                                    <tr class="hover:bg-blue-50 transition">
                                        <td class="px-6 py-4 font-bold text-gray-700">#{{ $order->id }}</td>
                                        <td class="px-6 py-4 text-gray-600">
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4 font-bold text-blue-600">
                                            Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusClasses = [
                                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                                    'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                                    'completed' => 'bg-green-100 text-green-800 border-green-200',
                                                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                                                ];
                                                $statusClass = $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800';
                                                
                                                $statusLabels = [
                                                    'pending' => 'Menunggu Pembayaran',
                                                    'processing' => 'Diproses',
                                                    'completed' => 'Selesai',
                                                    'cancelled' => 'Dibatalkan',
                                                ];
                                                $statusLabel = $statusLabels[$order->status] ?? ucfirst($order->status);
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $statusClass }}">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('user.orders.show', $order->id) }}" class="inline-flex items-center bg-white border border-blue-200 text-blue-600 hover:bg-blue-50 font-semibold py-1 px-4 rounded-lg transition shadow-sm">
                                                👁️ Detail
                                            </a>
                                            @if($order->status == 'pending')
                                                <a href="{{ route('user.orders.payment', $order->id) }}" class="inline-flex items-center ml-2 bg-blue-600 text-white hover:bg-blue-700 font-semibold py-1 px-4 rounded-lg transition shadow-sm">
                                                    💳 Bayar
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-6 bg-gray-50 border-t border-gray-100">
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>