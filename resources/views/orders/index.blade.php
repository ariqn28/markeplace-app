<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg flex justify-between items-center">
            <h2 class="text-2xl font-bold text-white">
                📋 {{ __('Manajemen Pesanan') }}
            </h2>
            <a href="{{ route('orders.create') }}" class="bg-white hover:bg-blue-50 text-blue-900 font-bold py-2 px-6 rounded-lg transition shadow-md">
                + Buat Pesanan Manual
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if ($message = Session::get('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-6 py-4 rounded-lg mb-6 shadow-md">
                    <p class="font-semibold">{{ $message }}</p>
                </div>
            @endif

            <!-- Filter & Search Section -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-6">
                <form action="{{ route('orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- Search -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cari Order ID / User</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Contoh: 15 atau Budi..." class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>
                    
                    <!-- Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status Pesanan</label>
                        <select name="status" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                        <input type="date" name="date_start" value="{{ request('date_start') }}" class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>
                    
                    <div class="flex items-end gap-2">
                        <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition w-full shadow-md">
                            🔍 Filter
                        </button>
                        <a href="{{ route('orders.index') }}" class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-300 transition shadow-md" title="Reset Filter">↻</a>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="table-auto w-full">
                        <thead class="bg-blue-100 border-b border-blue-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-blue-900 font-bold">ID</th>
                                <th class="px-6 py-4 text-left text-blue-900 font-bold">Pelanggan</th>
                                <th class="px-6 py-4 text-left text-blue-900 font-bold">Total</th>
                                <th class="px-6 py-4 text-left text-blue-900 font-bold">Tanggal</th>
                                <th class="px-6 py-4 text-left text-blue-900 font-bold">Status</th>
                                <th class="px-6 py-4 text-left text-blue-900 font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($orders as $order)
                                <tr class="hover:bg-blue-50 transition">
                                    <td class="px-6 py-4 font-bold text-gray-700">#{{ $order->id }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-gray-800">{{ $order->user->name }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-blue-600">
                                        Rp{{ number_format($order->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 text-sm">
                                        {{ $order->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()" 
                                                class="text-sm rounded-full px-3 py-1 font-bold border-2 cursor-pointer focus:ring-2 focus:ring-blue-500 focus:outline-none transition
                                                @if($order->status == 'pending') bg-yellow-100 text-yellow-800 border-yellow-200
                                                @elseif($order->status == 'processing') bg-blue-100 text-blue-800 border-blue-200
                                                @elseif($order->status == 'completed') bg-green-100 text-green-800 border-green-200
                                                @else bg-red-100 text-red-800 border-red-200 @endif">
                                                
                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>⚙️ Processing</option>
                                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 p-2 rounded-lg transition" title="Lihat Detail">
                                                👁️
                                            </a>
                                            <a href="{{ route('orders.edit', $order->id) }}" class="text-yellow-500 hover:text-yellow-700 bg-yellow-50 hover:bg-yellow-100 p-2 rounded-lg transition" title="Edit Order">
                                                ✏️
                                            </a>
                                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus order ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 p-2 rounded-lg transition" title="Hapus Order">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                @if($orders->isEmpty())
                    <div class="p-8 text-center text-gray-500">
                        Belum ada pesanan masuk.
                    </div>
                @endif

                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    {{ $orders->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>