<x-workspace-shell role="freelance" title="My Applications" eyebrow="Freelancer Workspace">
    <div class="mx-auto max-w-5xl">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">My Applications</h2>
                <p class="mt-1 text-sm text-slate-500">Track all your submitted offers, active contracts, and client reviews.</p>
            </div>
            <a href="{{ route('freelance.missions.index') }}" class="sl-button-primary">
                <x-icon name="search" class="w-4 h-4" />
                <span>Explore Missions</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mt-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
                <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-6 flex items-center gap-3 rounded-xl border border-rose-200 bg-rose-50/80 px-4 py-3 text-sm font-medium text-rose-800">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="mt-8 space-y-6">
            @forelse($applications as $application)
                <article class="sl-panel overflow-hidden">
                    <div class="flex flex-col justify-between gap-3 border-b border-slate-100 bg-slate-50/60 p-5 sm:flex-row sm:items-center sm:px-6">
                        <div>
                            <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-500">
                                Mission Proposal
                            </span>
                            <h3 class="mt-0.5 text-lg font-bold text-slate-900">
                                {{ $application->mission->title }}
                            </h3>
                            <p class="text-xs text-slate-500 mt-0.5">
                                Client: {{ $application->mission->client->name ?? 'Client' }} &bull; Client budget: {{ number_format($application->mission->budget, 2) }} MAD &bull; Due: {{ $application->mission->deadline }}
                            </p>
                        </div>
                        <x-status-badge :status="$application->status" size="sm" />
                    </div>

                    <div class="p-5 sm:p-6">
                        <div class="grid gap-3 sm:grid-cols-3">
                            <div class="rounded-xl bg-slate-50 p-3.5 border border-slate-100 text-center sm:text-left">
                                <p class="text-[11px] font-semibold uppercase text-slate-400">Your Proposed Price</p>
                                <p class="mt-1 text-xl font-bold text-slate-900">{{ number_format($application->proposed_price, 2) }} MAD</p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3.5 border border-slate-100 text-center sm:text-left">
                                <p class="text-[11px] font-semibold uppercase text-slate-400">Date Submitted</p>
                                <p class="mt-1 text-sm font-bold text-slate-900">
                                    {{ $application->date_submission?->format('d M Y') ?? $application->created_at->format('d M Y') }}
                                </p>
                            </div>
                            <div class="rounded-xl bg-slate-50 p-3.5 border border-slate-100 text-center sm:text-left">
                                <p class="text-[11px] font-semibold uppercase text-slate-400">Mission Status</p>
                                <p class="mt-1 text-sm font-bold text-slate-900 capitalize">
                                    {{ str_replace('_', ' ', $application->mission->status) }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-4 rounded-xl border border-slate-100 bg-white p-4">
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Cover Letter</p>
                            <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $application->cover_letter }}</p>
                        </div>

                        <!-- Action Bar for Proposal -->
                        <div class="mt-5 flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-slate-100">
                            @if($application->status === 'pending')
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('freelance.applications.edit', $application) }}" class="sl-button-secondary px-3.5 py-1.5 text-xs">
                                        <x-icon name="pencil" class="w-3.5 h-3.5" />
                                        <span>Edit Offer</span>
                                    </a>
                                    <form method="POST" action="{{ route('freelance.applications.destroy', $application) }}" onsubmit="return confirm('Withdraw this offer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="sl-button-danger px-3 py-1.5 text-xs">
                                            <x-icon name="trash" class="w-3.5 h-3.5" />
                                            <span>Withdraw</span>
                                        </button>
                                    </form>
                                </div>
                            @elseif($application->status === 'accepted' && $application->mission->status === 'in_progress')
                                <form method="POST" action="{{ route('freelance.missions.complete', $application->mission) }}" onsubmit="return confirm('Confirm mission completion? Client will be notified to review deliverables.');">
                                    @csrf
                                    <button type="submit" class="sl-button-primary px-4 py-2 text-xs">
                                        <x-icon name="check-circle" class="w-4 h-4" />
                                        <span>Mark Mission as Completed</span>
                                    </button>
                                </form>
                            @elseif($application->mission->status === 'completed')
                                <div class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700">
                                    <x-icon name="check-circle" class="w-4 h-4" />
                                    <span>Mission Completed &amp; Validated</span>
                                </div>
                            @endif
                        </div>

                        <!-- Review Client Section (If mission completed) -->
                        @if($application->mission->status === 'completed')
                            <div class="mt-5 border-t border-slate-100 pt-5">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-600">Review Client Collaboration</p>
                                <form method="POST" action="{{ route('freelance.missions.review-client', $application->mission) }}" class="mt-3 grid gap-3 sm:grid-cols-[180px_1fr_auto]">
                                    @csrf
                                    <select name="rating" required class="rounded-xl border-slate-200 text-sm focus:border-blue-600 focus:ring-blue-100">
                                        <option value="">Select Rating</option>
                                        <option value="5">5 &mdash; Excellent</option>
                                        <option value="4">4 &mdash; Very Good</option>
                                        <option value="3">3 &mdash; Good</option>
                                        <option value="2">2 &mdash; Fair</option>
                                        <option value="1">1 &mdash; Poor</option>
                                    </select>
                                    <input name="comment" class="rounded-xl border-slate-200 text-sm focus:border-blue-600 focus:ring-blue-100" placeholder="Optional review comment...">
                                    <button type="submit" class="sl-button-primary px-4 py-2 text-xs">
                                        Submit Review
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </article>
            @empty
                <div class="sl-panel p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <x-icon name="briefcase" class="w-6 h-6" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-slate-900">No applications submitted yet</h3>
                    <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                        Explore open missions on the opportunity board and submit your first competitive proposal.
                    </p>
                    <a href="{{ route('freelance.missions.index') }}" class="sl-button-primary mt-5">
                        <x-icon name="search" class="w-4 h-4" />
                        <span>Find Missions</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-workspace-shell>
