<x-admin-shell title="Activity Monitoring">
    <div class="mb-7">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Audit & Events</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Platform Activity Log</h2>
        <p class="mt-1 text-sm text-slate-500">Real-time trace of mission publications and freelancer applications across the platform.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Application Events -->
        <section class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <x-icon name="document-text" class="w-4 h-4" />
                    </span>
                    <h3 class="font-bold text-slate-900">Recent Applications</h3>
                </div>
                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-600">
                    {{ $applications->count() }} events
                </span>
            </div>

            <div class="mt-5 space-y-4">
                @forelse($applications as $application)
                    <div class="flex items-start gap-3.5 rounded-xl p-3 transition-colors hover:bg-slate-50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600 font-semibold text-xs border border-blue-100">
                            {{ strtoupper(substr($application->freelance->name ?? 'F', 0, 1)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-slate-800 leading-snug">
                                <span class="font-semibold text-slate-900">{{ $application->freelance->name }}</span>
                                submitted an offer for
                                <span class="font-medium text-blue-600">{{ $application->mission->title }}</span>
                            </p>
                            <div class="mt-1 flex items-center gap-3 text-xs text-slate-400">
                                <span>{{ number_format($application->proposed_price, 2) }} MAD</span>
                                <span>&bull;</span>
                                <span>{{ $application->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-sm text-slate-400">
                        No recent application activity.
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Mission Events -->
        <section class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-2.5">
                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <x-icon name="briefcase" class="w-4 h-4" />
                    </span>
                    <h3 class="font-bold text-slate-900">Recent Missions Published</h3>
                </div>
                <span class="rounded-full bg-slate-100 px-2 py-0.5 text-xs font-semibold text-slate-600">
                    {{ $missions->count() }} events
                </span>
            </div>

            <div class="mt-5 space-y-4">
                @forelse($missions as $mission)
                    <div class="flex items-start gap-3.5 rounded-xl p-3 transition-colors hover:bg-slate-50">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-emerald-50 text-emerald-600 font-semibold text-xs border border-emerald-100">
                            {{ strtoupper(substr($mission->client->name ?? 'C', 0, 1)) }}
                        </span>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-slate-800 leading-snug">
                                <span class="font-semibold text-slate-900">{{ $mission->client->name ?? 'A client' }}</span>
                                published
                                <span class="font-medium text-emerald-700">{{ $mission->title }}</span>
                            </p>
                            <div class="mt-1 flex items-center gap-3 text-xs text-slate-400">
                                <span>Budget: {{ number_format($mission->budget, 2) }} MAD</span>
                                <span>&bull;</span>
                                <span>{{ $mission->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-sm text-slate-400">
                        No recent mission activity.
                    </div>
                @endforelse
            </div>
        </section>
    </div>
</x-admin-shell>
