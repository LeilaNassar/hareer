<x-app-layout>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Aref+Ruqaa:wght@400;700&family=Cairo:wght@400;500;600;700&display=swap');

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

    .hareer-arabic-title {
        font-family: "Aref Ruqaa", "Cairo", serif;
        direction: rtl;
        font-weight: 700;
        line-height: 1.1;
    }

    .hareer-arabic {
        font-family: "Montserrat", "Cairo", sans-serif;
        direction: rtl;
    }
</style>

<div class="min-h-screen bg-[#f8f4ee] text-[#2f2a26] overflow-x-hidden">
    {{-- Hero About --}}
    <section class="relative pt-10 md:pt-16 pb-10 md:pb-16 bg-[#f8f4ee] overflow-hidden">
        <div class="pointer-events-none absolute -top-28 left-1/2 -translate-x-1/2 w-[420px] md:w-[520px] h-[420px] md:h-[520px] bg-[#e7f8f7]/70 rounded-full blur-3xl opacity-70"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-20 w-[340px] md:w-[430px] h-[340px] md:h-[430px] bg-[#d8cbb8]/40 rounded-full blur-3xl opacity-80"></div>

        <div class="relative max-w-7xl mx-auto px-4 text-center">
            <p class="uppercase tracking-[0.32em] md:tracking-[0.35em] text-[10px] md:text-[11px] text-[#7a7268] mb-4">
                Hareer Story
            </p>

            <h1 class="hareer-arabic-title text-[54px] sm:text-[66px] md:text-[86px] lg:text-[104px] text-[#2f9ea0] drop-shadow-[0_10px_25px_rgba(47,158,160,0.18)]">
                حرير
            </h1>

            <div class="mt-5 md:mt-6 flex items-center justify-center gap-4">
                <div class="w-14 md:w-24 h-px bg-[#c8ad83]"></div>
                <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                <div class="w-14 md:w-24 h-px bg-[#c8ad83]"></div>
            </div>

            <p class="hareer-arabic mt-5 md:mt-6 max-w-2xl mx-auto text-[#6f675f] text-sm md:text-lg leading-relaxed">
                في عالم الأناقة المُحتشمة، حيث يلتقي الوقار والجمال.
            </p>
        </div>
    </section>

    {{-- Main Story --}}
    <section class="relative max-w-6xl mx-auto px-4 pb-14 md:pb-20">
        <div class="relative bg-[#f1e9df]/65 border-y border-[#ded0bf] shadow-[0_24px_80px_rgba(47,42,38,0.08)] px-5 md:px-12 py-8 md:py-14 overflow-hidden">
            <div class="pointer-events-none absolute -top-20 -left-20 w-72 h-72 bg-[#9edfdc]/25 rounded-full blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-20 -right-20 w-80 h-80 bg-[#c8ad83]/20 rounded-full blur-3xl"></div>

            <div class="relative grid grid-cols-1 lg:grid-cols-[1fr_1.4fr] gap-8 lg:gap-14 items-center">
                {{-- Logo / Image --}}
                <div class="flex justify-center">
                    <div class="relative w-full max-w-[300px] md:max-w-[360px] h-[260px] md:h-[360px] flex items-center justify-center">
                        <div class="absolute inset-0 bg-[#f8f4ee]/80 blur-[70px] md:blur-[80px] opacity-95"></div>
                        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 w-[60%] h-14 md:h-16 bg-black/14 blur-3xl rounded-full"></div>

                        <img
                            src="{{ asset('storage/images/logo.PNG') }}"
                            alt="Hareer Logo"
                            class="relative max-h-[210px] md:max-h-[270px] max-w-full object-contain drop-shadow-[0_35px_55px_rgba(47,42,38,0.26)] md:drop-shadow-[0_45px_70px_rgba(47,42,38,0.30)]"
                        >
                    </div>
                </div>

                {{-- Text --}}
                <div class="hareer-arabic text-right" dir="rtl">
                    <p class="text-[10px] md:text-[11px] uppercase tracking-[0.24em] md:tracking-[0.28em] text-[#7a7268] mb-4" dir="ltr">
                        About Hareer
                    </p>

                    <h2 class="hareer-arabic-title text-3xl md:text-5xl text-[#15120f] mb-6 md:mb-7">
                        أناقة تحاكي الستر
                    </h2>

                    <div class="space-y-5 text-[#2f2a26] text-[14px] md:text-[17px] leading-[2] md:leading-[2.05]">
                        <p>
                            في عالم الأناقة المُحتشمة، حيث يلتقي الوقار والجمال، نقدّم تجربة فريدة في تصميم وصناعة
                            <span class="font-semibold text-[#15120f]">الچادر الإيراني</span>
                            بأسلوب عصريّ راقٍ، يجمع بين أصالة التُراث وروح الحَداثة.
                        </p>

                        <p>
                            لقد حَرصنا على أن يكون كلّ چادر قطعة فنيّة متكاملة، تتجلّى فيها دقّة الحِرفيّة من خلال
                            <span class="font-semibold text-[#15120f]">الشّك اليدوي والتطريز بالخرز</span>،
                            لتمنح المرأة إطلالة مميّزة تعبّر عن ذوقها الرّفيع وهويتها الخاصة.
                        </p>

                        <p>
                            لم تكُن هذه الخُطوة مجرّد مشروعٍ تجاري، بل كانت رحلة إلهام بدأت من لحظة روحانيّة عميقة،
                            حيث تشرّفت بزيارة الإمام عليّ بن موسى الرّضا عليه السّلام، ولفتت أنظاري أناقة بعض النّساء
                            اللّواتي ارتدين هذا النّمط من الچوادر المزيّنة بذوق رفيع.
                        </p>

                        <p>
                            في تلك اللّحظة وُلدت الفكرة في القلب قبل العقل، وشعرت وكأنّ توفيقًا إلهيًّا وإلهامًا مُباركًا
                            قد دُفع إلينا لننقل هذا الجمال إلى بيئتنا.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Vision Section --}}
    <section class="max-w-6xl mx-auto px-4 pb-14 md:pb-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 md:gap-6">
            {{-- Card 1 --}}
            <div class="group bg-[#f8f4ee] border-y border-[#ded0bf] px-6 py-8 text-center transition duration-300 hover:bg-[#f1e9df] hover:-translate-y-1 hover:shadow-[0_24px_60px_rgba(47,42,38,0.10)]">
                <div class="mx-auto mb-5 w-12 h-12 rounded-full border border-[#c8ad83]/70 flex items-center justify-center text-[#2f9ea0]">
                    <span class="hareer-serif text-2xl">01</span>
                </div>

                <h3 class="hareer-arabic-title text-2xl text-[#15120f]">
                    الأصالة
                </h3>

                <p class="hareer-arabic mt-3 text-sm leading-relaxed text-[#6f675f]" dir="rtl">
                    نحافظ على روح الچادر الإيراني الأصليّة ونقدّمه بأسلوب يليق بالمرأة اليوم.
                </p>
            </div>

            {{-- Card 2 --}}
            <div class="group bg-[#f8f4ee] border-y border-[#ded0bf] px-6 py-8 text-center transition duration-300 hover:bg-[#f1e9df] hover:-translate-y-1 hover:shadow-[0_24px_60px_rgba(47,42,38,0.10)]">
                <div class="mx-auto mb-5 w-12 h-12 rounded-full border border-[#c8ad83]/70 flex items-center justify-center text-[#2f9ea0]">
                    <span class="hareer-serif text-2xl">02</span>
                </div>

                <h3 class="hareer-arabic-title text-2xl text-[#15120f]">
                    الحِرفيّة
                </h3>

                <p class="hareer-arabic mt-3 text-sm leading-relaxed text-[#6f675f]" dir="rtl">
                    كل قطعة تحمل تفاصيل دقيقة من الشك اليدوي والتطريز المختار بعناية.
                </p>
            </div>

            {{-- Card 3 --}}
            <div class="group bg-[#f8f4ee] border-y border-[#ded0bf] px-6 py-8 text-center transition duration-300 hover:bg-[#f1e9df] hover:-translate-y-1 hover:shadow-[0_24px_60px_rgba(47,42,38,0.10)]">
                <div class="mx-auto mb-5 w-12 h-12 rounded-full border border-[#c8ad83]/70 flex items-center justify-center text-[#2f9ea0]">
                    <span class="hareer-serif text-2xl">03</span>
                </div>

                <h3 class="hareer-arabic-title text-2xl text-[#15120f]">
                    الرسالة
                </h3>

                <p class="hareer-arabic mt-3 text-sm leading-relaxed text-[#6f675f]" dir="rtl">
                    نؤمن أن الجمال المحتشم رسالة راقية تعبّر عن الذوق والهوية والإيمان.
                </p>
            </div>
        </div>
    </section>

    {{-- Final Message --}}
    <section class="relative bg-[#15120f] text-white py-12 md:py-16 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(47,158,160,0.20),transparent_35%),radial-gradient(circle_at_80%_30%,rgba(200,173,131,0.14),transparent_35%)]"></div>

        <div class="relative max-w-4xl mx-auto px-4 text-center" dir="rtl">
            <p class="hareer-arabic text-[14px] md:text-[18px] leading-[2.05] md:leading-[2.1] text-white/85">
                ومن هُنا انطلقت الرّؤية لنكون من أوائل من يقدّم هذا النّمط من الچوادر الإيرانيّة المصنّعة بعناية وننقلها إلى لبنان،
                مع الحِفاظ على روحها الأصليّة وإضفاء لمسة مُعاصرة تُواكب ذوق المرأة اليوم.
            </p>

            <div class="my-7 flex items-center justify-center gap-4">
                <div class="w-14 md:w-24 h-px bg-[#c8ad83]"></div>
                <span class="w-2 h-2 rotate-45 bg-[#c8ad83]"></span>
                <div class="w-14 md:w-24 h-px bg-[#c8ad83]"></div>
            </div>

            <h2 class="hareer-arabic-title text-3xl md:text-5xl text-[#9edfdc]">
                الحمد لله
            </h2>

            <p class="hareer-arabic mt-5 text-[14px] md:text-[18px] leading-[2.05] md:leading-[2.1] text-white/85">
                الحمد لله الّذي وفّقنا لهذه الخُطوة، وجعل من هذا العمل رسالة نعبّر من خلالها عن الجَمال المُحتشم،
                والإبداع المتجذّر في الإيمان.
            </p>

            <div class="mt-9 flex flex-col sm:flex-row justify-center gap-4">
                <a
                    href="{{ route('products.index') }}"
                    class="inline-flex w-full sm:w-auto justify-center bg-[#2f9ea0] text-white px-9 py-3 rounded-full text-[11px] uppercase tracking-[0.18em] font-semibold hover:bg-[#257f81] transition shadow-[0_14px_35px_rgba(47,158,160,0.28)]"
                >
                    تسوّقي الآن
                </a>

                <a
                    href="{{ route('contact') }}"
                    class="inline-flex w-full sm:w-auto justify-center border border-[#9edfdc]/80 text-[#9edfdc] px-9 py-3 rounded-full text-[11px] uppercase tracking-[0.18em] font-semibold hover:bg-[#9edfdc] hover:text-[#15120f] transition"
                >
                    تواصلي معنا
                </a>
            </div>
        </div>
    </section>
</div>
</x-app-layout>