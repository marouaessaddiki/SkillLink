<x-workspace-shell role="client" title="Client Dashboard" eyebrow="Workspace">
    <!-- Welcome Header & Primary CTAs -->
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Welcome back, {{ auth()->user()->name }}
            </h2>
            <p class="mt-1 text-sm text-slate-500">
                Track your briefs, compare freelancer offers, and manage active deliverables.
            </p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('client.applications.index') }}" class="sl-button-secondary">
                <x-icon name="users" class="w-4 h-4" />
                <span>Review Offers</span>
            </a>
            <a href="{{ route('missions.create') }}" class="sl-button-primary">
                <x-icon name="plus" class="w-4 h-4" />
                <span>Post a Mission</span>
            </a>
        </div>
    </div>

    <!-- Metric Stat Cards -->
    <section class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <x-icon name="briefcase" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900">{{ $stats['total'] }}</p>
            <p class="mt-1 text-xs text-slate-500">All published briefs</p>
        </div>

        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Open Missions</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                    <x-icon name="search" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-sky-600">{{ $stats['open'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Receiving proposals</p>
        </div>

        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Work</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                    <x-icon name="clock" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-amber-600">{{ $stats['in_progress'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Currently in delivery</p>
        </div>

        <div class="sl-panel p-5">
            <div class="flex items-center justify-between">
                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Offers Received</p>
                <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                    <x-icon name="arrow-up-right" class="w-3.5 h-3.5" />
                </span>
            </div>
            <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">{{ $stats['applications'] }}</p>
            <p class="mt-1 text-xs text-slate-500">Freelancer proposals</p>
        </div>
    </section>

    <!-- Main Workspace Grid -->
    <div class="mt-8 grid gap-7 xl:grid-cols-[1.35fr_.65fr]">
        <!-- Recent Missions Column -->
        <section>
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Your Missions</h3>
                    <p class="text-xs text-slate-500">Recently published and in-progress briefs</p>
                </div>
                <a href="{{ route('missions.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">
                    View all ({{ $stats['total'] }}) &rarr;
                </a>
            </div>

            <div class="space-y-4">
                @forelse($recentMissions as $mission)
                    <article class="sl-panel p-5 transition-all hover:border-slate-300 sm:p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <span class="inline-block rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-semibold text-slate-600">
                                    {{ $mission->category?->name ?? 'General Category' }}
                                </span>
                                <h4 class="mt-2 text-base font-bold text-slate-900 truncate">
                                    <a href="{{ route('missions.show', $mission) }}" class="hover:text-blue-600">
                                        {{ $mission->title }}
                                    </a>
                                </h4>
                            </div>
                            <x-status-badge :status="$mission->status" size="sm" />
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
                            <a href="{{ route('missions.show', $mission) }}" class="inline-flex items-center gap-1 font-semibold text-blue-600 hover:text-blue-700">
                                <span>Manage mission</span>
                                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </article>
                @empty
                    <div class="sl-panel p-10 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <x-icon name="briefcase" class="w-6 h-6" />
                        </div>
                        <h4 class="mt-4 text-base font-bold text-slate-900">No missions published yet</h4>
                        <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                            Post your first brief to receive competitive proposals from vetted freelance professionals.
                        </p>
                        <a href="{{ route('missions.create') }}" class="sl-button-primary mt-5">
                            <x-icon name="plus" class="w-4 h-4" />
                            <span>Create Your First Mission</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Right Side: Lifecycle & Quick Steps -->
        <aside class="space-y-6">
            <!-- Next Actions -->
            <section class="sl-panel p-5 sm:p-6">
                <h3 class="text-sm font-bold text-slate-900">Quick Actions</h3>
                <div class="mt-4 space-y-2.5">
                    <a href="{{ route('missions.create') }}" class="flex items-center gap-3 rounded-xl border border-slate-200/80 p-3.5 text-sm font-semibold text-slate-800 transition-colors hover:bg-slate-50">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                            <x-icon name="plus" class="w-4 h-4" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 leading-tight">Post a Mission</p>
                            <p class="text-xs text-slate-500 font-normal">Define requirements and budget</p>
                        </div>
                    </a>

                    <a href="{{ route('client.applications.index') }}" class="flex items-center gap-3 rounded-xl border border-slate-200/80 p-3.5 text-sm font-semibold text-slate-800 transition-colors hover:bg-slate-50">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                            <x-icon name="users" class="w-4 h-4" />
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900 leading-tight">Review Proposals</p>
                            <p class="text-xs text-slate-500 font-normal">{{ $stats['applications'] }} offers awaiting response</p>
                        </div>
                    </a>
                </div>
            </section>

            <!-- Mission Lifecycle Card -->
            <section class="sl-panel p-5 sm:p-6">
                <h3 class="text-sm font-bold text-slate-900">Mission Flow</h3>
                <p class="text-xs text-slate-500 mt-0.5">How your projects progress on SkillLink</p>

                <div class="mt-5 space-y-4">
                    <div class="flex items-start gap-3">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-blue-100 text-xs font-bold text-blue-700">1</span>
                        <div>
                            <p class="text-xs font-semibold text-slate-900">Publish Brief</p>
                            <p class="text-[11px] text-slate-500">Freelancers discover and send tailored proposals.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-amber-100 text-xs font-bold text-amber-800">2</span>
                        <div>
                            <p class="text-xs font-semibold text-slate-900">Accept & Contract</p>
                            <p class="text-[11px] text-slate-500">Choosing an offer sets status to In Progress.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-xs font-bold text-emerald-800">3</span>
                        <div>
                            <p class="text-xs font-semibold text-slate-900">Deliver & Review</p>
                            <p class="text-[11px] text-slate-500">Validate completion and leave mutual ratings.</p>
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </div>
</x-workspace-shell>
