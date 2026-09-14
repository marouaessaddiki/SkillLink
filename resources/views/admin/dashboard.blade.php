<x-admin-shell title="Platform Overview">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Operations & Health</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Platform Metrics & Governance</h2>
            <p class="mt-1 text-sm text-slate-500">Real-time overview of members, missions, and performance indicators.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-1.5 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-600 shadow-xs">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                System Operational
            </span>
        </div>
    </div>

    <!-- Core KPI Grid -->
    <section class="mt-8 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Users</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <x-icon name="users" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['users'] }}</p>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                <span>{{ $stats['clients'] }} clients</span>
                <span>&bull;</span>
                <span>{{ $stats['freelances'] }} freelancers</span>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                    <x-icon name="clock" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-amber-600">{{ $stats['active'] }}</p>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                <span>In delivery progress</span>
                <span class="font-medium text-slate-700">{{ $stats['missions'] ? round($stats['active'] / $stats['missions'] * 100) : 0 }}% of missions</span>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Completed Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <x-icon name="check-circle" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">{{ $stats['completed'] }}</p>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                <span>Delivered successfully</span>
                <span class="font-medium text-emerald-600">Closed</span>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <x-icon name="briefcase" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['missions'] }}</p>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                <span>All time published</span>
                <span>{{ $missionStatuses['open'] ?? 0 }} open now</span>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Applications Sent</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <x-icon name="arrow-up-right" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-indigo-600">{{ $stats['applications'] }}</p>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                <span>Total freelancer proposals</span>
                <span>{{ $pendingApplications->count() }} pending</span>
            </div>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Marketplace Balance</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <x-icon name="cash" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">
                {{ $stats['clients'] ? round($stats['freelances'] / max(1, $stats['clients']), 1) : 0 }}x
            </p>
            <div class="mt-3 flex items-center justify-between text-xs text-slate-500 border-t border-slate-100 pt-3">
                <span>Freelancers per client</span>
                <span class="text-emerald-600 font-medium">Healthy</span>
            </div>
        </div>
    </section>

    <!-- Missions Distribution & Operations -->
    <div class="mt-8 grid gap-6 xl:grid-cols-[1.3fr_.7fr]">
        <!-- Recent Missions Table -->
        <section class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-subtle">
            <div class="flex items-center justify-between border-b border-slate-100 p-5">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <x-icon name="briefcase" class="w-3.5 h-3.5" />
                    </span>
                    <h3 class="font-bold text-slate-900">Recent Missions</h3>
                </div>
                <a href="{{ route('admin.missions.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View all &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm divide-y divide-slate-100">
                    <thead class="bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-5 py-3">Mission</th>
                            <th class="px-5 py-3">Client</th>
                            <th class="px-5 py-3">Budget</th>
                            <th class="px-5 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($recentMissions as $mission)
                            <tr class="transition-colors hover:bg-slate-50/60">
                                <td class="px-5 py-3.5 font-semibold text-slate-900">{{ $mission->title }}</td>
                                <td class="px-5 py-3.5 text-slate-500">{{ $mission->client->name ?? '—' }}</td>
                                <td class="px-5 py-3.5 font-medium text-slate-800 whitespace-nowrap">{{ number_format($mission->budget, 2) }} MAD</td>
                                <td class="px-5 py-3.5 whitespace-nowrap">
                                    <x-status-badge :status="$mission->status" size="sm" />
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400 text-xs">No missions published yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Mission Status Distribution -->
        <section class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
            <h3 class="font-bold text-slate-900">Status Distribution</h3>
            <p class="mt-1 text-xs text-slate-500">Breakdown across all lifecycle stages.</p>
            <div class="mt-6 space-y-4">
                @foreach($missionStatuses as $status => $count)
                    <div>
                        <div class="mb-1.5 flex justify-between text-xs font-semibold">
                            <span class="capitalize text-slate-700">{{ str_replace('_', ' ', $status) }}</span>
                            <span class="text-slate-900">{{ $count }}</span>
                        </div>
                        <div class="h-2 rounded-full bg-slate-100 overflow-hidden">
                            <div class="h-2 rounded-full {{ $status === 'completed' ? 'bg-emerald-500' : ($status === 'in_progress' ? 'bg-amber-500' : ($status === 'cancelled' ? 'bg-slate-400' : 'bg-blue-600')) }}" 
                                 style="width: {{ $stats['missions'] ? max(4, round($count / $stats['missions'] * 100)) : 4 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Users & Quick Operations -->
    <div class="mt-8 grid gap-6 xl:grid-cols-2">
        <!-- Recent Users -->
        <section class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
            <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                <h3 class="font-bold text-slate-900">New Members</h3>
                <a href="{{ route('admin.users.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">View users &rarr;</a>
            </div>
            <div class="mt-4 divide-y divide-slate-100">
                @forelse($recentUsers as $u)
                    <div class="flex items-center justify-between py-3 first:pt-0 last:pb-0">
                        <div class="flex items-center gap-3">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-900 text-xs font-bold text-white">
                                {{ strtoupper(substr($u->name, 0, 1)) }}
                            </span>
                            <div>
                                <p class="text-sm font-semibold text-slate-900 leading-tight">{{ $u->name }}</p>
                                <p class="text-xs text-slate-400">{{ $u->email }}</p>
                            </div>
                        </div>
                        <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold uppercase text-slate-600">
                            {{ $u->roles->first()?->name ?? 'User' }}
                        </span>
                    </div>
                @empty
                    <p class="py-6 text-center text-xs text-slate-400">No users registered yet.</p>
                @endforelse
            </div>
        </section>

        <!-- Quick Admin Actions -->
        <section class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-slate-900">Quick Operations</h3>
                <p class="mt-1 text-xs text-slate-500">Jump directly to governance modules.</p>
                <div class="mt-5 grid grid-cols-2 gap-3">
                    <a href="{{ route('admin.missions.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-colors">
                        <x-icon name="briefcase" class="w-4 h-4 text-blue-600" />
                        <span>Missions</span>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-colors">
                        <x-icon name="users" class="w-4 h-4 text-slate-700" />
                        <span>Users</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-colors">
                        <x-icon name="layers" class="w-4 h-4 text-indigo-600" />
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200 p-3 text-sm font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-colors">
                        <x-icon name="document-text" class="w-4 h-4 text-amber-600" />
                        <span>Offers</span>
                    </a>
                </div>
            </div>
            <div class="mt-6 rounded-xl bg-slate-50 p-3.5 text-xs text-slate-500 flex items-center justify-between">
                <span>SkillLink v1.0 Admin Console</span>
                <span class="font-semibold text-slate-700">MySQL &bull; Laratrust RBAC</span>
            </div>
        </section>
    </div>
</x-admin-shell>
