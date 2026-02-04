<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-lg p-8 shadow-lg text-center">
                <h1 class="text-4xl mb-2">🔒</h1>
                <h2 class="text-2xl font-bold text-white">{{ __('Confirm Password') }}</h2>
                <p class="text-blue-100 text-sm mt-2">{{ __('Secure area - verify your identity') }}</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-lg shadow-lg p-8">
                <p class="text-sm text-blue-700 mb-6">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </p>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="{{ __('Enter your password') }}" />
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Button -->
                    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        ✅ {{ __('Confirm Password') }}
                    </button>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-sm text-blue-800">
                    <span class="font-semibold">🔐 Security:</span> {{ __('Your password is encrypted and never stored in plain text') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
