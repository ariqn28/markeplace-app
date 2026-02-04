<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pembayaran Pesanan') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8 bg-white border-b border-gray-200">
                    
                    <div class="text-center mb-8">
                        <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Konfirmasi Pembayaran</h3>
                        <p class="text-gray-500">Silakan selesaikan pembayaran Anda</p>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <div class="flex justify-between items-center mb-4 border-b pb-4">
                            <span class="text-gray-600">ID Pesanan</span>
                            <span class="font-bold text-gray-800">#{{ $order->id }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4 border-b pb-4">
                            <span class="text-gray-600">Tanggal Order</span>
                            <span class="font-bold text-gray-800">{{ $order->created_at->format('d M Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-gray-800">Total Tagihan</span>
                            <span class="text-2xl font-bold text-blue-600">Rp{{ number_format($order->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <form action="{{ route('user.orders.pay', $order->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-8 text-left">
                            <h4 class="font-bold text-gray-700 mb-4">Pilih Metode Pembayaran:</h4>
                            <div class="space-y-3">
                                <!-- Bank Transfer -->
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-blue-50 transition group">
                                    <input type="radio" name="payment_method" value="bank_transfer" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300" required>
                                    <div class="ml-4">
                                        <span class="block font-semibold text-gray-800 group-hover:text-blue-700">Transfer Bank (Virtual Account)</span>
                                        <span class="block text-sm text-gray-500">BCA, Mandiri, BNI, BRI</span>
                                    </div>
                                    <div class="ml-auto text-2xl">🏦</div>
                                </label>

                                <!-- E-Wallet -->
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-blue-50 transition group">
                                    <input type="radio" name="payment_method" value="ewallet" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <div class="ml-4">
                                        <span class="block font-semibold text-gray-800 group-hover:text-blue-700">E-Wallet / QRIS</span>
                                        <span class="block text-sm text-gray-500">GoPay, OVO, Dana, ShopeePay</span>
                                    </div>
                                    <div class="ml-auto text-2xl">📱</div>
                                </label>

                                <!-- Credit Card -->
                                <label class="flex items-center p-4 border rounded-lg cursor-pointer hover:bg-blue-50 transition group">
                                    <input type="radio" name="payment_method" value="credit_card" class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <div class="ml-4">
                                        <span class="block font-semibold text-gray-800 group-hover:text-blue-700">Kartu Kredit / Debit</span>
                                        <span class="block text-sm text-gray-500">Visa, Mastercard, JCB</span>
                                    </div>
                                    <div class="ml-auto text-2xl">💳</div>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-lg shadow-lg transition transform hover:-translate-y-1 text-lg">
                            Bayar Sekarang 💳
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>