<x-app-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-2xl sm:rounded-lg overflow-hidden relative">
                <!-- Header Struk -->
                <div class="bg-blue-600 p-6 text-center text-white relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full bg-blue-700 opacity-20 transform -skew-y-6 origin-top-left"></div>
                    <h2 class="text-3xl font-bold relative z-10">STRUK PEMBAYARAN</h2>
                    <p class="text-blue-100 relative z-10 mt-1">Terima kasih telah berbelanja!</p>
                    <div class="mt-4 bg-white text-blue-600 inline-block px-4 py-1 rounded-full text-sm font-bold shadow-md relative z-10">
                        LUNAS / PAID
                    </div>
                </div>

                <div class="p-8">
                    <!-- Info Order -->
                    <div class="flex justify-between items-end border-b-2 border-dashed border-gray-200 pb-6 mb-6">
                        <div>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Ditagihkan Kepada</p>
                            <p class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">No. Order</p>
                            <p class="font-bold text-gray-800">#{{ $order->id }}</p>
                            <p class="text-xs text-gray-500 mt-1">Tanggal: {{ $order->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>

                    <!-- List Item -->
                    <table class="w-full mb-8">
                        <thead>
                            <tr class="text-left text-xs font-bold text-gray-500 uppercase border-b border-gray-200">
                                <th class="pb-2">Produk</th>
                                <th class="pb-2 text-center">Qty</th>
                                <th class="pb-2 text-right">Harga</th>
                                <th class="pb-2 text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">
                            @foreach($order->orderItems as $item)
                            <tr class="border-b border-gray-100">
                                <td class="py-3">{{ $item->product->name }}</td>
                                <td class="py-3 text-center">{{ $item->quantity }}</td>
                                <td class="py-3 text-right">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="py-3 text-right font-semibold">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Total -->
                    <div class="flex justify-end mb-8">
                        <div class="w-1/2">
                            <div class="flex justify-between items-center py-2 border-t-2 border-gray-800">
                                <span class="font-bold text-gray-800 text-lg">TOTAL BAYAR</span>
                                <span class="font-bold text-blue-600 text-2xl">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="text-center border-t border-gray-200 pt-6">
                        <p class="text-gray-500 text-sm mb-4">Simpan struk ini sebagai bukti pembayaran yang sah.</p>
                        <div class="flex justify-center gap-4">
                            <button onclick="window.print()" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-lg transition flex items-center gap-2">
                                🖨️ Cetak Struk
                            </button>
                            <a href="{{ route('dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                                Kembali Belanja
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>