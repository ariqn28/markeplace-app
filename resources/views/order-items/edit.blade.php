<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                ✏️ {{ __('Edit Order Item') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <form action="{{ route('order-items.update', $orderItem->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="order_id" class="block text-sm font-semibold text-blue-900 mb-2">
                            📦 Order
                        </label>
                        <select id="order_id" name="order_id" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                            <option value="">Pilih Order</option>
                            @foreach($orders as $order)
                                <option value="{{ $order->id }}" {{ old('order_id', $orderItem->order_id) == $order->id ? 'selected' : '' }}>
                                    Order #{{ $order->id }} - {{ $order->user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('order_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="product_id" class="block text-sm font-semibold text-blue-900 mb-2">
                            📦 Produk
                        </label>
                        <select id="product_id" name="product_id" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                            <option value="">Pilih Produk</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id', $orderItem->product_id) == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }} - Rp{{ number_format($product->price, 0, ',', '.') }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="quantity" class="block text-sm font-semibold text-blue-900 mb-2">
                            📊 Jumlah (Qty)
                        </label>
                        <input type="number" id="quantity" name="quantity" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('quantity', $orderItem->quantity) }}" placeholder="1" required>
                        @error('quantity')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="price" class="block text-sm font-semibold text-blue-900 mb-2">
                            💰 Harga per Unit (Rp)
                        </label>
                        <input type="number" id="price" name="price" step="0.01" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('price', $orderItem->price) }}" placeholder="0" required>
                        @error('price')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            ✅ Update
                        </button>
                        <a href="{{ route('order-items.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
</x-app-layout>
