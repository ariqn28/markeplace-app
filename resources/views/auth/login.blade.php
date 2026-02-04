<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-900 to-blue-400 py-12">
        <div class="max-w-md mx-auto">
            <!-- Logo -->
            <div class="text-center mb-6">
                <div class="text-6xl mb-2">🎯</div>
                <h1 class="text-3xl font-bold text-white">Laravel Marketplace</h1>
            </div>
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-lg p-8 shadow-lg text-center">
                <h1 class="text-4xl mb-2">🔐</h1>
                <h2 class="text-2xl font-bold text-white">{{ __('Welcome Back') }}</h2>
                <p class="text-blue-100 text-sm mt-2">{{ __('Sign in to your account') }}</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-lg shadow-lg p-8">
                <!-- Session Status -->
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('Email Address') }}</label>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="{{ __('you@example.com') }}" />
                        @error('email')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-5">
                        <label for="password" class="block text-sm font-semibold text-blue-900 mb-2">{{ __('Password') }}</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="w-full px-4 py-2 border-2 border-blue-200 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                            placeholder="{{ __('Enter your password') }}" />
                        @error('password')
                            <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6 flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 border-blue-300 rounded accent-blue-600">
                        <label for="remember_me" class="ml-2 text-sm text-blue-700">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <!-- Buttons -->
                    <div class="space-y-3">
                        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            🚀 {{ __('Sign In') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="block text-center text-blue-600 hover:text-blue-800 font-semibold py-2">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif

                        <a href="{{ route('register') }}" class="block text-center text-blue-600 hover:text-blue-800 font-semibold py-2">
                            {{ __("Don't have an account?") }} <span class="underline">{{ __('Register here') }}</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-sm text-blue-800">
                    <span class="font-semibold">ℹ️ Demo:</span> {{ __('Use demo account to explore') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
