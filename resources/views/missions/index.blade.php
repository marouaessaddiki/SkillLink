<x-workspace-shell role="client" title="My Missions" eyebrow="Client Workspace">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">My Missions</h2>
                <p class="mt-1 text-sm text-slate-500">Track and manage your published briefs and incoming proposals.</p>
            </div>
            <a href="{{ route('missions.create') }}" class="sl-button-primary">
                <x-icon name="plus" class="w-4 h-4" />
                <span>Post a Mission</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mt-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
                <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="mt-8 grid gap-5 lg:grid-cols-2">
            @forelse($missions as $mission)
                <article class="sl-panel p-6 flex flex-col justify-between transition-all hover:border-slate-300">
                    <div>
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <span class="inline-block rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-semibold text-slate-600">
                                    {{ $mission->category?->name ?? 'General Category' }}
                                </span>
                                <h3 class="mt-2 text-lg font-bold text-slate-900">
                                    <a href="{{ route('missions.show', $mission) }}" class="hover:text-blue-600">
                                        {{ $mission->title }}
                                    </a>
                                </h3>
                            </div>
                            <x-status-badge :status="$mission->status" size="sm" />
                        </div>

                        <p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">
                            {{ $mission->description }}
                        </p>
                    </div>

                    <div class="mt-6">
                        <div class="grid grid-cols-3 gap-3 border-y border-slate-100 py-3 text-center text-xs">
                            <div>
                                <p class="text-slate-400 font-medium">Budget</p>
                                <p class="mt-0.5 font-bold text-slate-900">{{ number_format($mission->budget, 2) }} MAD</p>
                            </div>
                            <div>
                                <p class="text-slate-400 font-medium">Deadline</p>
                                <p class="mt-0.5 font-bold text-slate-900">{{ $mission->deadline }}</p>
                            </div>
                            <div>
                                <p class="text-slate-400 font-medium">Offers</p>
                                <p class="mt-0.5 font-bold text-blue-600">{{ $mission->applications_count }}</p>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
                            <div class="flex flex-wrap items-center gap-2">
                                <a href="{{ route('missions.show', $mission) }}" class="sl-button-primary px-3.5 py-1.5 text-xs">
                                    Manage Details
                                </a>
                                <a href="{{ route('client.applications.index') }}" class="sl-button-secondary px-3.5 py-1.5 text-xs">
                                    View Offers ({{ $mission->applications_count }})
                                </a>
                                <a href="{{ route('missions.edit', $mission) }}" class="sl-button-secondary px-3 py-1.5 text-xs">
                                    <x-icon name="pencil" class="w-3.5 h-3.5" />
                                    <span>Edit</span>
                                </a>
                            </div>

                            <form method="POST" action="{{ route('missions.destroy', $mission) }}" onsubmit="return confirm('Are you sure you want to delete this mission?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="sl-button-danger px-3 py-1.5 text-xs">
                                    <x-icon name="trash" class="w-3.5 h-3.5" />
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </article>
            @empty
                <div class="sl-panel col-span-full p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <x-icon name="briefcase" class="w-6 h-6" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-slate-900">You haven't posted any missions yet</h3>
                    <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                        Publish your requirements, budget, and deadline to start receiving proposals from qualified professionals.
                    </p>
                    <a href="{{ route('missions.create') }}" class="sl-button-primary mt-5">
                        <x-icon name="plus" class="w-4 h-4" />
                        <span>Post Your First Mission</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-workspace-shell>
