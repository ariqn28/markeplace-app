<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-lg p-8 shadow-lg text-center">
                <h1 class="text-4xl mb-2">🔐</h1>
                <h2 class="text-2xl font-bold text-white">{{ __('Create New Password') }}</h2>
                <p class="text-blue-100 text-sm mt-2">{{ __('Enter your new password below') }}</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-lg shadow-lg p-8">
                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition bg-blue-50"
                            disabled />
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('New Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password"
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="{{ __('Enter your new password') }}" />
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('Confirm Password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="{{ __('Confirm your new password') }}" />
                        @error('password_confirmation')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Button -->
                    <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                        ✨ {{ __('Reset Password') }}
                    </button>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-sm text-blue-800">
                    <span class="font-semibold">🔒 Security:</span> {{ __('Use a strong password with at least 8 characters') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
