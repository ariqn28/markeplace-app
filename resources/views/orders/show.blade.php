<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                👁️ {{ __('Detail Order') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <div class="grid grid-cols-2 gap-6 mb-8 pb-8 border-b border-blue-200">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 mb-2">📦 Order ID</label>
                        <p class="text-lg text-blue-600 font-bold">#{{ $order->id }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 mb-2">👤 User</label>
                        <p class="text-blue-800 font-semibold">{{ $order->user->name }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 mb-2">📋 Status</label>
                        <span class="px-3 py-1 rounded text-sm font-semibold
                            @if($order->status == 'pending') bg-yellow-200 text-yellow-800
                            @elseif($order->status == 'processing') bg-blue-200 text-blue-800
                            @elseif($order->status == 'completed') bg-green-200 text-green-800
                            @else bg-red-200 text-red-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 mb-2">💰 Total Harga</label>
                        <p class="text-lg text-blue-600 font-bold">Rp{{ number_format($order->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-bold text-blue-900 mb-4">📊 Detail Order Items</h3>
                    @if($order->orderItems->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-blue-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left font-semibold text-blue-900">📦 Produk</th>
                                        <th class="px-4 py-3 text-left font-semibold text-blue-900">Qty</th>
                                        <th class="px-4 py-3 text-left font-semibold text-blue-900">💰 Harga</th>
                                        <th class="px-4 py-3 text-left font-semibold text-blue-900">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->orderItems as $item)
                                        <tr class="border-b border-blue-100 hover:bg-blue-50">
                                            <td class="px-4 py-3 text-blue-800">{{ $item->product->name }}</td>
                                            <td class="px-4 py-3 text-blue-800">{{ $item->quantity }}</td>
                                            <td class="px-4 py-3 text-blue-800">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td class="px-4 py-3 font-bold text-blue-600">Rp{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-blue-600 italic">Tidak ada order item</p>
                    @endif
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('orders.edit', $order->id) }}" class="flex-1 bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                        ✏️ Edit
                    </a>
                    <a href="{{ route('orders.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                        ↩️ Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
