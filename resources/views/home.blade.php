<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@400;500;600;700&family=Aref+Ruqaa:wght@400;700&family=Montserrat:wght@400;500;600;700&family=Cairo:wght@400;500;600;700&display=swap');

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }

    .hareer-heading {
        font-family: "New York", "Iowan Old Style", "Apple Garamond", Baskerville, "Times New Roman", serif;
        font-weight: 400;
        letter-spacing: 0.16em;
    }

    .hareer-serif {
        font-family: "New York", "Iowan Old Style", "Apple Garamond", Baskerville, "Times New Roman", serif;
        font-weight: 400;
    }

    .hareer-sans {
        font-family: "Libre Franklin", Arial, sans-serif;
    }

    .hareer-arabic-title {
        font-family: "Aref Ruqaa", "Cairo", serif;
        direction: rtl;
        font-weight: 700;
        line-height: 1.05;
        letter-spacing: 0;
    }

    .hero-arabic-text,
    .sale-arabic-title,
    .featured-arabic-title {
        font-family: "Montserrat", "Cairo", sans-serif;
        direction: rtl;
    }

    #saleSlider::-webkit-scrollbar,
    #featuredSlider::-webkit-scrollbar {
        display: none;
    }
</style>

<div class="min-h-screen bg-[#f8f4ee] hareer-sans text-[#2f2a26] overflow-x-hidden">

    {{-- Hero Section --}}
    <section
        x-data="{
            activeSlide: 0,
            slides: [
                '{{ asset('storage/images/newp.jpeg') }}',
                '{{ asset('storage/images/hero-3.jpeg') }}'
            ],
            init() {
                setInterval(() => {
                    this.activeSlide = (this.activeSlide + 1) % this.slides.length;
                }, 5000);
            }
        }"
        class="relative min-h-[620px] md:min-h-[760px] lg:min-h-[860px] overflow-hidden bg-[#f8f4ee]"
    >
        {{-- Soft glows --}}
        <div class="absolute -top-28 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/70 rounded-full blur-3xl opacity-70"></div>
        <div class="absolute -bottom-24 -right-20 w-[430px] h-[430px] bg-[#d8cbb8]/40 rounded-full blur-3xl opacity-80"></div>

       {{-- Image area --}}
    <div class="absolute inset-0 bg-[#f8f4ee] overflow-hidden">
        {{-- Slides --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div
                x-show="activeSlide === index"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 scale-[1.03] translate-x-8"
                x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                x-transition:leave="transition ease-in duration-1000"
                x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                x-transition:leave-end="opacity-0 scale-[1.02] -translate-x-8"
                class="absolute inset-0"
            >
                {{-- Soft blurred fill --}}
                <img
                    :src="slide"
                    alt=""
                    class="absolute inset-0 w-full h-full object-cover object-center blur-2xl scale-110 opacity-32"
                    aria-hidden="true"
                >

                {{-- Main image: full visible --}}
                <img
                    :src="slide"
                    alt="Hareer"
                    class="absolute inset-0 w-full h-full object-contain object-center"
                >
            </div>
        </template>

        {{-- Light Hareer veil --}}
        <div class="absolute inset-0 bg-[#f8f4ee]/10"></div>

        {{-- Gentle dark overlay only on text side --}}
        <div class="absolute inset-0 bg-gradient-to-l from-black/40 via-black/12 to-transparent"></div>

        {{-- Warm Hareer glows --}}
        <div class="absolute top-0 right-0 w-[520px] h-[520px] bg-[#2f9ea0]/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-20 w-[420px] h-[420px] bg-[#c8ad83]/12 rounded-full blur-3xl"></div>
    </div>

        {{-- Content --}}
        <div class="relative z-10 min-h-[620px] md:min-h-[760px] lg:min-h-[860px] flex items-center">
            <div class="max-w-7xl mx-auto px-5 md:px-8 w-full">
                <div class="max-w-[560px] ml-auto mr-0 text-right bg-[#f8f4ee]/55 lg:bg-transparent backdrop-blur-[1px] lg:backdrop-blur-0 px-5 py-6 lg:p-0 rounded-[28px]">
                    <h1 class="hareer-arabic-title text-[66px] sm:text-[88px] md:text-[116px] lg:text-[138px] xl:text-[155px] text-[#2f9ea0] drop-shadow-[0_14px_35px_rgba(47,158,160,0.22)]">
                        حرير
                    </h1>

                    <div class="mt-6 mb-5 flex items-center justify-end gap-4">
                        <div class="w-16 md:w-20 h-px bg-[#c8ad83]"></div>
                        <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                        <div class="w-16 md:w-20 h-px bg-[#c8ad83]"></div>
                    </div>

                    <h2 class="hero-arabic-text text-[23px] md:text-[31px] lg:text-[35px] font-semibold text-[#15120f] leading-snug">
                        اكتشفي أناقة الاحتشام
                    </h2>

                    <p class="hero-arabic-text mt-4 text-[14px] md:text-[16px] leading-loose text-[#6f675f] max-w-lg ml-auto">
                        قطع مختارة بعناية لتمنحك حضورًا راقيًا وإطلالة محتشمة تنبض بالفخامة والنعومة.
                    </p>

                    <div class="mt-8 flex justify-end">
                        <a
                            href="{{ route('products.index') }}"
                            class="hero-arabic-text inline-flex justify-center bg-[#2f9ea0] text-white px-9 py-3.5 text-sm font-semibold rounded-full hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                        >
                            تسوّقي الآن
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slider Dots --}}
        <div class="absolute bottom-7 right-7 z-20 flex items-center gap-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button
                    type="button"
                    @click="activeSlide = index"
                    class="w-3 h-3 rounded-full transition"
                    :class="activeSlide === index ? 'bg-[#2f9ea0] scale-110' : 'bg-[#d8cbb8]'"
                    aria-label="Change hero image"
                ></button>
            </template>
        </div>
    </section>

    {{-- Luxury Divider --}}
    <section class="bg-[#f8f4ee] py-10 md:py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-center gap-4">
                <div class="w-16 md:w-24 h-px bg-[#c8ad83]"></div>
                <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                <div class="w-16 md:w-24 h-px bg-[#c8ad83]"></div>
            </div>
        </div>
    </section>

    {{-- Luxury Sale Section --}}
    @php
        $visibleSaleProducts = $saleProducts->where('stock', '>', 0);
    @endphp

    @if ($visibleSaleProducts->isNotEmpty())
        <section class="relative bg-[#f8f4ee] px-4 pt-4 pb-20 overflow-hidden">
            <div class="pointer-events-none absolute -top-20 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/55 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none absolute bottom-0 -right-24 w-[430px] h-[430px] bg-[#d8cbb8]/30 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-7xl mx-auto">
                {{-- Header --}}
                <div class="relative mb-12">
                    <div class="flex flex-col gap-6 md:grid md:grid-cols-[1fr_auto_1fr] md:items-center">
                        <div class="hidden md:block"></div>

                        <div class="text-center">
                            <p class="uppercase tracking-[0.35em] text-[10px] md:text-xs text-[#8a7f73] mb-3">
                                Limited Offers
                            </p>

                            <h2 class="sale-arabic-title text-2xl md:text-3xl lg:text-4xl text-[#2f2a26] leading-tight font-semibold">
                                مجموعة عروض حرير
                            </h2>

                            <div class="mt-4 flex items-center justify-center gap-4">
                                <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                                <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                                <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                            </div>

                            <p class="sale-arabic-title mt-4 text-sm md:text-base text-[#6f675f] leading-relaxed">
                                قطع مختارة بأسعار مميزة لفترة محدودة
                            </p>
                        </div>

                        <div class="flex justify-center md:justify-end">
                            <a
                                href="{{ route('products.index', ['sale' => 1]) }}"
                                class="inline-flex items-center justify-center border border-[#2f9ea0] text-[#2f9ea0] px-6 py-2.5 text-[10px] uppercase tracking-[0.14em] font-semibold rounded-full hover:bg-[#2f9ea0] hover:text-white transition"
                            >
                                View All
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Slider --}}
                <div class="relative">
                    <button
                        type="button"
                        onclick="document.getElementById('saleSlider').scrollBy({ left: -340, behavior: 'smooth' })"
                        class="hidden md:flex absolute left-1 md:left-2 top-[39%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/95 border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white hover:border-[#2f9ea0] transition items-center justify-center shadow-[0_12px_32px_rgba(47,42,38,0.14)]"
                        aria-label="Previous products"
                    >
                        <span class="text-2xl leading-none">‹</span>
                    </button>

                    <button
                        type="button"
                        onclick="document.getElementById('saleSlider').scrollBy({ left: 340, behavior: 'smooth' })"
                        class="hidden md:flex absolute right-1 md:right-2 top-[39%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white/95 border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white hover:border-[#2f9ea0] transition items-center justify-center shadow-[0_12px_32px_rgba(47,42,38,0.14)]"
                        aria-label="Next products"
                    >
                        <span class="text-2xl leading-none">›</span>
                    </button>

                    <div
                        id="saleSlider"
                        class="flex gap-6 md:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-6 px-2 md:px-12"
                        style="scrollbar-width: none; -ms-overflow-style: none;"
                    >
                        @foreach ($visibleSaleProducts as $product)
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
                                                    class="product-image w-full h-[450px] sm:h-[495px] lg:h-[540px] object-cover object-center transition duration-700 group-hover:scale-[1.025]"
                                                >
                                            @else
                                                <div class="w-full h-[450px] sm:h-[495px] lg:h-[540px] flex flex-col items-center justify-center text-[#7a7268] bg-[#f1e9df]">
                                                    <img
                                                        src="{{ asset('storage/images/logo.PNG') }}"
                                                        alt="Hareer Logo"
                                                        class="w-20 h-20 object-contain mb-3 opacity-75"
                                                    >
                                                    <span class="text-sm">No Image</span>
                                                </div>
                                            @endif

                                            <div class="absolute top-0 left-0 bg-[#2f9ea0] text-white text-[11px] font-semibold px-4 py-2 tracking-[0.08em] shadow-sm">
                                                -{{ $discountPercent }}%
                                            </div>

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
                                        <span class="hareer-serif text-[#9b9288] line-through text-[13px] md:text-[14px]">
                                            ${{ number_format($product->price, 2) }}
                                        </span>

                                        <span class="hareer-serif text-[#2f2a26] text-[16px] md:text-[18px] font-medium">
                                            ${{ number_format($product->discount_price, 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- Shop By Category --}}
    @if ($categories->isNotEmpty())
        <section class="relative bg-[#f8f4ee] py-16 md:py-20 overflow-hidden">
            <div class="pointer-events-none absolute -top-24 -left-20 w-[420px] h-[420px] bg-[#e7f8f7]/50 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none absolute bottom-0 right-0 w-[460px] h-[460px] bg-[#d8cbb8]/30 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-[1650px] mx-auto px-4 md:px-8">
                <div class="text-center mb-12">
                    <p class="uppercase tracking-[0.35em] text-[10px] md:text-xs text-[#7a7268] mb-3">
                        Find your perfect piece
                    </p>

                    <h2 class="sale-arabic-title text-2xl md:text-3xl lg:text-4xl text-[#2f2a26] leading-tight font-semibold">
                        تسوّقي حسب التصنيف
                    </h2>

                    <div class="mt-4 flex items-center justify-center gap-4">
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                        <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    </div>

                    <p class="sale-arabic-title mt-4 text-sm md:text-base text-[#6f675f] leading-relaxed">
                        اختاري القطعة التي تناسب إطلالتك من مجموعات حرير
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8">
                    @forelse ($categories->take(2) as $category)
                        @php
                            $categoryProduct = $products->firstWhere('category_id', $category->id);
                        @endphp

                        <a
                            href="{{ route('products.index', ['category' => $category->slug]) }}"
                            class="group relative block overflow-hidden bg-[#e8ded2] shadow-[0_20px_50px_rgba(47,42,38,0.12)] transition-all duration-500 ease-out hover:-translate-y-4 hover:scale-[1.015] hover:shadow-[0_45px_110px_rgba(47,42,38,0.30)]"
                            style="transform-style: preserve-3d;"
                        >
                            <div class="relative h-[430px] sm:h-[560px] lg:h-[760px] xl:h-[820px] overflow-hidden">
                                @if ($categoryProduct && $categoryProduct->image)
                                    <img
                                        src="{{ asset('storage/' . $categoryProduct->image) }}"
                                        alt="{{ $category->name }}"
                                        class="w-full h-full object-cover object-center transition-all duration-700 ease-out group-hover:scale-[1.08] group-hover:brightness-[1.05]"
                                    >
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-[#f7f4ec] to-[#d8cbb8]">
                                        <span class="hareer-serif text-6xl md:text-7xl text-[#2f9ea0]">
                                            H
                                        </span>
                                    </div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>

                                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500 bg-gradient-to-tr from-white/15 via-transparent to-black/10"></div>
                                <div class="absolute -inset-y-full left-[-130%] w-[70%] rotate-12 bg-gradient-to-r from-transparent via-white/20 to-transparent opacity-0 group-hover:opacity-100 group-hover:left-[140%] transition-all duration-1000"></div>

                                <div class="absolute inset-x-0 bottom-0 px-6 pb-10 md:pb-12 text-white text-center z-10">
                                    <h3 class="hareer-serif text-2xl md:text-3xl lg:text-4xl tracking-[0.04em]">
                                        {{ $category->name }}
                                    </h3>

                                    <p class="mt-4 uppercase tracking-[0.25em] text-[10px] md:text-xs text-white/85">
                                        Collection
                                    </p>

                                    <div class="mt-5 flex items-center justify-center gap-3 transition-all duration-500 group-hover:gap-5">
                                        <div class="w-12 md:w-16 h-px bg-white/70"></div>
                                        <span class="text-xl group-hover:translate-x-1 transition duration-500">→</span>
                                        <div class="w-12 md:w-16 h-px bg-white/70"></div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="lg:col-span-2 text-center border-y border-[#ded0bf] bg-[#f1e9df]/60 p-10 text-[#6f675f] shadow-sm">
                            No categories available yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif

    {{-- Why Hareer --}}
    <section class="bg-[#f8f4ee] py-16 md:py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <div class="mb-7">
                <p class="uppercase tracking-[0.35em] text-[10px] md:text-[11px] text-[#8a7f73] mb-3">
                    Our Story
                </p>

                <h2 class="hareer-sans text-2xl md:text-4xl font-bold tracking-[0.12em] uppercase text-[#15120f]">
                    Why Hareer
                </h2>

                <div class="mt-5 flex items-center justify-center gap-4">
                    <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                    <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto space-y-3 text-[#2f2a26] text-base md:text-lg leading-snug">
                <p>
                    Hareer is a <span class="font-bold">Lebanese</span> modest fashion brand created for women who love elegance,
                    comfort, and timeless style.
                </p>

                <p class="text-[#6f675f] hero-arabic-text">
                    حرير تختار لكِ قطعًا ناعمة وراقية تجمع بين الاحتشام والفخامة بأسلوب عصري.
                </p>
            </div>

            <div class="mt-8 flex justify-center">
                <div class="relative w-full max-w-[500px] h-[300px] md:h-[430px] flex items-center justify-center overflow-visible">
                    <div class="absolute inset-0 bg-[#f1e9df]/90 blur-[85px] opacity-95"></div>
                    <div class="absolute top-1/2 left-1/2 w-[280px] md:w-[320px] h-[280px] md:h-[320px] -translate-x-1/2 -translate-y-1/2 bg-[#9edfdc]/20 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-[55%] h-16 bg-black/16 blur-3xl rounded-full"></div>

                    <img
                        src="{{ asset('storage/images/logo.PNG') }}"
                        alt="Hareer logo"
                        class="relative max-h-[230px] md:max-h-[350px] max-w-full object-contain drop-shadow-[0_45px_70px_rgba(47,42,38,0.34)]"
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('about') }}"
                    class="inline-flex items-center justify-center border border-[#2f9ea0] text-[#2f9ea0] px-8 py-3 rounded-full text-[11px] uppercase tracking-[0.18em] font-semibold hover:bg-[#2f9ea0] hover:text-white transition shadow-[0_10px_25px_rgba(47,158,160,0.12)]"
                >
                    About Us
                </a>
            </div>
        </div>
    </section>

    {{-- Featured Collection --}}
    @php
        $featuredProducts = $products->where('stock', '>', 0)->take(10);
    @endphp

    @if ($featuredProducts->isNotEmpty())
        <section class="max-w-7xl mx-auto px-4 pb-20 overflow-hidden">
            <div class="relative mb-12">
                <div class="flex flex-col gap-6 md:grid md:grid-cols-[1fr_auto_1fr] md:items-center">
                    <div class="hidden md:block"></div>

                    <div class="text-center">
                        <p class="uppercase tracking-[0.35em] text-xs text-[#8a7f73] mb-3">
                            Selected Pieces
                        </p>

                        <h2 class="featured-arabic-title text-2xl md:text-3xl lg:text-4xl text-[#2f2a26] leading-tight font-semibold">
                            مختارات حرير
                        </h2>

                        <div class="mt-4 flex items-center justify-center gap-4">
                            <div class="w-14 h-px bg-[#c8ad83]"></div>
                            <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                            <div class="w-14 h-px bg-[#c8ad83]"></div>
                        </div>

                        <p class="featured-arabic-title mt-4 text-sm md:text-base text-[#6f675f] leading-relaxed">
                            قطع مختارة بعناية لإطلالة راقية ومحتشمة
                        </p>
                    </div>

                    <div class="flex justify-center md:justify-end">
                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center border border-[#2f9ea0] text-[#2f9ea0] px-6 py-2.5 text-[10px] uppercase tracking-[0.14em] font-semibold rounded-full hover:bg-[#2f9ea0] hover:text-white transition"
                        >
                            View All
                        </a>
                    </div>
                </div>
            </div>

            <div class="relative">
                <button
                    type="button"
                    onclick="document.getElementById('featuredSlider').scrollBy({ left: -320, behavior: 'smooth' })"
                    class="hidden md:flex absolute left-0 md:left-2 top-[38%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white transition items-center justify-center shadow-[0_8px_25px_rgba(47,42,38,0.12)]"
                    aria-label="Previous products"
                >
                    <span class="text-2xl leading-none">‹</span>
                </button>

                <button
                    type="button"
                    onclick="document.getElementById('featuredSlider').scrollBy({ left: 320, behavior: 'smooth' })"
                    class="hidden md:flex absolute right-0 md:right-2 top-[38%] -translate-y-1/2 z-30 w-10 h-10 md:w-12 md:h-12 rounded-full bg-white border border-[#ddd3c8] text-[#2f2a26] hover:bg-[#2f9ea0] hover:text-white transition items-center justify-center shadow-[0_8px_25px_rgba(47,42,38,0.12)]"
                    aria-label="Next products"
                >
                    <span class="text-2xl leading-none">›</span>
                </button>

                <div
                    id="featuredSlider"
                    class="flex gap-6 md:gap-8 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-5 px-2 md:px-10"
                    style="scrollbar-width: none; -ms-overflow-style: none;"
                >
                    @foreach ($featuredProducts as $product)
                        @php
                            $discountPercent = 0;

                            if ($product->price > 0 && $product->discount_price) {
                                $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                            }
                        @endphp

                        <div class="product-card group relative shrink-0 snap-start w-[250px] sm:w-[270px] lg:w-[290px]">
                            <div class="relative transition duration-500 group-hover:-translate-y-2 group-hover:shadow-[0_28px_75px_rgba(47,42,38,0.20)]">
                                <a href="{{ route('products.show', $product) }}" class="block">
                                    <div class="relative overflow-hidden bg-[#f1e9df]">
                                        @if ($product->image)
                                            <img
                                                src="{{ asset('storage/' . $product->image) }}"
                                                alt="{{ $product->name }}"
                                                class="product-image w-full h-[455px] sm:h-[490px] lg:h-[530px] object-cover transition duration-700 group-hover:scale-[1.03]"
                                            >
                                        @else
                                            <div class="w-full h-[455px] sm:h-[490px] lg:h-[530px] flex flex-col items-center justify-center text-[#7a7268] bg-[#f1e9df]">
                                                <img
                                                    src="{{ asset('storage/images/logo.PNG') }}"
                                                    alt="Hareer Logo"
                                                    class="w-20 h-20 object-contain mb-3 opacity-75"
                                                >
                                                <span>No Image</span>
                                            </div>
                                        @endif

                                        @if ($product->hasDiscount())
                                            <span class="absolute top-0 left-0 bg-[#2f9ea0] text-white text-[11px] font-semibold px-4 py-2 tracking-[0.08em] uppercase shadow-sm">
                                                -{{ $discountPercent }}%
                                            </span>
                                        @endif

                                        <a
                                            href="{{ route('products.show', $product) }}"
                                            class="absolute bottom-4 right-4 w-11 h-11 rounded-full bg-white/92 shadow-sm flex items-center justify-center text-[#2f2a26] text-[24px] leading-none hover:bg-[#2f9ea0] hover:text-white transition"
                                            aria-label="View product"
                                        >
                                            ⋯
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
                                </a>
                            </div>

                            <div class="pt-4 text-center">
                                <a href="{{ route('products.show', $product) }}" class="block">
                                    <h3 class="hareer-serif text-[17px] md:text-[18px] text-[#2f2a26] leading-[1.25] max-w-[95%] mx-auto">
                                        {{ $product->name }}
                                    </h3>
                                </a>

                                <div class="mt-1 flex items-center justify-center gap-2 flex-wrap leading-none">
                                    @if ($product->hasDiscount())
                                        <span class="hareer-serif text-[#9b9288] line-through text-[13px]">
                                            ${{ number_format($product->price, 2) }}
                                        </span>

                                        <span class="hareer-serif text-[#2f2a26] text-[16px] font-medium">
                                            ${{ number_format($product->discount_price, 2) }}
                                        </span>
                                    @else
                                        <span class="hareer-serif text-[#2f2a26] text-[16px] font-medium">
                                            ${{ number_format($product->price, 2) }}
                                        </span>
                                    @endif
                                </div>

                                <div class="mt-3 space-y-2 max-w-[190px] mx-auto">
                                    <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                        @csrf

                                        <button
                                            type="submit"
                                            class="w-full bg-[#2f9ea0] text-white py-2 rounded-full text-[10px] uppercase tracking-[0.12em] font-semibold hover:bg-[#257f81] transition"
                                        >
                                            Add to Cart
                                        </button>
                                    </form>

                                    <a
                                        href="{{ route('products.show', $product) }}"
                                        class="block w-full border border-[#2f9ea0] text-[#2f9ea0] py-2 rounded-full text-[10px] uppercase tracking-[0.12em] font-semibold hover:bg-[#e7f8f7] transition"
                                    >
                                        Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Service Strip --}}
    <section class="bg-[#f8f4ee] pb-16 md:pb-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 border-y border-[#ded0bf] bg-[#f8f4ee]">
                <div class="group relative p-8 md:p-9 text-center border-b md:border-b-0 md:border-r border-[#ded0bf] transition duration-300 hover:bg-[#f1e9df]">
                    <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] transition duration-300 group-hover:-translate-y-1 group-hover:shadow-[0_16px_35px_rgba(47,42,38,0.12)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 100-3 1.5 1.5 0 000 3Zm7.5 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3ZM3.75 6.75h10.5v9H3.75v-9Zm10.5 3h2.7l3.3 3.3v2.7h-6v-6Z" />
                        </svg>
                    </div>

                    <p class="hareer-serif text-xl text-[#2f2a26]">Fast Delivery</p>
                    <p class="mt-2 text-sm leading-relaxed text-[#6f675f]">Delivery arranged after order confirmation.</p>
                </div>

                <div class="group relative p-8 md:p-9 text-center border-b md:border-b-0 md:border-r border-[#ded0bf] transition duration-300 hover:bg-[#f1e9df]">
                    <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] transition duration-300 group-hover:-translate-y-1 group-hover:shadow-[0_16px_35px_rgba(47,42,38,0.12)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.5a.75.75 0 011.04 0l2.24 2.16 3.1-.44a.75.75 0 01.82.82l-.44 3.1 2.16 2.24a.75.75 0 010 1.04l-2.16 2.24.44 3.1a.75.75 0 01-.82.82l-3.1-.44-2.24 2.16a.75.75 0 01-1.04 0l-2.24-2.16-3.1.44a.75.75 0 01-.82-.82l.44-3.1-2.16-2.24a.75.75 0 010-1.04l2.16-2.24-.44-3.1a.75.75 0 01.82-.82l3.1.44 2.24-2.16Z" />
                        </svg>
                    </div>

                    <p class="hareer-serif text-xl text-[#2f2a26]">Premium Look</p>
                    <p class="mt-2 text-sm leading-relaxed text-[#6f675f]">Elegant modest pieces selected with care.</p>
                </div>

                <div class="group relative p-8 md:p-9 text-center border-b md:border-b-0 md:border-r border-[#ded0bf] transition duration-300 hover:bg-[#f1e9df]">
                    <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] transition duration-300 group-hover:-translate-y-1 group-hover:shadow-[0_16px_35px_rgba(47,42,38,0.12)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0Zm3.75 0a.375.375 0 11-.75 0 .375.375 0 01.75 0Zm3.75 0a.375.375 0 11-.75 0 .375.375 0 01.75 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.142-4.03 7.5-9 7.5a10.4 10.4 0 01-3.42-.57L3 21l1.64-4.06A7.02 7.02 0 013 12c0-4.142 4.03-7.5 9-7.5s9 3.358 9 7.5Z" />
                        </svg>
                    </div>

                    <p class="hareer-serif text-xl text-[#2f2a26]">WhatsApp Order</p>
                    <p class="mt-2 text-sm leading-relaxed text-[#6f675f]">Simple support before confirming your order.</p>
                </div>

                <div class="group relative p-8 md:p-9 text-center transition duration-300 hover:bg-[#f1e9df]">
                    <div class="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] transition duration-300 group-hover:-translate-y-1 group-hover:shadow-[0_16px_35px_rgba(47,42,38,0.12)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5v9.75H2.25V8.25Zm3 0V6a.75.75 0 01.75-.75h12A.75.75 0 0118.75 6v2.25" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15.75a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5Z" />
                        </svg>
                    </div>

                    <p class="hareer-serif text-xl text-[#2f2a26]">Cash on Delivery</p>
                    <p class="mt-2 text-sm leading-relaxed text-[#6f675f]">Easy local payment after confirmation.</p>
                </div>
            </div>
        </div>
    </section>

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
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">كيف يتم تأكيد الطلب؟</span>
                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">+</span>
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
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">كم تكلفة التوصيل؟</span>
                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">+</span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            تكلفة التوصيل هي <span class="font-semibold text-[#2f2a26]">$4</span> إلى جميع المناطق داخل لبنان.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">هل الدفع عند الاستلام متوفر؟</span>
                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">+</span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            نعم، الدفع عند الاستلام متوفر. يتم تأكيد المبلغ النهائي معك عبر واتساب قبل التوصيل.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">هل يمكنني السؤال عن المقاس قبل الطلب؟</span>
                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">+</span>
                    </button>

                    <div x-show="open" x-transition style="display: none;">
                        <div class="px-5 md:px-7 pb-6 -mt-1 text-[#6f675f] leading-relaxed text-sm md:text-base">
                            نعم، يمكنك التواصل معنا عبر واتساب قبل تأكيد الطلب، وسنساعدك باختيار المقاس أو القطعة الأنسب.
                        </div>
                    </div>
                </div>

                <div x-data="{ open: false }" class="border-y border-[#ded0bf] bg-[#f1e9df]/55 transition duration-300 hover:bg-[#f1e9df]">
                    <button type="button" @click="open = ! open" class="w-full flex items-center justify-between gap-4 px-5 md:px-7 py-5 text-right">
                        <span class="hareer-serif text-xl md:text-2xl text-[#2f2a26]">ماذا يحدث إذا كانت القطعة غير متوفرة؟</span>
                        <span class="w-9 h-9 rounded-full border border-[#c8ad83]/60 text-[#2f9ea0] flex items-center justify-center shrink-0 transition" :class="{ 'rotate-45': open }">+</span>
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