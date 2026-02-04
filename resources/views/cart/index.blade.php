<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                🛒 {{ __('Keranjang Belanja') }}
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

            @if ($message = Session::get('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <p class="font-semibold">{{ $message }}</p>
                </div>
            @endif

            @if($cartItems->isEmpty())
                <div class="bg-white p-8 rounded-xl shadow-lg text-center">
                    <p class="text-gray-500 text-lg mb-4">Keranjang belanja Anda kosong.</p>
                    <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-blue-700 transition">
                        Mulai Belanja
                    </a>
                </div>
            @else
                <form action="{{ route('cart.checkout') }}" method="POST" id="cart-form">
                    @csrf
                    <div class="bg-white shadow-xl rounded-xl overflow-hidden mb-6">
                        <div class="overflow-x-auto">
                            <table class="table-auto w-full">
                                <thead class="bg-blue-100 border-b border-blue-200">
                                    <tr>
                                        <th class="px-6 py-4 text-left">
                                            <input type="checkbox" id="select-all" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                                        </th>
                                        <th class="px-6 py-4 text-left text-blue-900 font-bold">Produk</th>
                                        <th class="px-6 py-4 text-left text-blue-900 font-bold">Harga</th>
                                        <th class="px-6 py-4 text-left text-blue-900 font-bold">Qty</th>
                                        <th class="px-6 py-4 text-left text-blue-900 font-bold">Subtotal</th>
                                        <th class="px-6 py-4 text-left text-blue-900 font-bold">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($cartItems as $item)
                                        <tr class="hover:bg-blue-50 transition">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" name="selected_items[]" value="{{ $item->id }}" 
                                                    class="cart-item-checkbox w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500"
                                                    data-price="{{ $item->product->price }}" 
                                                    data-qty="{{ $item->quantity }}">
                                            </td>
                                            <td class="px-6 py-4 font-semibold text-gray-800">
                                                {{ $item->product->name }}
                                                @if($item->quantity > $item->product->stock)
                                                    <span class="text-xs text-red-500 block">(Stok Kurang: {{ $item->product->stock }})</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-gray-600">Rp{{ number_format($item->product->price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-gray-800">{{ $item->quantity }}</td>
                                            <td class="px-6 py-4 font-bold text-blue-600">
                                                Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button type="submit" form="delete-form-{{ $item->id }}" class="text-red-500 hover:text-red-700 font-bold text-sm">
                                                    🗑️ Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Bottom Bar: Total & Checkout -->
                    <div class="bg-white shadow-lg rounded-xl p-6 flex flex-col sm:flex-row justify-between items-center gap-4 sticky bottom-4 border border-blue-100">
                        <div class="text-lg">
                            <span class="text-gray-600 font-semibold">Total Dipilih:</span>
                            <span id="total-price" class="text-2xl font-bold text-blue-700 ml-2">Rp0</span>
                        </div>
                        <button type="submit" id="checkout-btn" disabled class="bg-blue-600 text-white font-bold py-3 px-8 rounded-lg shadow-md hover:bg-blue-700 transition opacity-50 cursor-not-allowed">
                            ✅ Checkout Sekarang
                        </button>
                    </div>
                </form>

                <!-- Hidden Forms for Delete Actions -->
                @foreach($cartItems as $item)
                    <form id="delete-form-{{ $item->id }}" action="{{ route('cart.destroy', $item->id) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const items = document.querySelectorAll('.cart-item-checkbox');
            const totalPriceEl = document.getElementById('total-price');
            const checkoutBtn = document.getElementById('checkout-btn');

            function calculateTotal() {
                let total = 0;
                let checkedCount = 0;
                items.forEach(item => {
                    if (item.checked) {
                        total += parseFloat(item.dataset.price) * parseInt(item.dataset.qty);
                        checkedCount++;
                    }
                });
                totalPriceEl.innerText = 'Rp' + new Intl.NumberFormat('id-ID').format(total);
                
                if (checkedCount > 0) {
                    checkoutBtn.disabled = false;
                    checkoutBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                } else {
                    checkoutBtn.disabled = true;
                    checkoutBtn.classList.add('opacity-50', 'cursor-not-allowed');
                }
            }

            selectAll.addEventListener('change', function() {
                items.forEach(item => {
                    item.checked = selectAll.checked;
                });
                calculateTotal();
            });

            items.forEach(item => {
                item.addEventListener('change', function() {
                    if (!this.checked) {
                        selectAll.checked = false;
                    } else {
                        const allChecked = Array.from(items).every(i => i.checked);
                        if (allChecked) selectAll.checked = true;
                    }
                    calculateTotal();
                });
            });
        });
    </script>
</x-app-layout>