@php
    if (auth()->check()) {
        $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
    } else {
        $guestToken = request()->cookie('hareer_guest_cart');

        $cartCount = $guestToken
            ? \App\Models\CartItem::where('guest_token', $guestToken)->sum('quantity')
            : 0;
    }
@endphp

<nav
   

    x-data="{ open: false, guestMenu: false }"
    class="bg-[#f8f4ee]/95 backdrop-blur-xl fixed top-0 left-0 right-0 z-50"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16 md:h-20">

            {{-- Logo --}}
            <div class="flex items-center z-20 min-w-0">
                <a href="{{ route('home') }}" class="flex items-center gap-2 md:gap-3 min-w-0" @click="open = false; guestMenu = false">
                    <img
                        src="{{ asset('storage/images/logo.PNG') }}"
                        alt="Hareer Logo"
                        class="w-8 h-8 md:w-10 md:h-10 object-contain shrink-0"
                    >

                    <span class="text-sm md:text-lg tracking-[0.16em] md:tracking-[0.18em] text-[#2f9ea0] font-semibold leading-none truncate">
                        HAREER
                    </span>
                </a>
            </div>

            {{-- Desktop Center Navigation --}}
            <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 items-center gap-7 lg:gap-9">
                @auth
                    @if (auth()->user()->is_admin)
                        <a
                            href="{{ route('admin.products.index') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('admin.products.*') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Products
                        </a>

                        <a
                            href="{{ route('admin.categories.index') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('admin.categories.*') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Categories
                        </a>

                        <a
                            href="{{ route('admin.orders.index') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('admin.orders.*') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Orders
                        </a>

                        <a
                            href="{{ route('home') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('home') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Store
                        </a>
                    @else
                        <a
                            href="{{ route('home') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('home') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Home
                        </a>

                        <a
                            href="{{ route('products.index') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('products.index') && ! request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Shop
                        </a>

                        <a
                            href="{{ route('products.index', ['sale' => 1]) }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('products.index') && request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Sale
                        </a>

                        <a
                            href="{{ route('about') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('about') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            About
                        </a>

                        <a
                            href="{{ route('contact') }}"
                            class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('contact') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                        >
                            Contact
                        </a>
                    @endif
                @else
                    <a
                        href="{{ route('home') }}"
                        class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('home') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                    >
                        Home
                    </a>

                    <a
                        href="{{ route('products.index') }}"
                        class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('products.index') && ! request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                    >
                        Shop
                    </a>

                    <a
                        href="{{ route('products.index', ['sale' => 1]) }}"
                        class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('products.index') && request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                    >
                        Sale
                    </a>

                    <a
                        href="{{ route('about') }}"
                        class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('about') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                    >
                        About
                    </a>

                    <a
                        href="{{ route('contact') }}"
                        class="text-[11px] uppercase tracking-[0.20em] font-semibold transition {{ request()->routeIs('contact') ? 'text-[#2f9ea0]' : 'text-[#6f675f] hover:text-[#15120f]' }}"
                    >
                        Contact
                    </a>
                @endauth
            </div>

            {{-- Right Icons --}}
            <div class="flex items-center gap-3 md:gap-5 z-20 shrink-0">
                {{-- Cart --}}
                @guest
                    <a
                        href="{{ route('cart.index') }}"
                        data-cart-icon
                        class="relative text-[#15120f] hover:text-[#2f9ea0] transition"
                        aria-label="Cart"
                        @click="open = false; guestMenu = false"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14M9 20a1 1 0 100 2 1 1 0 000-2Zm8 0a1 1 0 100 2 1 1 0 000-2Z" />
                        </svg>

                        <span
                            data-cart-count
                            class="absolute -top-2 -right-3 bg-[#2f9ea0] text-white text-[9px] md:text-[10px] min-w-4 md:min-w-5 h-4 md:h-5 px-1 flex items-center justify-center font-bold {{ $cartCount > 0 ? '' : 'hidden' }}"
                        >
                            {{ $cartCount }}
                        </span>
                    </a>
                @else
                    @if (! auth()->user()->is_admin)
                        <a
                            href="{{ route('cart.index') }}"
                            data-cart-icon
                            class="relative text-[#15120f] hover:text-[#2f9ea0] transition"
                            aria-label="Cart"
                            @click="open = false; guestMenu = false"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14M9 20a1 1 0 100 2 1 1 0 000-2Zm8 0a1 1 0 100 2 1 1 0 000-2Z" />
                            </svg>

                            <span
                                data-cart-count
                                class="absolute -top-2 -right-3 bg-[#2f9ea0] text-white text-[9px] md:text-[10px] min-w-4 md:min-w-5 h-4 md:h-5 px-1 flex items-center justify-center font-bold {{ $cartCount > 0 ? '' : 'hidden' }}"
                            >
                                {{ $cartCount }}
                            </span>
                        </a>
                    @endif
                @endguest

                {{-- Guest Account --}}
                @guest
                    <div class="relative">
                        <button
                            type="button"
                            @click="guestMenu = ! guestMenu; open = false"
                            @click.outside="guestMenu = false"
                            class="w-8 h-8 md:w-9 md:h-9 rounded-full border border-[#d8cbb8] bg-[#f1e9df] text-[#2f2a26] flex items-center justify-center hover:bg-[#e7f8f7] hover:text-[#2f9ea0] transition"
                            aria-label="Account"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 md:w-5 md:h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0ZM4.5 20.25a7.5 7.5 0 0115 0" />
                            </svg>
                        </button>

                        <div
                            x-show="guestMenu"
                            x-transition
                            class="absolute right-0 mt-3 w-40 md:w-44 bg-[#f8f4ee] border border-[#ded0bf] shadow-[0_18px_45px_rgba(47,42,38,0.16)] py-2 z-50"
                            style="display: none;"
                        >
                            <a
                                href="{{ route('login') }}"
                                class="block px-4 py-3 text-xs uppercase tracking-[0.16em] font-semibold text-[#6f675f] hover:bg-[#e7f8f7] hover:text-[#2f9ea0]"
                                @click="guestMenu = false"
                            >
                                Login
                            </a>

                            <a
                                href="{{ route('register') }}"
                                class="block px-4 py-3 text-xs uppercase tracking-[0.16em] font-semibold text-[#6f675f] hover:bg-[#e7f8f7] hover:text-[#2f9ea0]"
                                @click="guestMenu = false"
                            >
                                Register
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Desktop User Dropdown --}}
                    <div class="hidden md:block">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="w-9 h-9 rounded-full border border-[#d8cbb8] bg-[#f1e9df] text-[#2f9ea0] flex items-center justify-center font-bold hover:bg-[#e7f8f7] transition">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link
                                        :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                    >
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    {{-- Mobile User Initial --}}
                    <div class="md:hidden">
                        <button
                            type="button"
                            @click="open = ! open; guestMenu = false"
                            class="w-8 h-8 rounded-full border border-[#d8cbb8] bg-[#f1e9df] text-[#2f9ea0] flex items-center justify-center text-xs font-bold hover:bg-[#e7f8f7] transition"
                            aria-label="Account menu"
                        >
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </button>
                    </div>
                @endguest

                {{-- Hamburger --}}
                <button
                    @click="open = ! open; guestMenu = false"
                    class="md:hidden inline-flex items-center justify-center p-1 text-[#6f675f] hover:text-[#15120f] focus:outline-none transition"
                    aria-label="Menu"
                >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div
        x-show="open"
        x-transition
        class="md:hidden bg-[#f8f4ee] shadow-[0_1px_0_rgba(222,208,191,0.55)]"
        style="display: none;"
    >
        <div class="px-4 pt-3 pb-4 space-y-1">
            @auth
                @if (auth()->user()->is_admin)
                    <a href="{{ route('admin.products.index') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('admin.products.*') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Products
                    </a>

                    <a href="{{ route('admin.categories.index') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('admin.categories.*') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Categories
                    </a>

                    <a href="{{ route('admin.orders.index') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('admin.orders.*') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Orders
                    </a>

                    <a href="{{ route('home') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('home') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Store
                    </a>
                @else
                    <a href="{{ route('home') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('home') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Home
                    </a>

                    <a href="{{ route('products.index') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('products.index') && ! request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Shop
                    </a>

                    <a href="{{ route('products.index', ['sale' => 1]) }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('products.index') && request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Sale
                    </a>

                    <a href="{{ route('about') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('about') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        About
                    </a>

                    <a href="{{ route('contact') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('contact') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                        Contact
                    </a>
                @endif
            @else
                <a href="{{ route('home') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('home') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                    Home
                </a>

                <a href="{{ route('products.index') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('products.index') && ! request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                    Shop
                </a>

                <a href="{{ route('products.index', ['sale' => 1]) }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('products.index') && request()->boolean('sale') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                    Sale
                </a>

                <a href="{{ route('about') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('about') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                    About
                </a>

                <a href="{{ route('contact') }}" @click="open = false" class="block py-3 text-xs uppercase tracking-[0.20em] font-semibold {{ request()->routeIs('contact') ? 'text-[#2f9ea0]' : 'text-[#6f675f]' }}">
                    Contact
                </a>
            @endauth
        </div>

        @auth
            <div class="px-4 pb-5">
                <div class="bg-[#f1e9df] border-y border-[#ded0bf] p-4 mb-3">
                    <div class="font-semibold text-[#2f2a26] break-words">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="text-sm text-[#7a6a58] break-all">
                        {{ Auth::user()->email }}
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('profile.edit') }}" @click="open = false" class="text-center border border-[#d8cbb8] py-3 text-xs uppercase tracking-[0.16em] font-semibold text-[#2f2a26]">
                        Profile
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a
                            href="{{ route('logout') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block text-center bg-[#15120f] text-white py-3 text-xs uppercase tracking-[0.16em] font-semibold"
                        >
                            Logout
                        </a>
                    </form>
                </div>
            </div>
        @endauth
    </div>
</nav>