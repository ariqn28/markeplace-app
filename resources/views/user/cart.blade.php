<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Keranjang Belanja') }}
        </h2>
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(empty($cartItems) || count($cartItems) == 0)
                        <div class="text-center py-10">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="mt-2 text-gray-500 text-lg">Keranjang belanja Anda kosong.</p>
                            <a href="{{ route('dashboard') }}" class="mt-4 inline-block text-blue-600 hover:underline">Mulai Belanja &rarr;</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produk</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @php $total = 0; @endphp
                                    @foreach($cartItems as $item)
                                        @php $subtotal = $item->product->price * $item->quantity; $total += $subtotal; @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->product->name }}</div>
                                                <div class="text-sm text-gray-500">{{ $item->product->category->name ?? 'Umum' }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm text-gray-500">
                                                Rp{{ number_format($item->product->price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-bold text-gray-900">
                                                Rp{{ number_format($subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <div class="w-full md:w-1/3 bg-gray-50 p-6 rounded-lg">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-lg font-bold text-gray-700">Total Belanja</span>
                                    <span class="text-2xl font-bold text-blue-600">Rp{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                <form action="{{ route('cart.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition shadow-lg">
                                        Checkout Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>