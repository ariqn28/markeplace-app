<nav x-data="{ open: false }" class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 border-b-4 border-blue-500 shadow-lg">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <svg class="w-8 h-8 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z"></path>
                            <path d="M16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                        </svg>
                        <span class="text-xl font-bold text-white">Marketplace</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-1 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-blue-100 hover:text-white hover:bg-blue-600 px-3 py-2 rounded-md transition">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <!-- Admin menu -->
                    @if(auth()->check() && auth()->user()->is_admin)
                        <a href="{{ route('products.index') }}" class="text-blue-100 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('products.*') ? 'bg-blue-600 text-white' : '' }}">
                            Produk
                        </a>
                        <a href="{{ route('categories.index') }}" class="text-blue-100 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('categories.*') ? 'bg-blue-600 text-white' : '' }}">
                            Kategori
                        </a>
                        <a href="{{ route('orders.index') }}" class="text-blue-100 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('orders.*') ? 'bg-blue-600 text-white' : '' }}">
                            Order
                        </a>
                    @endif

                    <!-- User menu -->
                    @if(auth()->check() && !auth()->user()->is_admin)
                        <a href="{{ route('cart.index') }}" class="text-blue-100 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('cart.index') ? 'bg-blue-600 text-white' : '' }}">
                            🛒 Keranjang
                        </a>
                        <a href="{{ route('user.orders.index') }}" class="text-blue-100 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('user.orders.*') ? 'bg-blue-600 text-white' : '' }}">
                            📦 Pesanan Saya
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                <!-- User Name -->
                <div class="text-blue-100 text-sm font-medium">
                    👤 {{ Auth::user()->name }}
                </div>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-500 text-white font-bold rounded-lg shadow-md">
                        🚪 {{ __('Logout') }}
                    </button>
                </form>

                <!-- Profile Link -->
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg transition duration-200 shadow-md">
                    ⚙️ {{ __('Profile') }}
                </a>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-blue-100 focus:outline-none focus:text-white">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-blue-800">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-blue-100 hover:text-white hover:bg-blue-700">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <!-- Admin menu -->
            @if(auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('products.index') }}" class="block text-blue-100 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium transition">
                    Produk
                </a>
                <a href="{{ route('categories.index') }}" class="block text-blue-100 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium transition">
                    Kategori
                </a>
                <a href="{{ route('orders.index') }}" class="block text-blue-100 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium transition">
                    Order
                </a>
            @endif

            <!-- User menu -->
            @if(auth()->check() && !auth()->user()->is_admin)
                <a href="{{ route('cart.index') }}" class="block text-blue-100 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium transition">
                    🛒 Keranjang
                </a>
                <a href="{{ route('user.orders.index') }}" class="block text-blue-100 hover:text-white hover:bg-blue-700 px-3 py-2 rounded-md text-base font-medium transition">
                    📦 Pesanan Saya
                </a>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-blue-700">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-blue-200">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-blue-100 hover:text-white hover:bg-blue-700 rounded-md transition">
                    ⚙️ {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-4 py-2 text-blue-100 rounded-md font-bold bg-red-500">
                        🚪 {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>