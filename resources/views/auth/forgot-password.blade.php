<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-lg p-8 shadow-lg text-center">
                <h1 class="text-4xl mb-2">🔑</h1>
                <h2 class="text-2xl font-bold text-white">{{ __('Reset Password') }}</h2>
                <p class="text-blue-100 text-sm mt-2">{{ __('We will send you a reset link') }}</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-lg shadow-lg p-8">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <p class="text-sm text-blue-700 mb-6">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </p>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="{{ __('you@example.com') }}" />
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="space-y-3">
                        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            📧 {{ __('Send Reset Link') }}
                        </button>

                        <a href="{{ route('login') }}" class="block text-center text-blue-600 hover:text-blue-800 font-semibold py-2">
                            {{ __('Back to login') }}
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-sm text-blue-800">
                    <span class="font-semibold">💡 Tip:</span> {{ __('Check your email (and spam folder) for the reset link') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
