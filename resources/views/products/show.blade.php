<x-app-layout>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Cairo:wght@400;500;600;700&display=swap');

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .hareer-serif {
            font-family: "New York", "Iowan Old Style", "Apple Garamond", Baskerville, "Times New Roman", serif;
            font-weight: 400;
        }

        .hareer-arabic {
            font-family: "Montserrat", "Cairo", sans-serif;
            direction: rtl;
        }

        .hareer-thumbs::-webkit-scrollbar {
            display: none;
        }
    </style>

    @php
        $firstImage = $product->image
            ? asset('storage/' . $product->image)
            : ($product->images->first() ? asset('storage/' . $product->images->first()->image) : '');

        $hasSizeGuide = $product->size_guides && count($product->size_guides);
    @endphp

    <div class="min-h-screen bg-[#f8f4ee] text-[#2f2a26] overflow-x-hidden">
        <section class="relative py-8 md:py-14 overflow-hidden">
            {{-- Soft luxury background --}}
            <div class="pointer-events-none hidden md:block absolute -top-28 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/70 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none hidden md:block absolute -bottom-28 -right-20 w-[440px] h-[440px] bg-[#d8cbb8]/40 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-7xl mx-auto px-4">
                {{-- Back --}}
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex items-center text-[11px] uppercase tracking-[0.18em] font-semibold text-[#6f675f] hover:text-[#2f9ea0] transition mb-6 md:mb-8"
                >
                    ← Back to products
                </a>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="mb-6 border-y border-[#bfe7e5] bg-[#e7f8f7] text-[#2f9ea0] px-5 py-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 border-y border-red-200 bg-red-50 text-red-700 px-5 py-4 text-center">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">
                    {{-- Product Images --}}
                    <div
                        x-data="{
                            activeImage: @js($firstImage)
                        }"
                        class="relative"
                    >
                        <div class="pointer-events-none hidden md:block absolute -top-10 -left-10 w-72 h-72 bg-[#9edfdc]/25 rounded-full blur-3xl"></div>
                        <div class="pointer-events-none hidden md:block absolute -bottom-10 -right-10 w-80 h-80 bg-[#d8cbb8]/35 rounded-full blur-3xl"></div>

                        {{-- Main Image --}}
                        <div class="relative bg-[#f1e9df] shadow-[0_14px_35px_rgba(47,42,38,0.10)] md:shadow-[0_28px_90px_rgba(47,42,38,0.12)] overflow-hidden">
                            @if ($product->image || $product->images->isNotEmpty())
                                <img
                                    :src="activeImage"
                                    alt="{{ $product->name }}"
                                    class="product-image w-full h-[430px] sm:h-[560px] md:h-[680px] lg:h-[720px] object-cover object-center"
                                >
                            @else
                                <div class="w-full h-[430px] sm:h-[560px] md:h-[680px] lg:h-[720px] flex flex-col items-center justify-center text-[#7a7268]">
                                    <img
                                        src="{{ asset('storage/images/logo.PNG') }}"
                                        alt="Hareer Logo"
                                        class="product-image w-24 h-24 md:w-28 md:h-28 object-contain opacity-70 mb-4"
                                    >
                                    <span>No Image</span>
                                </div>
                            @endif

                            @if ($product->hasDiscount())
                                @php
                                    $discountPercent = 0;

                                    if ($product->price > 0 && $product->discount_price) {
                                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                    }
                                @endphp

                                <div class="absolute top-0 left-0 bg-[#2f9ea0] text-white text-[10px] md:text-[11px] uppercase tracking-[0.16em] px-4 py-2 font-semibold shadow-sm">
                                    -{{ $discountPercent }}%
                                </div>
                            @endif

                            @if ($product->isSoldOut())
                                <div class="absolute top-0 right-0 bg-[#15120f] text-white text-[10px] md:text-[11px] uppercase tracking-[0.16em] px-4 py-2 font-semibold">
                                    Sold Out
                                </div>
                            @endif
                        </div>

                        {{-- Thumbnails --}}
                        @if ($product->image || $product->images->isNotEmpty())
                            <div
                                class="hareer-thumbs mt-4 md:mt-5 flex gap-3 overflow-x-auto pb-2"
                                style="scrollbar-width: none; -ms-overflow-style: none;"
                            >
                                @if ($product->image)
                                    <button
                                        type="button"
                                        @click="activeImage = @js(asset('storage/' . $product->image))"
                                        class="w-16 h-20 md:w-20 md:h-24 overflow-hidden border border-[#ded0bf] shrink-0 bg-[#f1e9df] hover:border-[#2f9ea0] transition"
                                    >
                                        <img
                                            src="{{ asset('storage/' . $product->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    </button>
                                @endif

                                @foreach ($product->images as $image)
                                    <button
                                        type="button"
                                        @click="activeImage = @js(asset('storage/' . $image->image))"
                                        class="w-16 h-20 md:w-20 md:h-24 overflow-hidden border border-[#ded0bf] shrink-0 bg-[#f1e9df] hover:border-[#2f9ea0] transition"
                                    >
                                        <img
                                            src="{{ asset('storage/' . $image->image) }}"
                                            alt="{{ $product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="relative lg:pt-6">
                        <div class="border-y border-[#ded0bf] py-7 md:py-10">
                            @if ($product->category)
                                <p class="uppercase tracking-[0.35em] text-[10px] md:text-[11px] text-[#7a7268] mb-4">
                                    {{ $product->category->name }}
                                </p>
                            @endif

                            <h1 class="hareer-serif text-3xl sm:text-4xl md:text-6xl text-[#15120f] leading-tight">
                                {{ $product->name }}
                            </h1>

                            {{-- Price --}}
                            @if ($product->hasDiscount())
                                <div class="mt-5 md:mt-6 flex flex-wrap items-center gap-3">
                                    <span class="hareer-serif text-3xl md:text-5xl text-[#2f9ea0]">
                                        ${{ number_format($product->discount_price, 2) }}
                                    </span>

                                    <span class="hareer-serif text-lg md:text-2xl text-[#9b9288] line-through">
                                        ${{ number_format($product->price, 2) }}
                                    </span>

                                    <span class="bg-[#e7f8f7] text-[#2f9ea0] px-4 py-2 text-[10px] uppercase tracking-[0.16em] font-semibold">
                                        Special Price
                                    </span>
                                </div>
                            @else
                                <p class="hareer-serif mt-5 md:mt-6 text-3xl md:text-5xl text-[#2f9ea0]">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                            @endif

                            {{-- Stock --}}
                            <div class="mt-6 md:mt-7">
                                @if ($product->isSoldOut())
                                    <span class="inline-flex bg-[#15120f] text-white px-4 py-2 text-[10px] uppercase tracking-[0.16em] font-semibold">
                                        Sold Out
                                    </span>
                                @elseif ($product->isLowStock())
                                    <span class="inline-flex border border-[#c8ad83] text-[#9b7448] px-4 py-2 text-[10px] uppercase tracking-[0.16em] font-semibold">
                                        Only {{ $product->stock }} left
                                    </span>
                                @else
                                    <span class="inline-flex border border-[#bfe7e5] text-[#2f9ea0] px-4 py-2 text-[10px] uppercase tracking-[0.16em] font-semibold">
                                        In Stock
                                    </span>
                                @endif
                            </div>

                            {{-- Size Guide Display --}}
                            @if ($hasSizeGuide)
                                <div class="mt-7 md:mt-8 pt-7 md:pt-8 border-t border-[#ded0bf]">
                                    <p class="uppercase tracking-[0.28em] text-[10px] text-[#7a7268] mb-3">
                                        Size Guide
                                    </p>

                                    <p class="hareer-arabic text-[#6f675f] text-sm md:text-base leading-relaxed mb-4" dir="rtl">
                                        اختاري المقاس المناسب حسب الطول والوزن قبل إضافة القطعة إلى السلة.
                                    </p>

                                    <div class="space-y-2">
                                        @foreach ($product->size_guides as $guide)
                                            <div class="border-y border-[#ded0bf] bg-[#f1e9df]/45 px-4 py-3 text-sm md:text-base text-[#2f2a26]">
                                                {{ $guide }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Description --}}
                            @if ($product->description)
                                <div class="mt-7 md:mt-8 pt-7 md:pt-8 border-t border-[#ded0bf]">
                                    <p class="uppercase tracking-[0.28em] text-[10px] text-[#7a7268] mb-3">
                                        Description
                                    </p>

                                    <p class="text-[#6f675f] leading-relaxed text-base md:text-lg">
                                        {{ $product->description }}
                                    </p>
                                </div>
                            @endif

                            {{-- Action --}}
                            <div class="mt-8 md:mt-9">
                                @auth
                                    @if (auth()->user()->is_admin)
                                        <a
                                            href="{{ route('admin.products.edit', $product) }}"
                                            class="block text-center w-full bg-[#2f9ea0] text-white py-4 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                                        >
                                            Edit Product
                                        </a>
                                    @else
                                        @if (! $product->isSoldOut())
                                            <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                                @csrf

                                                @if ($hasSizeGuide)
                                                    <div class="mb-5">
                                                        <label class="block mb-3 text-[11px] uppercase tracking-[0.22em] text-[#7a7268]">
                                                            Choose Suitable Size
                                                        </label>

                                                        <select
                                                            name="selected_size"
                                                            class="w-full min-h-[48px] border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                                            required
                                                        >
                                                            <option value="">Choose height and suitable weight</option>

                                                            @foreach ($product->size_guides as $guide)
                                                                <option value="{{ $guide }}">
                                                                    {{ $guide }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <p class="hareer-arabic mt-2 text-xs text-[#6f675f]" dir="rtl">
                                                            هذا الاختيار يساعدنا على تأكيد المقاس المناسب عند الطلب.
                                                        </p>
                                                    </div>
                                                @endif

                                                <button
                                                    type="submit"
                                                    class="w-full bg-[#2f9ea0] text-white py-4 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                                                >
                                                    Add to Cart
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="w-full bg-[#9b9288] text-white py-4 rounded-full text-sm font-semibold cursor-not-allowed">
                                                Sold Out
                                            </button>
                                        @endif
                                    @endif
                                @else
                                    @if (! $product->isSoldOut())
                                        <form method="POST" action="{{ route('cart.store', $product) }}" class="ajax-add-to-cart">
                                            @csrf

                                            @if ($hasSizeGuide)
                                                <div class="mb-5">
                                                    <label class="block mb-3 text-[11px] uppercase tracking-[0.22em] text-[#7a7268]">
                                                        Choose Suitable Size
                                                    </label>

                                                    <select
                                                        name="selected_size"
                                                        class="w-full min-h-[48px] border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                                        required
                                                    >
                                                        <option value="">Choose height and suitable weight</option>

                                                        @foreach ($product->size_guides as $guide)
                                                            <option value="{{ $guide }}">
                                                                {{ $guide }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <p class="hareer-arabic mt-2 text-xs text-[#6f675f]" dir="rtl">
                                                        هذا الاختيار يساعدنا على تأكيد المقاس المناسب عند الطلب.
                                                    </p>
                                                </div>
                                            @endif

                                            <button
                                                type="submit"
                                                class="w-full bg-[#2f9ea0] text-white py-4 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                                            >
                                                Add to Cart
                                            </button>
                                        </form>
                                    @else
                                        <button disabled class="w-full bg-[#9b9288] text-white py-4 rounded-full text-sm font-semibold cursor-not-allowed">
                                            Sold Out
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        {{-- Service Notes --}}
                        <div class="mt-6 grid grid-cols-1 sm:grid-cols-3 gap-3 text-center">
                            <div class="border-y border-[#ded0bf] py-4 px-3">
                                <p class="hareer-arabic font-semibold text-[#2f2a26]">
                                    واتساب
                                </p>
                                <p class="text-sm text-[#6f675f] mt-1">
                                    Order support
                                </p>
                            </div>

                            <div class="border-y border-[#ded0bf] py-4 px-3">
                                <p class="hareer-arabic font-semibold text-[#2f2a26]">
                                    الدفع
                                </p>
                                <p class="text-sm text-[#6f675f] mt-1">
                                    On delivery
                                </p>
                            </div>

                            <div class="border-y border-[#ded0bf] py-4 px-3">
                                <p class="hareer-arabic font-semibold text-[#2f2a26]">
                                    لبنان
                                </p>
                                <p class="text-sm text-[#6f675f] mt-1">
                                    $4 delivery
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-fly-to-cart-script />
    </div>
</x-app-layout>