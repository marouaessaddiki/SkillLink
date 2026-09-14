<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="sl-grid min-h-screen flex flex-col justify-center px-5 py-10">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="sl-panel mx-auto w-full max-w-md p-7 sm:p-9">
                {{ $slot }}
            </div>
            <p class="mx-auto mt-6 text-sm text-[var(--muted)]">The right skill for the right mission.</p>
        </div>
    </body>
</html>
