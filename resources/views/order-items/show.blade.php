<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                👁️ {{ __('Detail Order Item') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">📦 Order ID</label>
                    <p class="text-blue-800 font-semibold">#{{ $orderItem->order->id }}</p>
                </div>

                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">📦 Produk</label>
                    <p class="text-blue-800 font-semibold">{{ $orderItem->product->name }}</p>
                </div>

                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">📊 Jumlah (Qty)</label>
                    <p class="text-lg text-blue-600 font-bold">{{ $orderItem->quantity }} unit</p>
                </div>

                <div class="mb-5 pb-4 border-b border-blue-200">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">💰 Harga per Unit</label>
                    <p class="text-blue-800">Rp{{ number_format($orderItem->price, 0, ',', '.') }}</p>
                </div>

                <div class="mb-6 pb-4">
                    <label class="block text-sm font-semibold text-blue-900 mb-2">🧮 Subtotal</label>
                    <p class="text-lg text-blue-600 font-bold">Rp{{ number_format($orderItem->quantity * $orderItem->price, 0, ',', '.') }}</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('order-items.edit', $orderItem->id) }}" class="flex-1 bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                        ✏️ Edit
                    </a>
                    <a href="{{ route('order-items.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                        ↩️ Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
