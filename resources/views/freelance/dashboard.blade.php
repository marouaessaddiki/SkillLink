<x-workspace-shell role="freelance" title="Freelancer Dashboard" eyebrow="Workspace">
    <!-- Welcome Header & Primary CTA -->
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Good morning, {{ auth()->user()->name }}
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Discover new missions matching your skills and track your active commitments.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('freelance.applications.index') }}" class="sl-button-secondary">
                <x-icon name="briefcase" class="w-4 h-4" />
                <span>My Applications</span>
            </a>
            <a href="{{ route('freelance.missions.index') }}" class="sl-button-primary">
                <x-icon name="search" class="w-4 h-4" />
                <span>Find Missions</span>
            </a>
        </div>
    </div>

    <!-- Stat Cards -->
    <section class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Available Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <x-icon name="search" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-blue-600">{{ $stats['missions'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Open right now</p>
        </div>

        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Applications Sent</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                    <x-icon name="arrow-up-right" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-indigo-600">{{ $stats['applications'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Submitted proposals</p>
        </div>

        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                    <x-icon name="clock" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-amber-600">{{ $stats['in_progress'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Work in progress</p>
        </div>

        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Completed</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <x-icon name="check-circle" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">{{ $stats['completed'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Missions delivered</p>
        </div>
    </section>

    <!-- Main Section: Recommended & Pipeline -->
    <div class="mt-8 grid gap-7 xl:grid-cols-[1.35fr_.65fr]">
        <!-- Recommended Missions Column -->
        <section>
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Recommended Missions</h3>
                    <p class="text-xs text-slate-500">Open opportunities matching market demand</p>
                </div>
                <a href="{{ route('freelance.missions.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                    Browse all ({{ $stats['missions'] }}) &rarr;
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recommendedMissions as $mission)
                    <article class="sl-panel p-5 transition-all hover:border-slate-300 sm:p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <span class="inline-block rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-semibold text-slate-600">
                                    {{ $mission->category?->name ?? 'General Category' }}
                                </span>
                                <h4 class="mt-2 text-base font-bold text-slate-900 truncate">
                                    <a href="{{ route('freelance.missions.show', $mission) }}" class="hover:text-blue-600">
                                        {{ $mission->title }}
                                    </a>
                                </h4>
                            </div>
                            <x-status-badge status="open" size="sm" />
                        </div>

                        <p class="mt-2 line-clamp-2 text-sm leading-relaxed text-slate-600">
                            {{ $mission->description }}
                        </p>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-3 text-xs text-slate-500">
                            <div class="flex items-center gap-4">
                                <span>Budget: <strong class="font-semibold text-slate-900">{{ number_format($mission->budget, 2) }} MAD</strong></span>
                                <span>&bull;</span>
                                <span>Due: <strong class="font-semibold text-slate-900">{{ $mission->deadline }}</strong></span>
                            </div>
                            <a href="{{ route('freelance.missions.show', $mission) }}" class="inline-flex items-center gap-1 font-semibold text-blue-600 hover:text-blue-700">
                                <span>View details</span>
                                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="sl-panel p-10 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <x-icon name="search" class="w-6 h-6" />
                        </div>
                        <h4 class="mt-4 text-base font-bold text-slate-900">No open missions right now</h4>
                        <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                            Check back soon or explore the full mission board for newly submitted client briefs.
                        </p>
                        <a href="{{ route('freelance.missions.index') }}" class="sl-button-primary mt-5">
                            <x-icon name="search" class="w-4 h-4" />
                            <span>Browse All Missions</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Right Side: Pipeline & Active Commitments -->
        <aside class="space-y-6">
            <!-- Pending Applications -->
            <section class="sl-panel p-5 sm:p-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-bold text-slate-900">Pending Offers</h3>
                    <span class="rounded-full bg-amber-50 px-2 py-0.5 text-xs font-semibold text-amber-700 border border-amber-200">
                        {{ $pendingApplications->count() }} awaiting client
                    </span>
                </div>

                <div class="mt-4 divide-y divide-slate-100">
                    @forelse($pendingApplications as $application)
                        <a href="{{ route('freelance.applications.index') }}" class="block py-3 first:pt-0 last:pb-0 hover:bg-slate-50/60 rounded-lg px-2 transition-colors">
                            <p class="text-sm font-semibold text-slate-900 line-clamp-1">{{ $application->mission->title }}</p>
                            <div class="mt-1 flex items-center justify-between text-xs text-slate-500">
                                <span>Offer: <strong class="font-semibold text-slate-800">{{ number_format($application->proposed_price, 2) }} MAD</strong></span>
                                <span class="text-amber-600 font-medium">Pending</span>
                            </div>
                        </a>
                    @empty
                        <p class="py-4 text-center text-xs text-slate-400">No pending offers. Browse missions to apply.</p>
                    @endforelse
                </div>
            </section>

            <!-- Active In-Progress Missions -->
            <section class="sl-panel p-5 sm:p-6">
                <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                    <h3 class="text-sm font-bold text-slate-900">Active Deliverables</h3>
                    <span class="rounded-full bg-blue-50 px-2 py-0.5 text-xs font-semibold text-blue-700 border border-blue-200">
                        {{ $activeMissions->count() }} active
                    </span>
                </div>

                <div class="mt-4 space-y-3">
                    @forelse($activeMissions as $application)
                        <div class="rounded-xl border border-slate-200/80 bg-slate-50/60 p-3.5">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-slate-900 line-clamp-1">{{ $application->mission->title }}</p>
                                <x-status-badge status="in_progress" size="sm" />
                            </div>
                            <p class="mt-1 text-xs text-slate-500">
                                Client: {{ $application->mission->client->name ?? 'Client' }} &bull; Due: {{ $application->mission->deadline }}
                            </p>
                            <div class="mt-3 flex items-center justify-between text-xs">
                                <span class="font-medium text-slate-700">Contract: {{ number_format($application->proposed_price, 2) }} MAD</span>
                                <a href="{{ route('freelance.applications.index') }}" class="font-semibold text-blue-600 hover:text-blue-700">
                                    View details &rarr;
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="py-4 text-center text-xs text-slate-400">No active missions in progress.</p>
                    @endforelse
                </div>
            </section>
        </aside>
    </div>
</x-workspace-shell>
