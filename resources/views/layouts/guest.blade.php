<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SkillLink') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-full bg-slate-50 text-slate-900 antialiased flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center">
            <a href="/" class="inline-block transition-transform hover:scale-105">
                <x-application-logo />
            </a>
            <p class="mt-2 text-xs font-semibold uppercase tracking-widest text-slate-400">
                The Professional Link Between Work &amp; Skill
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md px-4 sm:px-0">
            <div class="rounded-2xl border border-slate-200/90 bg-white p-7 sm:p-9 shadow-subtle">
                {{ $slot }}
            </div>
            <div class="mt-6 text-center text-xs text-slate-400">
                <a href="{{ route('home') }}" class="font-medium text-slate-500 hover:text-blue-600 transition-colors">
                    &larr; Back to SkillLink Home
                </a>
            </div>
        </div>
    </body>
</html>
