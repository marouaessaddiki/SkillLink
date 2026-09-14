@props([
    'role' => 'client',
    'title' => 'Workspace',
    'eyebrow' => 'SkillLink workspace',
])

@php
    $isFreelance = $role === 'freelance';
    $user = auth()->user();
    $unreadCount = $user ? $user->unreadNotifications->count() : 0;

    $navItems = $isFreelance ? [
        ['label' => 'Dashboard', 'route' => 'freelance.dashboard', 'icon' => 'home', 'pattern' => 'freelance.dashboard'],
        ['label' => 'Explore Missions', 'route' => 'freelance.missions.index', 'icon' => 'search', 'pattern' => 'freelance.missions.*'],
        ['label' => 'My Applications', 'route' => 'freelance.applications.index', 'icon' => 'briefcase', 'pattern' => 'freelance.applications.*'],
        ['label' => 'Notifications', 'route' => 'workspace.notifications', 'icon' => 'bell', 'pattern' => 'workspace.notifications', 'badge' => $unreadCount],
        ['label' => 'Account Settings', 'route' => 'profile.edit', 'icon' => 'user', 'pattern' => 'profile.*'],
    ] : [
        ['label' => 'Dashboard', 'route' => 'client.dashboard', 'icon' => 'home', 'pattern' => 'client.dashboard'],
        ['label' => 'My Missions', 'route' => 'missions.index', 'icon' => 'briefcase', 'pattern' => 'missions.index|missions.show|missions.edit'],
        ['label' => 'Create Mission', 'route' => 'missions.create', 'icon' => 'plus', 'pattern' => 'missions.create'],
        ['label' => 'Received Offers', 'route' => 'client.applications.index', 'icon' => 'users', 'pattern' => 'client.applications.*'],
        ['label' => 'Notifications', 'route' => 'workspace.notifications', 'icon' => 'bell', 'pattern' => 'workspace.notifications', 'badge' => $unreadCount],
        ['label' => 'Account Settings', 'route' => 'profile.edit', 'icon' => 'user', 'pattern' => 'profile.*'],
    ];
@endphp

