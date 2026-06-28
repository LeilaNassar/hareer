<footer class="relative mt-16 overflow-hidden">
    {{-- Main Footer --}}
    <div class="relative bg-[#0f6968] text-white">
        {{-- Soft texture/glow --}}
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_20%_20%,rgba(158,223,220,0.18),transparent_35%),radial-gradient(circle_at_80%_30%,rgba(200,173,131,0.10),transparent_35%)]"></div>
        <div class="absolute inset-0 bg-black/10"></div>

        <div class="relative max-w-7xl mx-auto px-4 py-10 md:py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-8 text-center md:text-right" dir="rtl">

                {{-- Contact --}}
                <div class="md:border-l md:border-white/25 md:pl-8">
                    <h3 class="text-lg font-semibold mb-5 text-white">
                        تواصل معنا
                    </h3>

                    <div class="space-y-4 text-white/85 text-sm">
                        <a
                            href="https://wa.me/96170260654"
                            target="_blank"
                            class="flex items-center justify-center md:justify-end gap-3 hover:text-[#c8ad83] transition"
                        >
                            <span dir="ltr">+961 70 260 654</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c8ad83] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.142-4.03 7.5-9 7.5a10.4 10.4 0 0 1-3.42-.57L3 21l1.64-4.06A7.02 7.02 0 0 1 3 12c0-4.142 4.03-7.5 9-7.5s9 3.358 9 7.5Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.6 10.3c.5 1.6 1.8 2.9 3.4 3.4l1.1-1.1c.2-.2.5-.3.8-.2.9.3 1.8.4 2.7.4.4 0 .7.3.7.7v1.8c0 .4-.3.7-.7.7A10.6 10.6 0 0 1 6 5.4c0-.4.3-.7.7-.7h1.8c.4 0 .7.3.7.7 0 .9.1 1.8.4 2.7.1.3 0 .6-.2.8l-.8 1.4Z" />
                            </svg>
                        </a>

                        <a
                            href="https://instagram.com/hareer_lb"
                            target="_blank"
                            class="flex items-center justify-center md:justify-end gap-3 hover:text-[#c8ad83] transition"
                        >
                            <span dir="ltr">@hareer_lb</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c8ad83] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <rect x="4" y="4" width="16" height="16" rx="5" />
                                <circle cx="12" cy="12" r="3.2" />
                                <path stroke-linecap="round" d="M17.5 6.8h.01" />
                            </svg>
                        </a>

                        <a
                            href="mailto:info@hareer-lb.com"
                            class="flex items-center justify-center md:justify-end gap-3 hover:text-[#c8ad83] transition break-all"
                        >
                            <span dir="ltr">info@hareer-lb.com</span>

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c8ad83] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6.75h16v10.5H4V6.75Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4 7 8 6 8-6" />
                            </svg>
                        </a>

                        <p class="flex items-center justify-center md:justify-end gap-3">
                            لبنان

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#c8ad83] shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21s7-5.3 7-11a7 7 0 1 0-14 0c0 5.7 7 11 7 11Z" />
                                <circle cx="12" cy="10" r="2.5" />
                            </svg>
                        </p>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div class="md:border-l md:border-white/25 md:pl-8">
                    <h3 class="text-lg font-semibold mb-5 text-white">
                        روابط سريعة
                    </h3>

                    <div class="space-y-3 text-white/85 text-sm">
                        <a href="{{ route('home') }}" class="block hover:text-[#c8ad83] transition">
                            الرئيسية
                        </a>

                        <a href="{{ route('products.index') }}" class="block hover:text-[#c8ad83] transition">
                            تسوّقي
                        </a>

                        <a href="{{ route('products.index', ['sale' => 1]) }}" class="block hover:text-[#c8ad83] transition">
                            العروض
                        </a>

                        <a href="{{ route('about') }}" class="block hover:text-[#c8ad83] transition">
                            من نحن
                        </a>

                        <a href="{{ route('contact') }}" class="block hover:text-[#c8ad83] transition">
                            تواصل
                        </a>
                    </div>
                </div>

                {{-- Brand --}}
                <div class="flex flex-col items-center md:items-center md:text-center" dir="ltr">
                    <img
                        src="{{ asset('storage/images/logo.PNG') }}"
                        alt="Hareer Logo"
                        class="w-24 h-24 md:w-28 md:h-28 object-contain mb-3 drop-shadow-[0_18px_35px_rgba(0,0,0,0.25)]"
                    >

                    <h3 class="hareer-serif text-2xl tracking-[0.22em] text-[#d8cbb8] leading-none">
                        HAREER
                    </h3>

                    <p class="mt-3 text-white/85 text-sm" dir="rtl">
                        أناقة تحاكي الستر
                    </p>

                    {{-- Social icons --}}
                    <div class="mt-6 flex items-center justify-center gap-5 text-[#d8cbb8]">
                        <a href="https://instagram.com/hareer_lb" target="_blank" class="hover:text-white transition" aria-label="Instagram">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <rect x="4" y="4" width="16" height="16" rx="5" />
                                <circle cx="12" cy="12" r="3.2" />
                                <path stroke-linecap="round" d="M17.5 6.8h.01" />
                            </svg>
                        </a>

                        <a href="https://wa.me/96170260654" target="_blank" class="hover:text-white transition" aria-label="WhatsApp">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12c0 4.142-4.03 7.5-9 7.5a10.4 10.4 0 0 1-3.42-.57L3 21l1.64-4.06A7.02 7.02 0 0 1 3 12c0-4.142 4.03-7.5 9-7.5s9 3.358 9 7.5Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.6 10.3c.5 1.6 1.8 2.9 3.4 3.4l1.1-1.1c.2-.2.5-.3.8-.2.9.3 1.8.4 2.7.4.4 0 .7.3.7.7v1.8c0 .4-.3.7-.7.7A10.6 10.6 0 0 1 6 5.4c0-.4.3-.7.7-.7h1.8c.4 0 .7.3.7.7 0 .9.1 1.8.4 2.7.1.3 0 .6-.2.8l-.8 1.4Z" />
                            </svg>
                        </a>

                        <a href="#" class="hover:text-white transition" aria-label="TikTok">
                            <span class="text-lg font-bold">♪</span>
                        </a>

                        <a href="#" class="hover:text-white transition" aria-label="Facebook">
                            <span class="text-lg font-bold">f</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Black Bar --}}
    <div class="bg-[#070707] text-white/60">
        <div class="max-w-7xl mx-auto px-4 py-4 text-center text-xs">
            <p dir="rtl">
                ©️ {{ date('Y') }} HAREER. جميع الحقوق محفوظة.
            </p>

            <p class="mt-2">
                Developed by
                <a
                    href="https://wa.me/96171429323"
                    target="_blank"
                    class="font-semibold text-[#9edfdc] hover:text-white transition"
                >
                    Leila Nassar
                </a>
            </p>
        </div>
    </div>
</footer>