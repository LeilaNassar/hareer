@props(['product'])

<div class="product-card group relative">
    <div class="overflow-hidden rounded-[28px] bg-white/80 shadow-[0_18px_45px_rgba(47,42,38,0.10)] transition duration-300 hover:shadow-[0_24px_60px_rgba(47,42,38,0.14)]">
        <a href="{{ route('products.show', $product) }}" class="block relative">
            <div class="relative h-[430px] overflow-hidden bg-[#f3ede4]">
                @if ($product->image)
                    <img
                        src="{{ asset('storage/' . $product->image) }}"
                        alt="{{ $product->name }}"
                        class="product-image w-full h-full object-cover transition duration-700 group-hover:scale-[1.04]"
                    >
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#7a7268]">
                        <img
                            src="{{ asset('storage/images/hareer-logo.jpeg') }}"
                            alt="Hareer Logo"
                            class="product-image w-20 h-20 object-contain mb-3 opacity-75"
                        >
                        <span>No Image</span>
                    </div>
                @endif

                <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-black/20 via-black/5 to-transparent"></div>

                @if ($product->hasDiscount())
                    <span class="absolute top-4 left-4 bg-[#2f9ea0] text-white text-[11px] uppercase tracking-[0.18em] px-3 py-1.5 rounded-full shadow-sm">
                        Sale
                    </span>
                @endif

                @if ($product->stock <= 0)
                    <span class="absolute top-4 {{ $product->hasDiscount() ? 'left-24' : 'left-4' }} bg-[#8b5e4b] text-white text-[11px] uppercase tracking-[0.14em] px-3 py-1.5 rounded-full shadow-sm">
                        Sold Out
                    </span>
                @endif
            </div>
        </a>

        @if ($product->stock > 0)
            <div class="absolute right-4 top-[380px] z-20">
                <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                    @csrf

                    <button
                        type="submit"
                        class="w-14 h-14 rounded-full bg-[#2f9ea0] text-white flex items-center justify-center shadow-[0_12px_30px_rgba(47,158,160,0.35)] hover:bg-[#257f81] hover:scale-105 transition"
                        aria-label="Add to Cart"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v6M9 11h6" />
                        </svg>
                    </button>
                </form>
            </div>
        @endif

        <div class="px-5 pt-6 pb-5 text-center">
            @if ($product->category)
                <p class="text-[11px] uppercase tracking-[0.28em] text-[#8c8278] mb-2">
                    {{ $product->category->name }}
                </p>
            @endif

            <a href="{{ route('products.show', $product) }}" class="block">
                <h3 class="text-[22px] hareer-serif text-[#2f2a26] leading-snug">
                    {{ $product->name }}
                </h3>
            </a>

            @if ($product->hasDiscount())
                <div class="mt-3 flex items-center justify-center gap-2">
                    <span class="text-[#2f9ea0] font-semibold text-lg">
                        ${{ number_format($product->discount_price, 2) }}
                    </span>

                    <span class="text-[#a59a90] line-through text-sm">
                        ${{ number_format($product->price, 2) }}
                    </span>
                </div>
            @else
                <p class="mt-3 text-[#2f9ea0] font-semibold text-lg">
                    ${{ number_format($product->price, 2) }}
                </p>
            @endif
        </div>
    </div>
</div>