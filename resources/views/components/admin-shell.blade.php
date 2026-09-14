@props(['title' => 'Platform Overview'])

@php
    $user = auth()->user();
    $unreadCount = $user ? $user->unreadNotifications->count() : 0;

    $items = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'icon' => 'home', 'pattern' => 'admin.dashboard'],
        ['label' => 'Users', 'route' => 'admin.users.index', 'icon' => 'users', 'pattern' => 'admin.users.*'],
        ['label' => 'Missions', 'route' => 'admin.missions.index', 'icon' => 'briefcase', 'pattern' => 'admin.missions.*'],
        ['label' => 'Categories', 'route' => 'admin.categories.index', 'icon' => 'layers', 'pattern' => 'admin.categories.*'],
        ['label' => 'Applications', 'route' => 'admin.applications.index', 'icon' => 'document-text', 'pattern' => 'admin.applications.*'],
        ['label' => 'Activity Log', 'route' => 'admin.activity.index', 'icon' => 'activity', 'pattern' => 'admin.activity.*'],
        ['label' => 'Notifications', 'route' => 'workspace.notifications', 'icon' => 'bell', 'pattern' => 'workspace.notifications', 'badge' => $unreadCount],
    ];
@endphp

<x-app-layout>
    <div class="min-h-[calc(100vh-65px)] bg-slate-50/50">
        <div class="mx-auto grid max-w-[1480px] lg:grid-cols-[260px_1fr]">
            <!-- Desktop Admin Sidebar -->
            <aside class="hidden border-r border-slate-800 bg-slate-950 px-4 py-6 text-white lg:flex lg:flex-col lg:justify-between">
                <div>
                    <!-- Brand Header -->
                    <div class="px-3 mb-6">
                        <div class="flex items-center gap-2">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 font-bold text-white text-sm shadow-sm">
                                SL
                            </span>
                            <div>
                                <p class="text-sm font-bold tracking-tight text-white">Skill<span class="text-blue-400">Link</span></p>
                                <p class="text-[10px] font-semibold uppercase tracking-wider text-slate-400">Admin Console</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Items -->
                    <nav class="space-y-1">
                        @foreach($items as $item)
                            @php
                                $isActive = request()->routeIs($item['pattern']);
                            @endphp
                            <a href="{{ route($item['route']) }}" 
                               class="group flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition-colors {{ $isActive ? 'bg-blue-600 text-white font-semibold shadow-xs' : 'text-slate-400 hover:bg-slate-900 hover:text-white' }}">
                                <div class="flex items-center gap-3">
                                    <x-icon :name="$item['icon']" class="w-4 h-4 transition-colors {{ $isActive ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}" />
                                    <span>{{ $item['label'] }}</span>
                                </div>
                                @if(!empty($item['badge']) && $item['badge'] > 0)
                                    <span class="inline-flex h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1.5 text-[10px] font-bold text-white">
                                        {{ $item['badge'] }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </nav>
                </div>

                <!-- Admin Profile Card & Logout -->
                <div class="border-t border-slate-800 pt-4">
                    <div class="flex items-center gap-3 rounded-xl bg-slate-900/60 p-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-sm font-bold text-white">
                            {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-xs font-semibold text-white">{{ $user->name ?? 'Admin' }}</p>
                            <p class="truncate text-[10px] text-slate-400">Super Administrator</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-xs font-medium text-slate-400 hover:bg-slate-900 hover:text-white transition-colors">
                            <x-icon name="logout" class="w-3.5 h-3.5" />
                            <span>Sign Out</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Admin Content Area -->
            <main class="min-w-0">
                <header class="border-b border-slate-200/80 bg-white px-5 py-4 sm:px-8 lg:px-10">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <nav class="flex items-center gap-1.5 text-xs font-medium text-slate-400">
                                <span>Administration</span>
                                <x-icon name="chevron-right" class="w-3 h-3 text-slate-300" />
                                <span class="text-slate-600">{{ $title }}</span>
                            </nav>
                            <h1 class="mt-1 text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">
                                {{ $title }}
                            </h1>
                        </div>

                        <!-- Header Right Controls -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('workspace.notifications') }}" 
                               class="relative inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-xs hover:bg-slate-50 transition-colors"
                               title="Notifications">
                                <x-icon name="bell" class="w-4 h-4" />
                                @if($unreadCount > 0)
                                    <span class="absolute -right-1 -top-1 flex h-4 min-w-4 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>

                            <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-1.5 shadow-xs">
                                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-900 text-xs font-bold text-white">
                                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                                </span>
                                <span class="hidden sm:inline text-xs font-semibold text-slate-800">{{ $user->name ?? 'Admin' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Sub-navigation Bar -->
                    <div class="mt-4 flex gap-1.5 overflow-x-auto lg:hidden">
                        @foreach($items as $item)
                            @php $isActive = request()->routeIs($item['pattern']); @endphp
                            <a href="{{ route($item['route']) }}" 
                               class="whitespace-nowrap inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ $isActive ? 'bg-blue-600 text-white font-semibold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                                <x-icon :name="$item['icon']" class="w-3.5 h-3.5 {{ $isActive ? 'text-white' : 'text-slate-400' }}" />
                                <span>{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </header>

                <div class="px-5 py-6 sm:px-8 sm:py-8 lg:px-10 lg:py-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
