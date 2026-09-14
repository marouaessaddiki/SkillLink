<x-workspace-shell role="client" title="Offers & Proposals" eyebrow="Client Workspace">
    <div class="mx-auto max-w-5xl">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Received Offers</h2>
                <p class="mt-1 text-sm text-slate-500">Compare freelancer proposals, review cover letters, and select the best fit for your mission.</p>
            </div>
            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-200">
                {{ $applications->where('status', 'pending')->count() }} pending review
            </span>
        </div>

        @if(session('success'))
            <div class="mt-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
                <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-8 space-y-8">
            @forelse($applications->groupBy('mission_id') as $missionApplications)
                @php($mission = $missionApplications->first()->mission)
                <section class="sl-panel overflow-hidden">
                    <div class="flex flex-col justify-between gap-3 border-b border-slate-100 bg-slate-50/60 p-5 sm:flex-row sm:items-center sm:px-6">
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                {{ $mission->category?->name ?? 'Mission' }}
                            </span>
                            <h3 class="mt-0.5 text-lg font-bold text-slate-900">
                                <a href="{{ route('missions.show', $mission) }}" class="hover:text-blue-600">
                                    {{ $mission->title }}
                                </a>
                            </h3>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-slate-500">
                            <span>Budget: <strong class="text-slate-900">{{ number_format($mission->budget, 2) }} MAD</strong></span>
                            <span>&bull;</span>
                            <span class="rounded-full bg-white px-2.5 py-1 font-semibold text-slate-700 border border-slate-200">
                                {{ $missionApplications->count() }} {{ Str::plural('proposal', $missionApplications->count()) }}
                            </span>
                        </div>
                    </div>

                    <div class="divide-y divide-slate-100">
                        @foreach($missionApplications as $application)
                            <article class="p-5 sm:p-6 transition-colors {{ $application->status === 'accepted' ? 'bg-emerald-50/40' : 'bg-white' }}">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex items-start gap-3.5">
                                        <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-900 font-bold text-white text-sm">
                                            {{ strtoupper(substr($application->freelance->name, 0, 1)) }}
                                        </span>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <h4 class="font-bold text-slate-900">{{ $application->freelance->name }}</h4>
                                                <x-status-badge :status="$application->status" size="sm" />
                                            </div>
                                            <p class="text-xs text-slate-400 mt-0.5">{{ $application->freelance->email }}</p>
                                        </div>
                                    </div>

                                    <div class="sm:text-right">
                                        <p class="text-xl font-bold text-slate-900">
                                            {{ number_format($application->proposed_price, 2) }} <span class="text-xs font-semibold text-slate-500">MAD</span>
                                        </p>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            Submitted {{ $application->date_submission?->diffForHumans() ?? $application->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <div class="mt-4 rounded-xl bg-slate-50 p-4 text-sm leading-relaxed text-slate-700 border border-slate-100">
                                    {{ $application->cover_letter }}
                                </div>

                                <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
                                    @if($application->status === 'pending')
                                        <div class="flex items-center gap-2">
                                            <form method="POST" action="{{ route('client.applications.accept', $application) }}" onsubmit="return confirm('Accepting this proposal will set the mission in progress and notify the freelancer. Continue?');">
                                                @csrf
                                                <button type="submit" class="sl-button-primary px-4 py-2 text-xs">
                                                    <x-icon name="check" class="w-3.5 h-3.5" />
                                                    <span>Accept Proposal</span>
                                                </button>
                                            </form>
                                            <form method="POST" action="{{ route('client.applications.reject', $application) }}">
                                                @csrf
                                                <button type="submit" class="sl-button-danger px-3.5 py-2 text-xs">
                                                    <span>Decline</span>
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($application->status === 'accepted')
                                        <div class="flex items-center gap-2 text-xs font-semibold text-emerald-700">
                                            <x-icon name="check-circle" class="w-4 h-4 text-emerald-600" />
                                            <span>Accepted candidate &bull; Mission is currently in progress</span>
                                        </div>
                                        <a href="{{ route('missions.show', $mission) }}" class="sl-button-secondary px-3.5 py-1.5 text-xs">
                                            <span>Manage Mission Details &rarr;</span>
                                        </a>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>
            @empty
                <div class="sl-panel p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <x-icon name="users" class="w-6 h-6" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-slate-900">No proposals received yet</h3>
                    <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                        Once freelancers review your published briefs and submit their offers, they will be organized here by mission.
                    </p>
                    <a href="{{ route('missions.create') }}" class="sl-button-primary mt-5">
                        <x-icon name="plus" class="w-4 h-4" />
                        <span>Create a Mission</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-workspace-shell>
