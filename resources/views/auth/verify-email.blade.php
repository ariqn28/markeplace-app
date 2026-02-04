<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100 py-12">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-400 rounded-t-lg p-8 shadow-lg text-center">
                <h1 class="text-4xl mb-2">✉️</h1>
                <h2 class="text-2xl font-bold text-white">{{ __('Verify Email') }}</h2>
                <p class="text-blue-100 text-sm mt-2">{{ __('Confirm your email address') }}</p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-b-lg shadow-lg p-8">
                <p class="text-sm text-blue-700 mb-6">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <div class="space-y-3 mt-6">
                    <form method="POST" action="{{ route('verification.send') }}" class="inline-block w-full">
                        @csrf
                        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            📧 {{ __('Resend Verification Email') }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="inline-block w-full">
                        @csrf
                        <button type="submit" class="w-full bg-gray-400 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                            🚪 {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded">
                <p class="text-sm text-blue-800">
                    <span class="font-semibold">💡 Tip:</span> {{ __('Check your email inbox and spam folder for the verification link') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
