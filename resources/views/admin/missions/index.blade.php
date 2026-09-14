<x-admin-shell title="Missions Management">
    <div class="mb-7 flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Platform Directory</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Missions Management</h2>
            <p class="mt-1 text-sm text-slate-500">Monitor all client projects, track lifecycles, and enforce platform standards.</p>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 mb-7">
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Briefs</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <x-icon name="document-text" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-slate-900">{{ $stats['total'] }}</p>
            <p class="mt-1 text-xs text-slate-400">All registered missions</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Open</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                    <x-icon name="clock" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-blue-600">{{ $stats['open'] }}</p>
            <p class="mt-1 text-xs text-slate-400">Awaiting freelancer offers</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">In Progress</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                    <x-icon name="activity" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-amber-600">{{ $stats['in_progress'] }}</p>
            <p class="mt-1 text-xs text-slate-400">Active development</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <div class="flex items-center justify-between">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">Completed</span>
                <span class="flex h-8 w-8 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                    <x-icon name="check-circle" class="w-4 h-4" />
                </span>
            </div>
            <p class="mt-3 text-2xl font-bold text-emerald-600">{{ $stats['completed'] }}</p>
            <p class="mt-1 text-xs text-slate-400">Successfully closed</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
            <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Filters & Search Form -->
    <form method="GET" action="{{ route('admin.missions.index') }}" class="mb-6 flex flex-col gap-3 rounded-2xl border border-slate-200/90 bg-white p-4 shadow-subtle sm:flex-row sm:items-center">
        <div class="relative flex-1">
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5 text-slate-400">
                <x-icon name="search" class="w-4 h-4" />
            </span>
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search missions by title..."
                class="w-full rounded-xl border-slate-200 bg-white pl-10 text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors"
            >
        </div>

        <div class="flex items-center gap-2">
            <select
                name="status"
                class="rounded-xl border-slate-200 bg-white text-sm text-slate-900 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors"
            >
                <option value="">All Statuses</option>
                <option value="open" {{ request('status') === 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit" class="sl-button-primary py-2 px-4 text-xs font-bold">
                <x-icon name="filter" class="w-3.5 h-3.5" />
                <span>Filter</span>
            </button>

            @if(request('search') || request('status'))
                <a href="{{ route('admin.missions.index') }}" class="sl-button-secondary py-2 px-3 text-xs">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- Missions Data Table -->
    <div class="overflow-hidden rounded-2xl border border-slate-200/90 bg-white shadow-subtle">
        <div class="border-b border-slate-100 px-6 py-4 flex items-center justify-between">
            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">
                Showing {{ $missions->count() }} records
            </span>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm divide-y divide-slate-100">
                <thead class="bg-slate-50/75 text-[11px] font-bold uppercase tracking-wider text-slate-500">
                    <tr>
                        <th scope="col" class="px-6 py-3.5">Mission Brief</th>
                        <th scope="col" class="px-6 py-3.5">Client</th>
                        <th scope="col" class="px-6 py-3.5">Category</th>
                        <th scope="col" class="px-6 py-3.5">Budget</th>
                        <th scope="col" class="px-6 py-3.5">Status</th>
                        <th scope="col" class="px-6 py-3.5">Deadline</th>
                        <th scope="col" class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white text-slate-700">
                    @forelse($missions as $mission)
                        <tr class="transition-colors hover:bg-slate-50/60">
                            <td class="px-6 py-4">
                                <div class="font-semibold text-slate-900 line-clamp-1 max-w-xs">
                                    {{ $mission->title }}
                                </div>
                                <div class="mt-0.5 flex items-center gap-2 text-xs text-slate-400">
                                    <span>#{{ $mission->id }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $mission->applications_count ?? 0 }} proposals</span>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-900 text-xs font-bold text-white">
                                        {{ strtoupper(substr($mission->client->name ?? 'C', 0, 1)) }}
                                    </span>
                                    <div>
                                        <p class="font-medium text-slate-900 leading-none">{{ $mission->client->name ?? '—' }}</p>
                                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $mission->client->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="rounded-md bg-slate-100 px-2 py-0.5 text-xs font-medium text-slate-700">
                                    {{ $mission->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-slate-900">
                                {{ number_format($mission->budget, 2) }} MAD
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <x-status-badge :status="$mission->status" size="sm" />
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-500">
                                {{ is_string($mission->deadline) ? $mission->deadline : $mission->deadline?->format('d M Y') }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <form method="POST" action="{{ route('admin.missions.destroy', $mission) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to permanently delete this mission?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-2.5 py-1 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                                        <x-icon name="trash" class="w-3.5 h-3.5" />
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                <x-icon name="document-text" class="mx-auto w-8 h-8 text-slate-300 mb-2" />
                                <p class="text-base font-semibold text-slate-700">No missions found</p>
                                <p class="text-xs text-slate-400 mt-1">Try adjusting your keyword search or status filter.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-shell>