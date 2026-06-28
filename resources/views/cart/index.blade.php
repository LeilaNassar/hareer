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
    </style>

    <div class="min-h-screen bg-[#f8f4ee] text-[#2f2a26] overflow-x-hidden">
        <section class="relative py-10 md:py-20 overflow-hidden">
            {{-- Soft background --}}
            <div class="pointer-events-none hidden md:block absolute -top-28 left-1/2 -translate-x-1/2 w-[520px] h-[520px] bg-[#e7f8f7]/70 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none hidden md:block absolute -bottom-28 -right-20 w-[440px] h-[440px] bg-[#d8cbb8]/40 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-7xl mx-auto px-4">
                {{-- Header --}}
                <div class="text-center mb-10 md:mb-12">
                    <p class="uppercase tracking-[0.35em] text-[10px] md:text-[11px] text-[#7a7268] mb-4">
                        Shopping Bag
                    </p>

                    <h1 class="hareer-arabic text-3xl sm:text-4xl md:text-6xl font-semibold text-[#2f9ea0] leading-tight">
                        سلة التسوق
                    </h1>

                    <div class="mt-5 md:mt-6 flex items-center justify-center gap-4">
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                        <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    </div>

                    <p class="hareer-arabic mt-5 md:mt-6 max-w-2xl mx-auto text-[#6f675f] text-sm md:text-lg leading-relaxed">
                        راجعي القطع المختارة قبل تأكيد الطلب عبر واتساب.
                    </p>
                </div>

                {{-- Alerts --}}
                @if (session('success'))
                    <div class="mb-6 max-w-3xl mx-auto border-y border-[#bfe7e5] bg-[#e7f8f7] text-[#2f9ea0] px-5 py-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 max-w-3xl mx-auto border-y border-red-200 bg-red-50 text-red-700 px-5 py-4 text-center">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($cartItems->isEmpty())
                    {{-- Empty Cart --}}
                    <div class="relative max-w-3xl mx-auto bg-[#f1e9df]/70 border-y border-[#ded0bf] shadow-[0_14px_35px_rgba(47,42,38,0.08)] md:shadow-[0_28px_90px_rgba(47,42,38,0.08)] px-6 py-12 md:py-14 text-center overflow-hidden">
                        <div class="pointer-events-none hidden md:block absolute -top-20 -right-20 w-64 h-64 bg-[#9edfdc]/30 rounded-full blur-3xl"></div>
                        <div class="pointer-events-none hidden md:block absolute -bottom-20 -left-20 w-72 h-72 bg-[#d8cbb8]/35 rounded-full blur-3xl"></div>

                        <div class="relative">
                            <div class="w-20 h-20 mx-auto rounded-full border border-[#c8ad83]/70 text-[#2f9ea0] flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-9 h-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l3-8H6.4M7 13L5.4 5M7 13l-2 7h14M9 20a1 1 0 100 2 1 1 0 000-2Zm8 0a1 1 0 100 2 1 1 0 000-2Z" />
                                </svg>
                            </div>

                            <h2 class="hareer-arabic text-2xl md:text-4xl font-semibold text-[#2f2a26]">
                                السلة فارغة
                            </h2>

                            <p class="hareer-arabic mt-3 text-[#6f675f] text-sm md:text-lg leading-relaxed">
                                تصفّحي مجموعة حرير وأضيفي القطع المفضلة لديكِ.
                            </p>

                            <a
                                href="{{ route('products.index') }}"
                                class="hareer-arabic inline-flex mt-8 bg-[#2f9ea0] text-white px-9 py-3.5 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                            >
                                متابعة التسوق
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">
                        {{-- Cart Items --}}
                        <div class="lg:col-span-2 space-y-5">
                            @foreach ($cartItems as $item)
                                <div class="relative bg-[#f8f4ee] border-y border-[#ded0bf] px-4 md:px-5 py-5 transition duration-300 hover:bg-[#f1e9df]/70 hover:shadow-[0_18px_50px_rgba(47,42,38,0.08)]">
                                    <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-center">
                                        {{-- Product --}}
                                        <div class="md:col-span-6 flex items-start sm:items-center gap-4">
                                            <a
                                                href="{{ route('products.show', $item->product) }}"
                                                class="w-20 h-28 sm:w-24 sm:h-32 bg-[#f1e9df] overflow-hidden flex-shrink-0 block shadow-[0_12px_30px_rgba(47,42,38,0.10)]"
                                            >
                                                @if ($item->product->image)
                                                    <img
                                                        src="{{ asset('storage/' . $item->product->image) }}"
                                                        alt="{{ $item->product->name }}"
                                                        class="w-full h-full object-cover hover:scale-105 transition duration-500"
                                                    >
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center text-xs text-[#7a7268]">
                                                        No Image
                                                    </div>
                                                @endif
                                            </a>

                                            <div class="min-w-0 flex-1">
                                                @if ($item->product->category)
                                                    <p class="text-[10px] uppercase tracking-[0.22em] md:tracking-[0.25em] text-[#7a7268] mb-1 truncate">
                                                        {{ $item->product->category->name }}
                                                    </p>
                                                @endif

                                                <a href="{{ route('products.show', $item->product) }}">
                                                    <h2 class="hareer-serif text-lg md:text-xl text-[#2f2a26] hover:text-[#2f9ea0] transition leading-tight break-words">
                                                        {{ $item->product->name }}
                                                    </h2>
                                                </a>

                                                @if ($item->selected_size)
                                                    <div class="mt-2 border-y border-[#ded0bf] bg-[#f1e9df]/55 px-3 py-2">
                                                        <p class="text-[10px] uppercase tracking-[0.18em] text-[#7a7268] mb-1">
                                                            Selected Size
                                                        </p>

                                                        <p class="text-xs md:text-sm text-[#2f2a26] leading-relaxed">
                                                            {{ $item->selected_size }}
                                                        </p>
                                                    </div>
                                                @endif

                                                <p class="mt-2 text-[#2f9ea0] font-semibold text-sm">
                                                    ${{ number_format($item->product->finalprice(), 2) }}
                                                </p>

                                                <a
                                                    href="{{ route('products.show', $item->product) }}"
                                                    class="inline-block mt-2 text-[10px] md:text-[11px] uppercase tracking-[0.16em] md:tracking-[0.18em] text-[#7a7268] hover:text-[#2f9ea0] transition"
                                                >
                                                    View product →
                                                </a>
                                            </div>
                                        </div>

                                        {{-- Quantity --}}
                                        <div class="md:col-span-3">
                                            <form method="POST" action="{{ route('cart.update', $item) }}" class="flex items-center gap-2 sm:max-w-[210px]">
                                                @csrf
                                                @method('PATCH')

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="{{ $item->quantity }}"
                                                    min="1"
                                                    max="{{ $item->product->stock }}"
                                                    class="w-20 min-w-0 border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                                >

                                                <button
                                                    type="submit"
                                                    class="flex-1 sm:flex-none border border-[#2f9ea0] text-[#2f9ea0] px-4 py-2 text-[10px] uppercase tracking-[0.14em] font-semibold hover:bg-[#2f9ea0] hover:text-white transition"
                                                >
                                                    Update
                                                </button>
                                            </form>
                                        </div>

                                        {{-- Subtotal + Remove --}}
                                        <div class="md:col-span-3 md:text-right flex md:block items-center justify-between gap-4">
                                            <p class="hareer-serif text-2xl text-[#2f2a26]">
                                                ${{ number_format($item->product->finalprice() * $item->quantity, 2) }}
                                            </p>

                                            <form method="POST" action="{{ route('cart.destroy', $item) }}" class="md:mt-2">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    class="text-[11px] uppercase tracking-[0.16em] text-[#9b4c4c] hover:text-red-700 font-semibold"
                                                >
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <a
                                href="{{ route('products.index') }}"
                                class="inline-flex mt-4 text-[#6f675f] hover:text-[#2f2a26] text-sm font-semibold"
                            >
                                ← Continue Shopping
                            </a>
                        </div>

                        {{-- Summary --}}
                        <div class="lg:col-span-1">
                            <div class="lg:sticky lg:top-28 bg-[#f1e9df]/75 border-y border-[#ded0bf] shadow-[0_14px_35px_rgba(47,42,38,0.08)] md:shadow-[0_28px_90px_rgba(47,42,38,0.10)] px-5 md:px-6 py-7">
                                <p class="uppercase tracking-[0.28em] text-[10px] text-[#7a7268] mb-5">
                                    Order Summary
                                </p>

                                @php
                                    $deliveryFee = 4;
                                    $grandTotal = $total + $deliveryFee;
                                @endphp

                                <div class="space-y-4 border-b border-[#ded0bf] pb-5">
                                    <div class="flex justify-between gap-4 text-[#6f675f]">
                                        <span>Items</span>
                                        <span>{{ $cartItems->sum('quantity') }}</span>
                                    </div>

                                    <div class="flex justify-between gap-4 text-[#6f675f]">
                                        <span>Subtotal</span>
                                        <span>${{ number_format($total, 2) }}</span>
                                    </div>

                                    <div class="flex justify-between gap-4 text-[#6f675f]">
                                        <span>Delivery</span>
                                        <span>$4.00</span>
                                    </div>

                                    <div class="flex justify-between gap-4 text-[#6f675f]">
                                        <span>Payment</span>
                                        <span class="text-right">Cash on delivery</span>
                                    </div>
                                </div>

                                <div class="flex justify-between items-center gap-4 text-xl font-bold text-[#2f2a26] mt-5 mb-6">
                                    <span>Total</span>
                                    <span class="hareer-serif text-3xl">${{ number_format($grandTotal, 2) }}</span>
                                </div>

                                <a
                                    href="{{ route('checkout.index') }}"
                                    class="hareer-arabic block text-center w-full bg-[#2f9ea0] text-white py-4 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                                >
                                    تأكيد الطلب عبر واتساب
                                </a>

                                <div class="mt-6 bg-[#f8f4ee] border-y border-[#ded0bf] px-5 py-5 text-center">
                                    <p class="hareer-arabic font-semibold text-[#2f2a26]">
                                        دفع عند الاستلام
                                    </p>

                                    <p class="hareer-arabic text-sm text-[#6f675f] mt-2 leading-relaxed">
                                        التوصيل ٤$ داخل لبنان، ويتم تأكيد الطلب عبر واتساب.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-app-layout>