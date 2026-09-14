@props(['title' => 'Platform Overview'])

@php
    $items = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => '⌂'],
        ['label' => 'Users', 'route' => 'admin.users.index', 'icon' => '◉'],
        ['label' => 'Missions', 'route' => 'admin.missions.index', 'icon' => '▤'],
        ['label' => 'Categories', 'route' => 'admin.categories.index', 'icon' => '◇'],
        ['label' => 'Applications', 'route' => 'admin.applications.index', 'icon' => '↗'],
        ['label' => 'Activity', 'route' => 'admin.activity.index', 'icon' => '◷'],
        ['label' => 'Notifications', 'route' => 'workspace.notifications', 'icon' => '♢'],
    ];
@endphp

<x-app-layout>
    <div class="min-h-[calc(100vh-65px)] bg-[#f4f6fa]">
        <div class="mx-auto grid max-w-[1480px] lg:grid-cols-[238px_1fr]">
            <aside class="hidden border-r border-slate-200 bg-[#111a2e] px-4 py-7 text-white lg:block">
                <div class="px-3"><p class="text-xl font-bold tracking-tight">Skill<span class="text-blue-300">Link</span></p><p class="mt-1 text-[10px] font-bold uppercase tracking-[.2em] text-slate-400">Control center</p></div>
                <p class="mt-10 px-3 text-[10px] font-bold uppercase tracking-[.2em] text-slate-500">Overview</p>
                <nav class="mt-3 space-y-1">
                    @foreach($items as $item)
                        <a href="{{ route($item['route']) }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition {{ request()->routeIs($item['route']) ? 'bg-blue-600 font-bold text-white shadow-lg shadow-blue-950/30' : 'text-slate-400 hover:bg-white/10 hover:text-white' }}"><span class="flex h-6 w-6 items-center justify-center">{{ $item['icon'] }}</span>{{ $item['label'] }}</a>
                    @endforeach
                </nav>
                <div class="mt-12 border-t border-white/10 pt-5"><a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-slate-300 hover:bg-white/10"><span class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-500 font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span><span><strong class="block text-white">{{ auth()->user()->name }}</strong><small class="text-slate-400">Administrator</small></span></a><form method="POST" action="{{ route('logout') }}" class="mt-2">@csrf<button class="w-full rounded-xl px-3 py-2 text-left text-xs font-bold text-slate-400 hover:bg-white/10 hover:text-white">↪ Log out</button></form></div>
            </aside>
            <main class="min-w-0">
                <header class="border-b border-slate-200 bg-white px-5 py-4 sm:px-8 lg:px-10"><div class="flex items-center justify-between gap-4"><div><p class="text-xs font-bold text-slate-400">Administration / {{ $title }}</p><h1 class="mt-1 text-2xl font-bold tracking-tight text-[#111a2e]">{{ $title }}</h1></div><div class="flex items-center gap-3"><div class="hidden items-center gap-2 rounded-xl border border-slate-200 px-3 py-2 text-sm text-slate-400 sm:flex">⌕ <span>Search platform</span></div><a href="{{ route('workspace.notifications') }}" class="rounded-xl border border-slate-200 px-3 py-2 text-slate-500 hover:bg-slate-50">♢</a><span class="flex h-9 w-9 items-center justify-center rounded-full bg-[#111a2e] text-sm font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span></div></div><div class="mt-4 flex gap-2 overflow-x-auto lg:hidden">@foreach($items as $item)<a href="{{ route($item['route']) }}" class="whitespace-nowrap rounded-full px-3 py-2 text-xs font-bold {{ request()->routeIs($item['route']) ? 'bg-blue-600 text-white' : 'bg-slate-100 text-slate-500' }}">{{ $item['label'] }}</a>@endforeach</div></header>
                <div class="px-5 py-7 sm:px-8 lg:px-10 lg:py-9">{{ $slot }}</div>
            </main>
        </div>
    </div>
</x-app-layout>
