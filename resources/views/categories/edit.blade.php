<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-lg p-6 shadow-lg">
            <h2 class="text-2xl font-bold text-white">
                ✏️ {{ __('Edit Kategori') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-lg p-8">
                <form action="{{ route('categories.update', $category->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="name" class="block text-sm font-semibold text-blue-900 mb-2">
                            📝 Nama Kategori
                        </label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" value="{{ old('name', $category->name) }}" placeholder="Nama kategori" required>
                        @error('name')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-semibold text-blue-900 mb-2">
                            📄 Deskripsi
                        </label>
                        <textarea id="description" name="description" rows="4" class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition" placeholder="Deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            ✅ Update
                        </button>
                        <a href="{{ route('categories.index') }}" class="flex-1 bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md text-center">
                            ❌ Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
