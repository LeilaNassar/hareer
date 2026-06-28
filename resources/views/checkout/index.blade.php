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
                        Checkout
                    </p>

                    <h1 class="hareer-arabic text-3xl sm:text-4xl md:text-6xl font-semibold text-[#2f9ea0] leading-tight">
                        تأكيد الطلب
                    </h1>

                    <div class="mt-5 md:mt-6 flex items-center justify-center gap-4">
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                        <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    </div>

                    <p class="hareer-arabic mt-5 md:mt-6 max-w-2xl mx-auto text-[#6f675f] text-sm md:text-lg leading-relaxed">
                        أدخلي معلوماتكِ وسيتم تحويلكِ إلى واتساب لإرسال تفاصيل الطلب وتأكيده.
                    </p>
                </div>

                {{-- Errors --}}
                @if ($errors->any())
                    <div class="mb-8 max-w-4xl mx-auto border-y border-red-200 bg-red-50 text-red-700 px-5 py-4">
                        <p class="font-semibold mb-2">
                            Please fix the following:
                        </p>

                        <ul class="list-disc list-inside space-y-1 text-sm md:text-base">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-10">
                    {{-- Customer Information --}}
                    <div class="lg:col-span-2">
                        <div class="relative bg-[#f8f4ee] border-y border-[#ded0bf] px-5 md:px-8 py-8 md:py-10 shadow-[0_14px_35px_rgba(47,42,38,0.06)] md:shadow-[0_24px_70px_rgba(47,42,38,0.07)] overflow-hidden">
                            <div class="pointer-events-none hidden md:block absolute -top-20 -right-20 w-64 h-64 bg-[#9edfdc]/25 rounded-full blur-3xl"></div>

                            <div class="relative">
                                <div class="mb-8 text-right" dir="rtl">
                                    <p class="uppercase tracking-[0.28em] text-[10px] text-[#7a7268] mb-3" dir="ltr">
                                        Customer Details
                                    </p>

                                    <h2 class="hareer-arabic text-2xl md:text-4xl font-semibold text-[#15120f] leading-tight">
                                        معلومات التوصيل
                                    </h2>

                                    <p class="hareer-arabic mt-3 text-sm md:text-base text-[#6f675f] leading-relaxed">
                                        يرجى كتابة المعلومات بشكل واضح لتأكيد الطلب بسرعة عبر واتساب.
                                    </p>
                                </div>

                                <form method="POST" action="{{ route('checkout.place') }}" class="space-y-5">
                                    @csrf

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block mb-2 text-[11px] uppercase tracking-[0.22em] text-[#7a7268]">
                                                Name
                                            </label>

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ old('name') }}"
                                                placeholder="Your full name"
                                                class="w-full min-h-[48px] border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                                required
                                            >
                                        </div>

                                        <div>
                                            <label class="block mb-2 text-[11px] uppercase tracking-[0.22em] text-[#7a7268]">
                                                Phone
                                            </label>

                                            <input
                                                type="text"
                                                name="phone"
                                                value="{{ old('phone') }}"
                                                placeholder="+961..."
                                                class="w-full min-h-[48px] border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                                required
                                            >
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block mb-2 text-[11px] uppercase tracking-[0.22em] text-[#7a7268]">
                                            Address
                                        </label>

                                        <textarea
                                            name="address"
                                            rows="4"
                                            placeholder="City, area, street, building..."
                                            class="w-full border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                            required
                                        >{{ old('address') }}</textarea>
                                    </div>

                                    <div>
                                        <label class="block mb-2 text-[11px] uppercase tracking-[0.22em] text-[#7a7268]">
                                            Notes <span class="normal-case tracking-normal text-[#9b9288]">(optional)</span>
                                        </label>

                                        <textarea
                                            name="notes"
                                            rows="4"
                                            placeholder="Size, delivery time, or any extra details..."
                                            class="w-full border-[#d8cbb8] bg-[#fffdf9] text-[#2f2a26] focus:border-[#2f9ea0] focus:ring-[#2f9ea0]"
                                        >{{ old('notes') }}</textarea>
                                    </div>

                                    <button
                                        type="submit"
                                        class="hareer-arabic w-full bg-[#2f9ea0] text-white py-4 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                                    >
                                        تأكيد الطلب عبر واتساب
                                    </button>

                                    <p class="hareer-arabic text-sm text-[#6f675f] text-center mt-3 leading-relaxed">
                                        التوصيل ٤$ داخل لبنان، وسيتم إرسال تفاصيل الطلب إلى واتساب للتأكيد.
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="lg:col-span-1">
                        <div class="lg:sticky lg:top-28 bg-[#f1e9df]/75 border-y border-[#ded0bf] shadow-[0_14px_35px_rgba(47,42,38,0.08)] md:shadow-[0_28px_90px_rgba(47,42,38,0.10)] px-5 md:px-6 py-7">
                            <p class="uppercase tracking-[0.28em] text-[10px] text-[#7a7268] mb-5">
                                Order Summary
                            </p>

                            <div class="space-y-4">
                                @foreach ($cartItems as $item)
                                    <div class="flex gap-4 border-b border-[#ded0bf] pb-4">
                                        <div class="w-16 h-20 bg-[#f0ebe2] overflow-hidden shrink-0 shadow-[0_8px_20px_rgba(47,42,38,0.08)]">
                                            @if ($item->product->image)
                                                <img
                                                    src="{{ asset('storage/' . $item->product->image) }}"
                                                    alt="{{ $item->product->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-xs text-[#7a7268]">
                                                    No Image
                                                </div>
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between gap-3">
                                                <div class="min-w-0">
                                                    <h3 class="hareer-serif text-base md:text-lg text-[#2f2a26] leading-tight break-words">
                                                        {{ $item->product->name }}
                                                    </h3>

                                                    @if ($item->selected_size)
                                                        <div class="mt-2 border-y border-[#ded0bf] bg-[#f8f4ee]/80 px-3 py-2">
                                                            <p class="text-[10px] uppercase tracking-[0.18em] text-[#7a7268] mb-1">
                                                                Selected Size
                                                            </p>

                                                            <p class="text-xs text-[#2f2a26] leading-relaxed">
                                                                {{ $item->selected_size }}
                                                            </p>
                                                        </div>
                                                    @endif

                                                    <p class="text-sm text-[#6f675f] mt-2">
                                                        ${{ number_format($item->product->finalprice(), 2) }} × {{ $item->quantity }}
                                                    </p>
                                                </div>

                                                <p class="hareer-serif text-base md:text-lg text-[#2f2a26] shrink-0">
                                                    ${{ number_format($item->product->finalprice() * $item->quantity, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-6 space-y-3 border-b border-[#ded0bf] pb-5">
                                <div class="flex justify-between gap-4 text-[#6f675f]">
                                    <span>Items</span>
                                    <span>{{ $cartItems->sum('quantity') }}</span>
                                </div>

                                <div class="flex justify-between gap-4 text-[#6f675f]">
                                    <span>Subtotal</span>
                                    <span>${{ number_format($subtotal, 2) }}</span>
                                </div>

                                <div class="flex justify-between gap-4 text-[#6f675f]">
                                    <span>Delivery</span>
                                    <span>${{ number_format($deliveryFee, 2) }}</span>
                                </div>

                                <div class="flex justify-between gap-4 text-[#6f675f]">
                                    <span>Payment</span>
                                    <span class="text-right">Cash on delivery</span>
                                </div>
                            </div>

                            <div class="flex justify-between items-center gap-4 text-xl font-bold text-[#2f2a26] mt-5 mb-6">
                                <span>Total</span>
                                <span class="hareer-serif text-3xl">${{ number_format($total, 2) }}</span>
                            </div>

                            <div class="bg-[#f8f4ee] border-y border-[#ded0bf] px-5 py-5 text-center">
                                <p class="hareer-arabic font-semibold text-[#2f2a26]">
                                    تأكيد عبر واتساب
                                </p>

                                <p class="hareer-arabic text-sm text-[#6f675f] mt-2 leading-relaxed">
                                    سيتم إرسال الطلب إلى حرير مع كلفة التوصيل.
                                </p>
                            </div>

                            <a
                                href="{{ route('cart.index') }}"
                                class="inline-flex mt-5 text-sm font-semibold text-[#6f675f] hover:text-[#2f2a26]"
                            >
                                ← Back to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>