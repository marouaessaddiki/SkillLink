@props([
    'role' => 'client',
    'title' => 'Workspace',
    'eyebrow' => 'SkillLink workspace',
])

@php
    $isFreelance = $role === 'freelance';
    $dashboardRoute = $isFreelance ? 'freelance.dashboard' : 'client.dashboard';
    $navItems = $isFreelance ? [
        ['label' => 'Workspace home', 'route' => 'freelance.dashboard', 'icon' => '⌂'],
        ['label' => 'Find missions', 'route' => 'freelance.missions.index', 'icon' => '⌕'],
        ['label' => 'My applications', 'route' => 'freelance.applications.index', 'icon' => '↗'],
        ['label' => 'Active missions', 'route' => 'freelance.applications.index', 'icon' => '◷'],
        ['label' => 'Completed missions', 'route' => 'freelance.applications.index', 'icon' => '✓'],
        ['label' => 'Notifications', 'route' => 'workspace.notifications', 'icon' => '♢'],
        ['label' => 'My profile', 'route' => 'profile.edit', 'icon' => '◉'],
    ] : [
        ['label' => 'Workspace home', 'route' => 'client.dashboard', 'icon' => '⌂'],
        ['label' => 'My missions', 'route' => 'missions.index', 'icon' => '▤'],
        ['label' => 'Create mission', 'route' => 'missions.create', 'icon' => '＋'],
        ['label' => 'Offers & applications', 'route' => 'client.applications.index', 'icon' => '↗'],
        ['label' => 'Active projects', 'route' => 'client.applications.index', 'icon' => '◷'],
        ['label' => 'Completed missions', 'route' => 'client.applications.index', 'icon' => '✓'],
        ['label' => 'Notifications', 'route' => 'workspace.notifications', 'icon' => '♢'],
        ['label' => 'My profile', 'route' => 'profile.edit', 'icon' => '◉'],
    ];
@endphp

<x-app-layout>
    <div class="min-h-[calc(100vh-65px)] bg-[var(--paper)]">
        <div class="mx-auto grid max-w-[1440px] lg:grid-cols-[240px_1fr]">
            <aside class="hidden border-r border-[var(--line)] bg-white px-4 py-7 lg:block">
                <p class="px-3 text-[10px] font-bold uppercase tracking-[.2em] text-[var(--muted)]">{{ $isFreelance ? 'Freelancer workspace' : 'Client workspace' }}</p>
                <nav class="mt-4 space-y-1">
                    @foreach($navItems as $item)
                        <a href="{{ route($item['route']) }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold transition {{ request()->routeIs($item['route']) ? 'bg-blue-50 font-bold text-[var(--blue)]' : 'text-[var(--muted)] hover:bg-slate-50' }}">
                            <span class="flex h-6 w-6 items-center justify-center text-base">{{ $item['icon'] }}</span>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
                <div class="mt-12 rounded-2xl {{ $isFreelance ? 'bg-[var(--ink)] text-white' : 'bg-blue-50' }} p-4">
                    <p class="text-xs font-bold {{ $isFreelance ? 'text-[var(--mint)]' : 'text-[var(--blue)]' }}">{{ $isFreelance ? 'Your next opportunity' : 'Bring an idea to life' }}</p>
                    <p class="mt-2 text-sm leading-6 {{ $isFreelance ? 'text-slate-200' : 'text-[var(--muted)]' }}">{{ $isFreelance ? 'Keep your profile sharp and let the right mission find you.' : 'A clear mission is the first step to finding the right skill.' }}</p>
                </div>
            </aside>

            <main class="min-w-0">
                <div class="border-b border-[var(--line)] bg-white/80 px-5 py-4 backdrop-blur sm:px-8 lg:px-10">
                    <div class="flex items-center justify-between gap-4">
                        <div class="min-w-0"><p class="truncate text-xs font-bold text-[var(--muted)]">{{ $eyebrow }} / {{ $title }}</p><h1 class="mt-1 truncate text-2xl font-bold tracking-tight text-[var(--ink)]">{{ $title }}</h1></div>
                        <div class="flex items-center gap-3"><div class="hidden items-center gap-2 rounded-xl border border-[var(--line)] bg-white px-3 py-2 text-sm text-[var(--muted)] sm:flex"><span>⌕</span><span>Search workspace</span></div><a href="{{ route('workspace.notifications') }}" class="relative rounded-xl border border-[var(--line)] px-3 py-2 text-[var(--muted)] hover:bg-blue-50" aria-label="Notifications">♢ @if(auth()->user()->unreadNotifications->count())<span class="absolute -right-1 -top-1 h-4 min-w-4 rounded-full bg-red-500 px-1 text-center text-[10px] font-bold text-white">{{ auth()->user()->unreadNotifications->count() }}</span>@endif</a><div class="flex h-9 w-9 items-center justify-center rounded-full bg-[var(--blue)] text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div></div>
                    </div>
                </div>
                <div class="border-b border-[var(--line)] bg-white px-5 py-3 lg:hidden"><div class="flex gap-2 overflow-x-auto">@foreach($navItems as $item)<a href="{{ route($item['route']) }}" class="whitespace-nowrap rounded-full px-3 py-2 text-xs font-bold {{ request()->routeIs($item['route']) ? 'bg-blue-50 text-[var(--blue)]' : 'bg-slate-50 text-[var(--muted)]' }}">{{ $item['label'] }}</a>@endforeach</div></div>
                <div class="px-5 py-7 sm:px-8 lg:px-10 lg:py-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
