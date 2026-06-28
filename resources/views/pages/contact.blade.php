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
        {{-- Contact Page --}}
        <section class="relative py-12 md:py-24 overflow-hidden">
            {{-- Soft luxury background --}}
            <div class="pointer-events-none absolute -top-28 left-1/2 -translate-x-1/2 w-[420px] md:w-[520px] h-[420px] md:h-[520px] bg-[#e7f8f7]/70 rounded-full blur-3xl opacity-70"></div>
            <div class="pointer-events-none absolute -bottom-28 -right-20 w-[340px] md:w-[440px] h-[340px] md:h-[440px] bg-[#d8cbb8]/40 rounded-full blur-3xl opacity-80"></div>

            <div class="relative max-w-6xl mx-auto px-4">
                {{-- Header --}}
                <div class="text-center mb-10 md:mb-14">
                    <p class="uppercase tracking-[0.32em] md:tracking-[0.35em] text-[10px] md:text-[11px] text-[#7a7268] mb-4">
                        Hareer Boutique
                    </p>

                    <h1 class="hareer-arabic text-3xl sm:text-4xl md:text-6xl font-semibold text-[#2f9ea0] leading-tight">
                        تواصلي معنا
                    </h1>

                    <div class="mt-5 md:mt-6 flex items-center justify-center gap-4">
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                        <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                        <div class="w-14 md:w-20 h-px bg-[#c8ad83]"></div>
                    </div>

                    <p class="hareer-arabic mt-5 md:mt-6 max-w-2xl mx-auto text-[#6f675f] text-sm md:text-lg leading-relaxed">
                        لأي استفسار حول المنتجات، المقاسات، التوصيل أو تأكيد الطلب،
                        يسعدنا مساعدتكِ عبر واتساب.
                    </p>
                </div>

                {{-- Main Luxury Card --}}
                <div class="relative bg-[#f1e9df]/70 border-y border-[#ded0bf] shadow-[0_28px_90px_rgba(47,42,38,0.08)] px-5 md:px-12 py-8 md:py-14 overflow-hidden">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-16 items-center">
                        {{-- Left: Main Message --}}
                        <div class="text-right" dir="rtl">
                            <p class="uppercase tracking-[0.26em] md:tracking-[0.28em] text-[10px] text-[#7a7268] mb-4" dir="ltr">
                                Personal Support
                            </p>

                            <h2 class="hareer-arabic text-2xl sm:text-3xl md:text-5xl font-semibold text-[#15120f] leading-tight">
                                نحن هنا لمساعدتكِ
                            </h2>

                            <p class="hareer-arabic mt-5 text-[#6f675f] text-sm md:text-lg leading-relaxed">
                                ارسلي لنا رسالة مباشرة، وسنساعدكِ باختيار القطعة المناسبة،
                                معرفة التوفّر، المقاسات، وتفاصيل التوصيل.
                            </p>

                            <a
                                href="https://wa.me/96170260654"
                                target="_blank"
                                class="hareer-arabic inline-flex w-full sm:w-auto mt-8 items-center justify-center bg-[#2f9ea0] text-white px-10 py-4 rounded-full text-sm font-semibold hover:bg-[#257f81] hover:-translate-y-1 transition shadow-[0_16px_40px_rgba(47,158,160,0.28)]"
                            >
                                راسلينا عبر واتساب
                            </a>
                        </div>

                        {{-- Right: Contact Details --}}
                        <div class="space-y-6">
                            {{-- WhatsApp --}}
                            <div class="flex items-center justify-between gap-4 sm:gap-6 border-b border-[#ded0bf] pb-6">
                                <div class="text-left min-w-0">
                                    <p class="uppercase tracking-[0.22em] md:tracking-[0.24em] text-[10px] text-[#7a7268] mb-2">
                                        WhatsApp
                                    </p>

                                    <p class="hareer-serif text-xl sm:text-2xl md:text-3xl text-[#2f2a26] break-words">
                                        +961 70 260 654
                                    </p>
                                </div>

                                <div class="w-11 h-11 md:w-12 md:h-12 rounded-full border border-[#c8ad83]/70 text-[#2f9ea0] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.142-4.03 7.5-9 7.5a10.4 10.4 0 01-3.42-.57L3 21l1.64-4.06A7.02 7.02 0 013 12c0-4.142 4.03-7.5 9-7.5s9 3.358 9 7.5Z" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Location --}}
                            <div class="flex items-center justify-between gap-4 sm:gap-6 border-b border-[#ded0bf] pb-6">
                                <div class="text-left min-w-0">
                                    <p class="uppercase tracking-[0.22em] md:tracking-[0.24em] text-[10px] text-[#7a7268] mb-2">
                                        Location
                                    </p>

                                    <p class="hareer-arabic text-xl sm:text-2xl md:text-3xl text-[#2f2a26] font-semibold">
                                        لبنان
                                    </p>
                                </div>

                                <div class="w-11 h-11 md:w-12 md:h-12 rounded-full border border-[#c8ad83]/70 text-[#2f9ea0] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s6-5.25 6-11.25A6 6 0 006 9.75C6 15.75 12 21 12 21Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5Z" />
                                    </svg>
                                </div>
                            </div>

                            {{-- Delivery --}}
                            <div class="flex items-center justify-between gap-4 sm:gap-6">
                                <div class="text-left min-w-0">
                                    <p class="uppercase tracking-[0.22em] md:tracking-[0.24em] text-[10px] text-[#7a7268] mb-2">
                                        Delivery
                                    </p>

                                    <p class="hareer-arabic text-xl sm:text-2xl md:text-3xl text-[#2f2a26] font-semibold">
                                        $4 all over Lebanon
                                    </p>
                                </div>

                                <div class="w-11 h-11 md:w-12 md:h-12 rounded-full border border-[#c8ad83]/70 text-[#2f9ea0] flex items-center justify-center shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 md:w-6 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 100-3 1.5 1.5 0 000 3Zm7.5 0a1.5 1.5 0 100-3 1.5 1.5 0 000 3ZM3.75 6.75h10.5v9H3.75v-9Zm10.5 3h2.7l3.3 3.3v2.7h-6v-6Z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Simple Steps --}}
                <div class="mt-12 md:mt-14 grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6 text-center">
                    <div class="border-y border-[#ded0bf] py-7 px-5">
                        <p class="hareer-serif text-3xl text-[#2f9ea0] mb-3">
                            01
                        </p>

                        <h3 class="hareer-arabic text-xl font-semibold text-[#2f2a26]">
                            اختاري القطعة
                        </h3>

                        <p class="hareer-arabic mt-2 text-sm text-[#6f675f] leading-relaxed">
                            تصفّحي المجموعة واختاري ما يناسبك.
                        </p>
                    </div>

                    <div class="border-y border-[#ded0bf] py-7 px-5">
                        <p class="hareer-serif text-3xl text-[#2f9ea0] mb-3">
                            02
                        </p>

                        <h3 class="hareer-arabic text-xl font-semibold text-[#2f2a26]">
                            أرسلي الطلب
                        </h3>

                        <p class="hareer-arabic mt-2 text-sm text-[#6f675f] leading-relaxed">
                            يتم تأكيد الطلب والتفاصيل عبر واتساب.
                        </p>
                    </div>

                    <div class="border-y border-[#ded0bf] py-7 px-5">
                        <p class="hareer-serif text-3xl text-[#2f9ea0] mb-3">
                            03
                        </p>

                        <h3 class="hareer-arabic text-xl font-semibold text-[#2f2a26]">
                            استلمي بأناقة
                        </h3>

                        <p class="hareer-arabic mt-2 text-sm text-[#6f675f] leading-relaxed">
                            التوصيل متوفر والدفع عند الاستلام.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>