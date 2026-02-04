<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg flex justify-between items-center">
            <h2 class="text-2xl font-bold text-white">
                🧾 {{ __('Detail Pesanan') }} #{{ $order->id }}
            </h2>
            <a href="{{ route('user.orders.index') }}" class="bg-white/20 hover:bg-white/30 text-white font-semibold py-2 px-4 rounded-lg transition backdrop-blur-sm">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Info Status & Total -->
            <div class="bg-white shadow-xl rounded-xl p-6 mb-6 border-l-4 {{ $order->status == 'pending' ? 'border-yellow-400' : ($order->status == 'completed' ? 'border-green-500' : 'border-blue-500') }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Tanggal Pesanan</p>
                        <p class="text-lg font-bold text-gray-800">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Status</p>
                        @php
                            $statusColors = [
                                'pending' => 'text-yellow-600',
                                'processing' => 'text-blue-600',
                                'completed' => 'text-green-600',
                                'cancelled' => 'text-red-600',
                            ];
                            $statusLabel = [
                                'pending' => 'Menunggu Pembayaran',
                                'processing' => 'Sedang Diproses',
                                'completed' => 'Selesai',
                                'cancelled' => 'Dibatalkan',
                            ];
                        @endphp
                        <p class="text-lg font-bold {{ $statusColors[$order->status] ?? 'text-gray-800' }}">
                            {{ $statusLabel[$order->status] ?? ucfirst($order->status) }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Total Pembayaran</p>
                        <p class="text-2xl font-bold text-blue-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                @if($order->status == 'pending')
                    <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end">
                        <a href="{{ route('user.orders.payment', $order->id) }}" class="bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 transition animate-pulse">
                            💳 Lanjutkan Pembayaran
                        </a>
                    </div>
                @endif
            </div>

            <!-- Daftar Item -->
            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                    <h3 class="font-bold text-gray-700">Rincian Produk</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white border-b border-gray-100 text-gray-500 text-sm uppercase tracking-wider">
                                <th class="px-6 py-4 font-semibold">Produk</th>
                                <th class="px-6 py-4 font-semibold text-right">Harga Satuan</th>
                                <th class="px-6 py-4 font-semibold text-center">Qty</th>
                                <th class="px-6 py-4 font-semibold text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($order->orderItems as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-gray-800">{{ $item->product->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $item->product->category->name ?? 'Umum' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-right text-gray-600">
                                        Rp{{ number_format($item->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-gray-800">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-6 py-4 text-right font-bold text-blue-600">
                                        Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>