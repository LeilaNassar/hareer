<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Hareer') }}</title>

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- Scripts --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-[#f8f4ee] text-[#2f2a26] overflow-x-hidden">
        <div class="min-h-screen bg-[#f8f4ee] overflow-x-hidden">
            @include('layouts.navigation')

            {{-- Page Heading --}}
            @isset($header)
                <header class="bg-[#f8f4ee] shadow-[0_1px_0_rgba(222,208,191,0.7)]">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            {{-- Page Content --}}
            <main class="pt-16 md:pt-20">
                {{ $slot }}
            </main>

            <x-footer />
        </div>
    </body>
</html>