<x-app-layout>
    <div class="min-h-[calc(100vh-65px)] bg-slate-50/50">
        <div class="mx-auto grid max-w-[1440px] lg:grid-cols-[260px_1fr]">
            <!-- Desktop Sidebar -->
            <aside class="hidden border-r border-slate-200/80 bg-white px-4 py-6 lg:flex lg:flex-col lg:justify-between">
                <div>
                    <!-- Workspace Badge -->
                    <div class="px-3 mb-6">
                        <span class="inline-flex items-center gap-1.5 rounded-md bg-slate-100 px-2.5 py-1 text-[11px] font-semibold uppercase tracking-wider text-slate-600">
                            <span class="h-1.5 w-1.5 rounded-full {{ $isFreelance ? 'bg-indigo-500' : 'bg-blue-500' }}"></span>
                            {{ $isFreelance ? 'Freelancer Workspace' : 'Client Workspace' }}
                        </span>
                    </div>

                    <!-- Navigation Items -->
                    <nav class="space-y-1">
                        @foreach($navItems as $item)
                            @php
                                $patterns = explode('|', $item['pattern']);
                                $isActive = false;
                                foreach ($patterns as $p) {
                                    if (request()->routeIs($p)) {
                                        $isActive = true;
                                        break;
                                    }
                                }
                            @endphp
                            <a href="{{ route($item['route']) }}" 
                               class="group flex items-center justify-between rounded-xl px-3 py-2.5 text-sm font-medium transition-all {{ $isActive ? 'bg-blue-50/90 text-blue-700 font-semibold shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <div class="flex items-center gap-3">
                                    <x-icon :name="$item['icon']" class="w-4 h-4 transition-colors {{ $isActive ? 'text-blue-600' : 'text-slate-400 group-hover:text-slate-600' }}" />
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

                <!-- Bottom Helper Card -->
                <div class="mt-8 rounded-xl border border-slate-200/80 bg-slate-50/60 p-4">
                    <div class="flex items-center gap-2">
                        <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-blue-100 text-blue-700">
                            <x-icon name="shield-check" class="w-3.5 h-3.5" />
                        </span>
                        <p class="text-xs font-semibold text-slate-800">
                            {{ $isFreelance ? 'SkillLink Verified' : 'Mission Guarantee' }}
                        </p>
                    </div>
                    <p class="mt-2 text-xs leading-relaxed text-slate-500">
                        {{ $isFreelance ? 'Clear requirements, protected deliverables, and direct milestone reviews.' : 'Connect with qualified freelancers ready to start on your brief today.' }}
                    </p>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="min-w-0">
                <!-- Top Breadcrumb Bar -->
                <div class="border-b border-slate-200/80 bg-white px-5 py-4 sm:px-8 lg:px-10">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="min-w-0">
                            <nav class="flex items-center gap-1.5 text-xs font-medium text-slate-400">
                                <span>{{ $eyebrow }}</span>
                                <x-icon name="chevron-right" class="w-3 h-3 text-slate-300" />
                                <span class="text-slate-600">{{ $title }}</span>
                            </nav>
                            <h1 class="mt-1 truncate text-xl font-bold tracking-tight text-slate-900 sm:text-2xl">
                                {{ $title }}
                            </h1>
                        </div>

                        <!-- Right Actions: Notifications & Avatar -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('workspace.notifications') }}" 
                               class="relative inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-600 shadow-xs hover:bg-slate-50 hover:text-slate-900 transition-colors" 
                               title="Notifications"
                               aria-label="Notifications">
                                <x-icon name="bell" class="w-4 h-4" />
                                @if($unreadCount > 0)
                                    <span class="absolute -right-1 -top-1 flex h-4 min-w-4 items-center justify-center rounded-full bg-rose-500 px-1 text-[10px] font-bold text-white shadow-xs">
                                        {{ $unreadCount }}
                                    </span>
                                @endif
                            </a>

                            <div class="flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 py-1.5 shadow-xs">
                                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-900 text-xs font-bold text-white">
                                    {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                </span>
                                <div class="hidden sm:block text-left">
                                    <p class="text-xs font-semibold text-slate-800 leading-none">{{ $user->name ?? 'User' }}</p>
                                    <p class="text-[10px] text-slate-400 leading-none mt-1 capitalize">{{ $user->roles->first()?->name ?? 'Member' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mobile Sub-navigation Bar -->
                <div class="border-b border-slate-200/80 bg-white px-4 py-2.5 lg:hidden overflow-x-auto">
                    <div class="flex gap-1.5 min-w-max">
                        @foreach($navItems as $item)
                            @php
                                $patterns = explode('|', $item['pattern']);
                                $isActive = false;
                                foreach ($patterns as $p) {
                                    if (request()->routeIs($p)) {
                                        $isActive = true;
                                        break;
                                    }
                                }
                            @endphp
                            <a href="{{ route($item['route']) }}" 
                               class="inline-flex items-center gap-1.5 rounded-lg px-3 py-1.5 text-xs font-medium transition-colors {{ $isActive ? 'bg-blue-50 text-blue-700 font-semibold' : 'bg-slate-50 text-slate-600 hover:bg-slate-100' }}">
                                <x-icon :name="$item['icon']" class="w-3.5 h-3.5 {{ $isActive ? 'text-blue-600' : 'text-slate-400' }}" />
                                <span>{{ $item['label'] }}</span>
                                @if(!empty($item['badge']) && $item['badge'] > 0)
                                    <span class="rounded-full bg-rose-500 px-1 text-[9px] font-bold text-white">
                                        {{ $item['badge'] }}
                                    </span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Page Body Slot -->
                <div class="px-5 py-6 sm:px-8 sm:py-8 lg:px-10 lg:py-10">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
</x-app-layout>
