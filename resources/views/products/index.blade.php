<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&family=Cairo:wght@400;500;600;700&display=swap');

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .hareer-heading {
        font-family: "New York", "Iowan Old Style", "Apple Garamond", Baskerville, "Times New Roman", serif;
        font-weight: 400;
        letter-spacing: 0.14em;
    }

    .hareer-serif {
        font-family: "New York", "Iowan Old Style", "Apple Garamond", Baskerville, "Times New Roman", serif;
        font-weight: 400;
    }

    .hareer-sans {
        font-family: "Libre Franklin", Arial, sans-serif;
    }

    .sale-arabic-title {
        font-family: "Montserrat", "Cairo", sans-serif;
        direction: rtl;
    }

    #bestSellingSlider::-webkit-scrollbar,
    #freshArrivalsSlider::-webkit-scrollbar {
        display: none;
    }
</style>

@php
    $hasFilters = $hasFilters ?? (request('category') || request('sort') || request()->boolean('sale'));
@endphp

<div class="min-h-screen bg-[#f8f4ee] hareer-sans text-[#2f2a26] overflow-hidden">

    {{-- Filter Section --}}
    <section class="relative z-10 max-w-7xl mx-auto px-4 pt-8 md:pt-10 pb-6">
        <form
            method="GET"
            action="{{ route('products.index') }}#products"
            class="border-y border-[#ded0bf] py-6 md:py-7"
            x-data="{
                categoryOpen: false,
                sortOpen: false,
                categoryValue: @js(request('category')),
                categoryLabel: @js(request('category') ? ($categories->firstWhere('slug', request('category'))?->name ?? 'Choose Category') : 'Choose Category'),
                sortValue: @js(request('sort')),
                sortLabel: @js(request('sort') === 'price_low' ? 'Price: Low to High' : (request('sort') === 'price_high' ? 'Price: High to Low' : 'Newest'))
            }"
        >
            <input type="hidden" name="category" x-model="categoryValue">
            <input type="hidden" name="sort" x-model="sortValue">

            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 md:gap-6 items-end">
                {{-- Category --}}
                <div class="md:col-span-4">
                    <label class="block text-[10px] uppercase tracking-[0.32em] text-[#7a7268] mb-3">
                        Category
                    </label>

                    <div class="relative" @click.outside="categoryOpen = false">
                        <button
                            type="button"
                            @click="categoryOpen = ! categoryOpen; sortOpen = false"
                            class="w-full bg-[#f1e9df]/70 border border-[#ded0bf] text-[#2f2a26] px-5 py-3.5 rounded-full text-sm font-medium shadow-[0_10px_28px_rgba(47,42,38,0.05)] focus:border-[#2f9ea0] focus:ring-2 focus:ring-[#9edfdc]/35 transition flex items-center justify-between"
                        >
                            <span x-text="categoryLabel"></span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#7a7268]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <div
                            x-show="categoryOpen"
                            x-transition
                            class="absolute left-0 right-0 mt-3 bg-[#fffdf9] border border-[#ded0bf] shadow-[0_22px_55px_rgba(47,42,38,0.16)] z-40 overflow-hidden max-h-[260px] overflow-y-auto"
                            style="display: none;"
                        >
                            <button
                                type="button"
                                disabled
                                class="w-full text-left px-5 py-3 text-sm text-[#9b9288] bg-[#f8f4ee] cursor-not-allowed"
                            >
                                All Categories
                            </button>

                            @foreach ($categories as $category)
                                <button
                                    type="button"
                                    @click="categoryValue = @js($category->slug); categoryLabel = @js($category->name); categoryOpen = false"
                                    class="w-full text-left px-5 py-3 text-sm text-[#2f2a26] hover:bg-[#e7f8f7] hover:text-[#2f9ea0] transition"
                                >
                                    {{ $category->name }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- Sort --}}
                <div class="md:col-span-3">
                    <label class="block text-[10px] uppercase tracking-[0.32em] text-[#7a7268] mb-3">
                        Sort
                    </label>

                    <div class="relative" @click.outside="sortOpen = false">
                        <button
                            type="button"
                            @click="sortOpen = ! sortOpen; categoryOpen = false"
                            class="w-full bg-[#f1e9df]/70 border border-[#ded0bf] text-[#2f2a26] px-5 py-3.5 rounded-full text-sm font-medium shadow-[0_10px_28px_rgba(47,42,38,0.05)] focus:border-[#2f9ea0] focus:ring-2 focus:ring-[#9edfdc]/35 transition flex items-center justify-between"
                        >
                            <span x-text="sortLabel"></span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#7a7268]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m6 9 6 6 6-6" />
                            </svg>
                        </button>

                        <div
                            x-show="sortOpen"
                            x-transition
                            class="absolute left-0 right-0 mt-3 bg-[#fffdf9] border border-[#ded0bf] shadow-[0_22px_55px_rgba(47,42,38,0.16)] z-40 overflow-hidden"
                            style="display: none;"
                        >
                            <button
                                type="button"
                                @click="sortValue = ''; sortLabel = 'Newest'; sortOpen = false"
                                class="w-full text-left px-5 py-3 text-sm text-[#2f2a26] hover:bg-[#e7f8f7] hover:text-[#2f9ea0] transition"
                            >
                                Newest
                            </button>

                            <button
                                type="button"
                                @click="sortValue = 'price_low'; sortLabel = 'Price: Low to High'; sortOpen = false"
                                class="w-full text-left px-5 py-3 text-sm text-[#2f2a26] hover:bg-[#e7f8f7] hover:text-[#2f9ea0] transition"
                            >
                                Price: Low to High
                            </button>

                            <button
                                type="button"
                                @click="sortValue = 'price_high'; sortLabel = 'Price: High to Low'; sortOpen = false"
                                class="w-full text-left px-5 py-3 text-sm text-[#2f2a26] hover:bg-[#e7f8f7] hover:text-[#2f9ea0] transition"
                            >
                                Price: High to Low
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Sale --}}
                <label class="md:col-span-2 flex items-center gap-3 bg-[#f1e9df]/70 border border-[#ded0bf] px-5 py-3.5 rounded-full cursor-pointer min-h-[50px] shadow-[0_10px_28px_rgba(47,42,38,0.05)]">
                    <input
                        type="checkbox"
                        name="sale"
                        value="1"
                        @checked(request()->boolean('sale'))
                        class="rounded border-[#d8cbb8] text-[#2f9ea0] focus:ring-[#2f9ea0]"
                    >

                    <span class="text-[11px] uppercase tracking-[0.16em] font-semibold text-[#2f2a26]">
                        Sale only
                    </span>
                </label>

                {{-- Buttons --}}
                <div class="md:col-span-3 flex gap-3">
                    <button
                        type="submit"
                        class="flex-1 bg-[#2f9ea0] text-white py-3.5 text-[11px] uppercase tracking-[0.18em] font-semibold rounded-full hover:bg-[#257f81] transition shadow-[0_12px_30px_rgba(47,158,160,0.22)]"
                    >
                        Apply
                    </button>

                    <a
                        href="{{ route('products.index') }}#products"
                        class="flex-1 text-center border border-[#2f9ea0] text-[#2f9ea0] py-3.5 text-[11px] uppercase tracking-[0.18em] font-semibold rounded-full hover:bg-[#e7f8f7] transition"
                    >
                        Clear
                    </a>
                </div>
            </div>
        </form>
    </section>

    {{-- Active Filters --}}
    @if (request('category') || request('sort') || request()->boolean('sale'))
        <section class="max-w-7xl mx-auto px-4 pb-4">
            <div class="flex flex-wrap items-center gap-2 text-sm">
                <span class="uppercase tracking-[0.22em] text-[10px] text-[#7a7268]">
                    Active:
                </span>

                @if (request('category'))
                    <span class="inline-flex items-center border border-[#ded0bf] text-[#2f2a26] px-4 py-2 rounded-full bg-[#f8f4ee]">
                        {{ $categories->firstWhere('slug', request('category'))?->name }}
                    </span>
                @endif

                @if (request('sort') === 'price_low')
                    <span class="inline-flex items-center border border-[#ded0bf] text-[#2f2a26] px-4 py-2 rounded-full bg-[#f8f4ee]">
                        Price low to high
                    </span>
                @endif

                @if (request('sort') === 'price_high')
                    <span class="inline-flex items-center border border-[#ded0bf] text-[#2f2a26] px-4 py-2 rounded-full bg-[#f8f4ee]">
                        Price high to low
                    </span>
                @endif

                @if (request()->boolean('sale'))
                    <span class="inline-flex items-center border border-[#b9e6e4] text-[#2f9ea0] px-4 py-2 rounded-full bg-[#e7f8f7]">
                        Sale only
                    </span>
                @endif
            </div>
        </section>
    @endif

    @php
        $visibleBestSellingProducts = isset($bestSellingProducts)
            ? $bestSellingProducts->where('stock', '>', 0)
            : collect();
    @endphp

    {{-- Best Selling Section --}}
    @if (! $hasFilters && $visibleBestSellingProducts->isNotEmpty())
        <section class="relative bg-[#f8f4ee] px-4 pt-6 pb-16 md:pb-20 overflow-hidden">
            <div class="pointer-events-none absolute -top-20 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/50 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none absolute bottom-0 -right-24 w-[430px] h-[430px] bg-[#d8cbb8]/28 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-7xl mx-auto">
                {{-- Header --}}
                <div class="relative mb-10 md:mb-12">
                    <div class="flex flex-col gap-6 md:grid md:grid-cols-[1fr_auto_1fr] md:items-center">
                        <div class="hidden md:block"></div>

                        <div class="text-center">
                            <p class="uppercase tracking-[0.35em] text-[10px] md:text-xs text-[#8a7f73] mb-3">
                                Selected For You
                            </p>

                            <div class="mt-4 flex items-center justify-center gap-4">
                                <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                                <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                                <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                            </div>

                            <p class="sale-arabic-title mt-4 text-sm md:text-base text-[#6f675f] leading-relaxed">
                                قطع مختارة من حرير أحبّتها عميلاتنا أكثر
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Slider Area --}}
                <div class="relative">
                    <button
                        type="button"
                        onclick="document.getElementById('bestSellingSlider').scrollBy({ left: -340, behavior: 'smooth' })"
                        class="hidden md:flex absolute left-1 md:left-2 top-[39%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/95 border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white hover:border-[#2f9ea0] transition items-center justify-center shadow-[0_12px_32px_rgba(47,42,38,0.14)]"
                        aria-label="Previous products"
                    >
                        <span class="text-2xl leading-none">‹</span>
                    </button>

                    <button
                        type="button"
                        onclick="document.getElementById('bestSellingSlider').scrollBy({ left: 340, behavior: 'smooth' })"
                        class="hidden md:flex absolute right-1 md:right-2 top-[39%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/95 border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white hover:border-[#2f9ea0] transition items-center justify-center shadow-[0_12px_32px_rgba(47,42,38,0.14)]"
                        aria-label="Next products"
                    >
                        <span class="text-2xl leading-none">›</span>
                    </button>

                    <div
                        id="bestSellingSlider"
                        class="flex gap-6 md:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-6 px-2 md:px-12"
                        style="scrollbar-width: none; -ms-overflow-style: none;"
                    >
                        @foreach ($visibleBestSellingProducts as $product)
                            @php
                                $discountPercent = 0;

                                if ($product->price > 0 && $product->discount_price) {
                                    $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                }
                            @endphp

                            <div class="product-card group relative shrink-0 snap-start w-[235px] sm:w-[260px] lg:w-[285px]">
                                <div class="relative transition duration-500 group-hover:-translate-y-2 group-hover:shadow-[0_30px_80px_rgba(47,42,38,0.20)]">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <div class="relative overflow-hidden bg-[#f1e9df]">
                                            @if ($product->image)
                                                <img
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="product-image w-full h-[430px] sm:h-[495px] lg:h-[540px] object-cover object-center transition duration-700 group-hover:scale-[1.025]"
                                                >
                                            @else
                                                <div class="w-full h-[430px] sm:h-[495px] lg:h-[540px] flex flex-col items-center justify-center text-[#7a7268] bg-[#f1e9df]">
                                                    <img
                                                        src="{{ asset('storage/images/logo.PNG') }}"
                                                        alt="Hareer Logo"
                                                        class="w-20 h-20 object-contain mb-3 opacity-75"
                                                    >
                                                    <span class="text-sm">No Image</span>
                                                </div>
                                            @endif

                                            <div class="absolute top-0 left-0 bg-[#15120f] text-white text-[10px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                                Best
                                            </div>

                                            @if ($product->hasDiscount())
                                                <div class="absolute top-0 right-0 bg-[#2f9ea0] text-white text-[10px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                                    -{{ $discountPercent }}%
                                                </div>
                                            @endif

                                            <a
                                                href="{{ route('products.show', $product) }}"
                                                class="absolute bottom-4 right-4 w-11 h-11 rounded-full bg-white/92 shadow-sm flex items-center justify-center text-[#2f2a26] text-[25px] leading-none hover:bg-[#2f9ea0] hover:text-white transition"
                                                aria-label="View Details"
                                            >
                                                ⋯
                                            </a>
                                        </div>
                                    </a>

                                    <div class="absolute bottom-4 left-4 z-20">
                                        <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                            @csrf

                                            <button
                                                type="submit"
                                                class="w-11 h-11 rounded-full bg-[#2f9ea0] text-white flex items-center justify-center shadow-[0_10px_28px_rgba(47,158,160,0.30)] hover:bg-[#257f81] hover:scale-105 transition"
                                                aria-label="Add to Cart"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v6M9 11h6" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="pt-4 text-center">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <h3 class="hareer-serif text-[18px] md:text-[20px] text-[#2f2a26] leading-[1.28] tracking-[0.01em] max-w-[95%] mx-auto">
                                            {{ $product->name }}
                                        </h3>
                                    </a>

                                    <div class="mt-1 flex items-center justify-center gap-2 flex-wrap leading-none">
                                        @if ($product->hasDiscount())
                                            <span class="hareer-serif text-[#9b9288] line-through text-[13px] md:text-[14px]">
                                                ${{ number_format($product->price, 2) }}
                                            </span>

                                            <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                                ${{ number_format($product->discount_price, 2) }}
                                            </span>
                                        @else
                                            <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @php
        $visibleRestockProducts = isset($restockProducts)
            ? $restockProducts->where('stock', '>', 0)
            : collect();
    @endphp

    @if (! $hasFilters && $visibleRestockProducts->isNotEmpty())
        {{-- Freshly Arrived --}}
        <section class="relative bg-[#f8f4ee] px-4 pt-6 pb-16 md:pb-20 overflow-hidden">
            <div class="pointer-events-none absolute -top-20 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/50 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none absolute bottom-0 -left-24 w-[430px] h-[430px] bg-[#d8cbb8]/28 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-7xl mx-auto">
                {{-- Header --}}
                <div class="relative mb-10 md:mb-12">
                    <div class="flex flex-col gap-6 md:grid md:grid-cols-[1fr_auto_1fr] md:items-center">
                        <div class="hidden md:block"></div>

                        <div class="text-center">
                            <p class="uppercase tracking-[0.35em] text-[10px] md:text-xs text-[#8a7f73] mb-3">
                                New In Hareer
                            </p>

                            <div class="mt-4 flex items-center justify-center gap-4">
                                <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                                <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                                <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                            </div>

                            <p class="sale-arabic-title mt-4 text-sm md:text-base text-[#6f675f] leading-relaxed">
                                أحدث قطع حرير المختارة لإطلالة راقية ومحتشمة
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Slider Area --}}
                <div class="relative">
                    <button
                        type="button"
                        onclick="document.getElementById('freshArrivalsSlider').scrollBy({ left: -340, behavior: 'smooth' })"
                        class="hidden md:flex absolute left-1 md:left-2 top-[39%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/95 border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white hover:border-[#2f9ea0] transition items-center justify-center shadow-[0_12px_32px_rgba(47,42,38,0.14)]"
                        aria-label="Previous products"
                    >
                        <span class="text-2xl leading-none">‹</span>
                    </button>

                    <button
                        type="button"
                        onclick="document.getElementById('freshArrivalsSlider').scrollBy({ left: 340, behavior: 'smooth' })"
                        class="hidden md:flex absolute right-1 md:right-2 top-[39%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/95 border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white hover:border-[#2f9ea0] transition items-center justify-center shadow-[0_12px_32px_rgba(47,42,38,0.14)]"
                        aria-label="Next products"
                    >
                        <span class="text-2xl leading-none">›</span>
                    </button>

                    <div
                        id="freshArrivalsSlider"
                        class="flex gap-6 md:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-6 px-2 md:px-12"
                        style="scrollbar-width: none; -ms-overflow-style: none;"
                    >
                        @foreach ($visibleRestockProducts as $product)
                            @php
                                $discountPercent = 0;

                                if ($product->price > 0 && $product->discount_price) {
                                    $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                }
                            @endphp

                            <div class="product-card group relative shrink-0 snap-start w-[235px] sm:w-[260px] lg:w-[285px]">
                                <div class="relative transition duration-500 group-hover:-translate-y-2 group-hover:shadow-[0_30px_80px_rgba(47,42,38,0.20)]">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <div class="relative overflow-hidden bg-[#f1e9df]">
                                            @if ($product->image)
                                                <img
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="product-image w-full h-[430px] sm:h-[495px] lg:h-[540px] object-cover object-center transition duration-700 group-hover:scale-[1.025]"
                                                >
                                            @else
                                                <div class="w-full h-[430px] sm:h-[495px] lg:h-[540px] flex flex-col items-center justify-center text-[#7a7268] bg-[#f1e9df]">
                                                    <img
                                                        src="{{ asset('storage/images/logo.PNG') }}"
                                                        alt="Hareer Logo"
                                                        class="w-20 h-20 object-contain mb-3 opacity-75"
                                                    >
                                                    <span class="text-sm">No Image</span>
                                                </div>
                                            @endif

                                            <div class="absolute top-0 left-0 bg-[#15120f] text-white text-[10px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                                New
                                            </div>

                                            @if ($product->hasDiscount())
                                                <div class="absolute top-0 right-0 bg-[#2f9ea0] text-white text-[10px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                                    -{{ $discountPercent }}%
                                                </div>
                                            @endif

                                            <a
                                                href="{{ route('products.show', $product) }}"
                                                class="absolute bottom-4 right-4 w-11 h-11 rounded-full bg-white/92 shadow-sm flex items-center justify-center text-[#2f2a26] text-[25px] leading-none hover:bg-[#2f9ea0] hover:text-white transition"
                                                aria-label="View Details"
                                            >
                                                ⋯
                                            </a>
                                        </div>
                                    </a>

                                    <div class="absolute bottom-4 left-4 z-20">
                                        <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                            @csrf

                                            <button
                                                type="submit"
                                                class="w-11 h-11 rounded-full bg-[#2f9ea0] text-white flex items-center justify-center shadow-[0_10px_28px_rgba(47,158,160,0.30)] hover:bg-[#257f81] hover:scale-105 transition"
                                                aria-label="Add to Cart"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v6M9 11h6" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <div class="pt-4 text-center">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <h3 class="hareer-serif text-[18px] md:text-[20px] text-[#2f2a26] leading-[1.28] tracking-[0.01em] max-w-[95%] mx-auto">
                                            {{ $product->name }}
                                        </h3>
                                    </a>

                                    <div class="mt-1 flex items-center justify-center gap-2 flex-wrap leading-none">
                                        @if ($product->hasDiscount())
                                            <span class="hareer-serif text-[#9b9288] line-through text-[13px] md:text-[14px]">
                                                ${{ number_format($product->price, 2) }}
                                            </span>

                                            <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                                ${{ number_format($product->discount_price, 2) }}
                                            </span>
                                        @else
                                            <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($hasFilters)
        @php
            $selectedCategory = request('category')
                ? $categories->firstWhere('slug', request('category'))
                : null;
        @endphp

        {{-- Products / Filtered Results --}}
        <section id="products" class="relative bg-[#f8f4ee] px-4 {{ request()->boolean('sale') ? 'pt-8 pb-20 md:pt-10 md:pb-24' : 'py-14 md:py-20' }} scroll-mt-28 overflow-hidden">
            <div class="pointer-events-none absolute -top-20 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/50 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none absolute bottom-0 -right-24 w-[430px] h-[430px] bg-[#d8cbb8]/28 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-7xl mx-auto">
                {{-- Section Header --}}
                <div class="relative mb-12 text-center">
                    <p class="uppercase tracking-[0.35em] text-[10px] md:text-xs text-[#8a7f73] mb-3">
                        @if ($selectedCategory)
                            Hareer Category
                        @elseif (request()->boolean('sale'))
                            Limited Offers
                        @else
                            Search Results
                        @endif
                    </p>

                    <h2 class="sale-arabic-title text-2xl md:text-3xl lg:text-4xl text-[#2f2a26] leading-tight font-semibold">
                        @if ($selectedCategory)
                            {{ $selectedCategory->name }}
                        @endif
                    </h2>

                    <div class="mt-4 flex items-center justify-center gap-4">
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                        <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    </div>

                    <p class="sale-arabic-title mt-4 max-w-2xl mx-auto text-sm md:text-base text-[#6f675f] leading-relaxed">
                        @if ($selectedCategory && $selectedCategory->description)
                            {{ $selectedCategory->description }}
                        @elseif ($selectedCategory)
                            اكتشفي قطعًا مختارة من تصنيف {{ $selectedCategory->name }}، بتفاصيل راقية وأناقة محتشمة.
                        @elseif (request()->boolean('sale'))
                            قطع مختارة بأسعار مميزة لفترة محدودة.
                        @else
                            اكتشفي القطع التي تناسب اختياراتك من مجموعة حرير.
                        @endif
                    </p>
                </div>

                @if ($products->isEmpty())
                    {{-- Empty State --}}
                    <div class="relative max-w-3xl mx-auto border-y border-[#ded0bf] bg-[#f1e9df]/65 px-6 py-14 text-center shadow-[0_18px_45px_rgba(47,42,38,0.08)] overflow-hidden">
                        <div class="absolute -top-16 -right-16 w-56 h-56 bg-[#9edfdc]/30 rounded-full blur-3xl"></div>

                        <div class="relative">
                            <p class="sale-arabic-title text-2xl md:text-3xl text-[#2f2a26]">
                                @if (request()->boolean('sale'))
                                    لا توجد عروض حاليًا
                                @else
                                    لا توجد قطع مطابقة
                                @endif
                            </p>

                            <p class="sale-arabic-title mt-3 text-[#6f675f] leading-relaxed">
                                @if (request()->boolean('sale'))
                                    لا توجد قطع مخفّضة متوفرة في الوقت الحالي.
                                @else
                                    لا توجد منتجات تطابق الفلاتر الحالية. جرّبي اختيار تصنيف آخر أو مسح الفلاتر.
                                @endif
                            </p>

                            <a
                                href="{{ route('products.index') }}#products"
                                class="inline-flex mt-7 bg-[#2f9ea0] text-white px-8 py-3 rounded-full text-[11px] uppercase tracking-[0.18em] font-semibold hover:bg-[#257f81] transition shadow-[0_12px_30px_rgba(47,158,160,0.22)]"
                            >
                                Clear Filters
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Product Grid --}}
                    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-x-8 gap-y-16">
                        @foreach ($products as $product)
                            @php
                                $discountPercent = 0;

                                if ($product->price > 0 && $product->discount_price) {
                                    $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                }
                            @endphp

                            <div class="product-card group relative">
                                <div class="relative transition duration-500 group-hover:-translate-y-2 group-hover:shadow-[0_30px_80px_rgba(47,42,38,0.20)]">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <div class="relative overflow-hidden bg-[#f1e9df]">
                                            @if ($product->image)
                                                <img
                                                    src="{{ asset('storage/' . $product->image) }}"
                                                    alt="{{ $product->name }}"
                                                    class="product-image w-full h-[430px] sm:h-[505px] lg:h-[540px] object-cover object-center transition duration-700 group-hover:scale-[1.025]"
                                                >
                                            @else
                                                <div class="w-full h-[430px] sm:h-[505px] lg:h-[540px] flex flex-col items-center justify-center text-[#7a7268] bg-[#f1e9df]">
                                                    <img
                                                        src="{{ asset('storage/images/logo.PNG') }}"
                                                        alt="Hareer Logo"
                                                        class="w-20 h-20 object-contain mb-3 opacity-75"
                                                    >
                                                    <span class="text-sm">No Image</span>
                                                </div>
                                            @endif

                                            @if ($product->hasDiscount())
                                                <div class="absolute top-0 right-0 bg-[#2f9ea0] text-white text-[10px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                                    -{{ $discountPercent }}%
                                                </div>
                                            @endif

                                            @if ($product->stock <= 0)
                                                <div class="absolute top-10 right-0 bg-[#6f675f] text-white text-[10px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                                    Sold Out
                                                </div>
                                            @endif

                                            <a
                                                href="{{ route('products.show', $product) }}"
                                                class="absolute bottom-4 right-4 w-11 h-11 rounded-full bg-white/92 shadow-sm flex items-center justify-center text-[#2f2a26] text-[25px] leading-none hover:bg-[#2f9ea0] hover:text-white transition"
                                                aria-label="View Details"
                                            >
                                                ⋯
                                            </a>
                                        </div>
                                    </a>

                                    @if ($product->stock > 0)
                                        <div class="absolute bottom-4 left-4 z-20">
                                            <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="w-11 h-11 rounded-full bg-[#2f9ea0] text-white flex items-center justify-center shadow-[0_10px_28px_rgba(47,158,160,0.30)] hover:bg-[#257f81] hover:scale-105 transition"
                                                    aria-label="Add to Cart"
                                                >
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.9">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v6M9 11h6" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>

                                <div class="pt-4 text-center">
                                    <a href="{{ route('products.show', $product) }}" class="block">
                                        <h3 class="hareer-serif text-[18px] md:text-[20px] text-[#2f2a26] leading-[1.28] tracking-[0.01em] max-w-[95%] mx-auto">
                                            {{ $product->name }}
                                        </h3>
                                    </a>

                                    <div class="mt-1 flex items-center justify-center gap-2 flex-wrap leading-none">
                                        @if ($product->hasDiscount())
                                            <span class="hareer-serif text-[#9b9288] line-through text-[13px] md:text-[14px]">
                                                ${{ number_format($product->price, 2) }}
                                            </span>

                                            <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                                ${{ number_format($product->discount_price, 2) }}
                                            </span>
                                        @else
                                            <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-4 max-w-[210px] mx-auto space-y-2">
                                        @if ($product->stock > 0)
                                            <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="w-full bg-[#2f9ea0] text-white py-2.5 rounded-full text-[10px] uppercase tracking-[0.18em] font-semibold hover:bg-[#257f81] transition shadow-[0_10px_25px_rgba(47,158,160,0.20)]"
                                                >
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button
                                                disabled
                                                class="w-full bg-[#d8cbb8] text-[#6f675f] py-2.5 rounded-full text-[10px] uppercase tracking-[0.18em] font-semibold cursor-not-allowed"
                                            >
                                                Sold Out
                                            </button>
                                        @endif

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="block w-full border border-[#2f9ea0] text-[#2f9ea0] py-2.5 rounded-full text-[10px] uppercase tracking-[0.18em] font-semibold hover:bg-[#e7f8f7] transition"
                                        >
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif

    {{-- FAQ Section --}}
    <section class="bg-[#f8f4ee] pb-16 md:pb-20">
        <div class="max-w-5xl mx-auto px-4">
            <div class="text-center mb-10">
                <p class="uppercase tracking-[0.35em] text-[10px] md:text-[11px] text-[#7a7268] mb-3">
                    Hareer Support
                </p>

                <h2 class="hareer-heading text-3xl md:text-5xl text-[#15120f] uppercase leading-none">
                    FAQ
                </h2>

                <div class="mt-5 flex items-center justify-center gap-4">
                    <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                    <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                </div>

                <p class="mt-4 max-w-xl mx-auto text-sm text-[#6f675f] leading-snug" dir="rtl">
                    أسئلة شائعة تساعدك قبل اختيار قطعتك وتأكيد طلبك من حرير.
                </p>
            </div>

            <div class="space-y-4" dir="rtl">
                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">
                            كيف يتم تأكيد الطلب؟
                        </span>

                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">
                            +
                        </span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            بعد إضافة المنتجات إلى السلة وإدخال معلومات التوصيل، يتم تحويلك إلى واتساب لإرسال تفاصيل الطلب.
                            بعدها نقوم بتأكيد التوفر والتوصيل معك مباشرة.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">
                            كم تكلفة التوصيل؟
                        </span>

                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">
                            +
                        </span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            تكلفة التوصيل هي <span class="font-semibold text-[#2f2a26]">$4</span> إلى جميع المناطق داخل لبنان.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">
                            هل الدفع عند الاستلام متوفر؟
                        </span>

                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">
                            +
                        </span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            نعم، الدفع عند الاستلام متوفر. يتم تأكيد المبلغ النهائي معك عبر واتساب قبل التوصيل.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">
                            هل يمكنني السؤال عن المقاس قبل الطلب؟
                        </span>

                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">
                            +
                        </span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            نعم، يمكنك التواصل معنا عبر واتساب قبل تأكيد الطلب، وسنساعدك باختيار المقاس أو القطعة الأنسب.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">
                            ماذا يحدث إذا كانت القطعة غير متوفرة؟
                        </span>

                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">
                            +
                        </span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            إذا كانت القطعة غير متوفرة، سنخبرك مباشرة عبر واتساب ونقترح عليك قطعًا مشابهة من مجموعة حرير.
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 text-center border-y border-[#ded0bf] py-6">
                <p class="hareer-serif text-2xl text-[#2f2a26]" dir="rtl">
                    لم تجدي جوابك؟
                </p>

                <p class="mt-2 text-sm text-[#6f675f]" dir="rtl">
                    تواصلي معنا عبر واتساب وسنساعدك بكل سرور.
                </p>

                <a
                    href="https://wa.me/96170260654"
                    target="_blank"
                    class="inline-flex mt-5 bg-[#2f9ea0] text-white px-8 py-3 rounded-full text-[11px] uppercase tracking-[0.18em] font-semibold hover:bg-[#257f81] transition shadow-[0_12px_30px_rgba(47,158,160,0.22)]"
                >
                    تواصلي عبر واتساب
                </a>
            </div>
        </div>
    </section>
</div>

<x-fly-to-cart-script />
</x-app-layout>