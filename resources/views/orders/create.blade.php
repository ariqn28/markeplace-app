<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                🛒 {{ __('Buat Order Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-5">
                        <label for="user_id" class="block text-sm font-semibold text-blue-900 mb-2">
                            👤 User
                        </label>
                        <select id="user_id" name="user_id" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                            <option value="">Pilih User</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="status" class="block text-sm font-semibold text-blue-900 mb-2">
                            📋 Status
                        </label>
                        <select id="status" name="status" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" required>
                            <option value="">Pilih Status</option>
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                            <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>🔄 Processing</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>✅ Completed</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                        </select>
                        @error('status')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="total_price" class="block text-sm font-semibold text-blue-900 mb-2">
                            💰 Total Harga (Rp)
                        </label>
                        <input type="number" id="total_price" name="total_price" step="0.01" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('total_price') }}" placeholder="0" required>
                        @error('total_price')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            ✅ Simpan
                        </button>
                        <a href="{{ route('orders.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
