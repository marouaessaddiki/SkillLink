<x-workspace-shell role="client" title="Mission Management" eyebrow="My Missions">
    <div class="mx-auto max-w-6xl">
        <a href="{{ route('missions.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors">
            <x-icon name="chevron-left" class="w-3.5 h-3.5" />
            <span>Back to My Missions</span>
        </a>

        @if(session('success'))
            <div class="mt-4 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
                <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 flex items-center gap-3 rounded-xl border border-rose-200 bg-rose-50/80 px-4 py-3 text-sm font-medium text-rose-800">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="mt-6 flex flex-col justify-between gap-5 sm:flex-row sm:items-start">
            <div>
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                        {{ $mission->category?->name ?? 'General Category' }}
                    </span>
                    <x-status-badge :status="$mission->status" size="sm" />
                </div>
                <h2 class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    {{ $mission->title }}
                </h2>
                <p class="mt-2 text-xs text-slate-500">
                    Published {{ $mission->created_at->diffForHumans() }} &bull; {{ $mission->applications_count }} {{ Str::plural('proposal', $mission->applications_count) }} received
                </p>
            </div>

            <div class="flex items-center gap-2.5">
                <a href="{{ route('missions.edit', $mission) }}" class="sl-button-secondary text-xs px-3.5 py-2">
                    <x-icon name="pencil" class="w-3.5 h-3.5" />
                    <span>Edit Brief</span>
                </a>
                <a href="{{ route('client.applications.index') }}" class="sl-button-primary text-xs px-3.5 py-2">
                    <span>Manage All Offers</span>
                    <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                </a>
            </div>
        </div>

        <div class="mt-8 grid gap-8 lg:grid-cols-[1fr_360px] lg:items-start">
            <main class="space-y-6">
                <!-- Brief Content -->
                <section class="sl-panel p-6 sm:p-8">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Brief Specifications</h3>
                    <div class="mt-4 whitespace-pre-line text-sm leading-relaxed text-slate-700">
                        {{ $mission->description }}
                    </div>
                </section>

                <!-- Received Offers List -->
                <section class="sl-panel p-6 sm:p-8">
                    <div class="flex items-center justify-between border-b border-slate-100 pb-4">
                        <div>
                            <p class="sl-kicker">Candidate Proposals</p>
                            <h3 class="mt-1 text-lg font-bold text-slate-900">Freelancer Offers</h3>
                        </div>
                        <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700">
                            {{ $mission->applications_count }} total
                        </span>
                    </div>

                    <div class="mt-6 space-y-4">
                        @forelse($mission->applications as $application)
                            <article class="rounded-xl border {{ $application->status === 'accepted' ? 'border-emerald-300 bg-emerald-50/40' : 'border-slate-200 bg-white' }} p-5">
                                <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                    <div class="flex items-start gap-3">
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
                                            {{ number_format($application->proposed_price, 2) }} MAD
                                        </p>
                                        <p class="text-xs text-slate-400 mt-0.5">
                                            {{ $application->date_submission?->format('d M Y') ?? $application->created_at->format('d M Y') }}
                                        </p>
                                    </div>
                                </div>

                                <p class="mt-4 rounded-xl bg-slate-50 p-4 text-xs leading-relaxed text-slate-700 border border-slate-100">
                                    {{ $application->cover_letter }}
                                </p>

                                @if($application->status === 'pending')
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <form method="POST" action="{{ route('client.applications.accept', $application) }}" onsubmit="return confirm('Accept this candidate? Other proposals will be declined automatically.');">
                                            @csrf
                                            <button type="submit" class="sl-button-primary px-3.5 py-1.5 text-xs">
                                                <x-icon name="check" class="w-3.5 h-3.5" />
                                                <span>Accept Offer</span>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('client.applications.reject', $application) }}">
                                            @csrf
                                            <button type="submit" class="sl-button-danger px-3 py-1.5 text-xs">
                                                <span>Reject</span>
                                            </button>
                                        </form>
                                    </div>
                                @elseif($application->status === 'accepted')
                                    <div class="mt-4 inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700">
                                        <x-icon name="check-circle" class="w-4 h-4 text-emerald-600" />
                                        <span>Selected Freelancer for this Mission</span>
                                    </div>
                                @endif
                            </article>
                        @empty
                            <div class="py-10 text-center text-slate-400">
                                <p class="text-sm font-semibold text-slate-700">No proposals received yet</p>
                                <p class="text-xs text-slate-400 mt-1">Freelancers discovering this mission on the board will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </section>

                <!-- Review Freelancer Form (if mission is completed) -->
                @if($mission->status === 'completed')
                    @php
                        $acceptedApp = $mission->applications->firstWhere('status', 'accepted');
                        $hasReviewed = \App\Models\Review::where('mission_id', $mission->id)->where('reviewer_id', auth()->id())->exists();
                    @endphp

                    @if($acceptedApp && !$hasReviewed)
                        <section class="sl-panel p-6 sm:p-8">
                            <h3 class="text-sm font-bold text-slate-900">Review Freelancer Performance</h3>
                            <p class="mt-1 text-xs text-slate-500">Rate the deliverables provided by {{ $acceptedApp->freelance->name }}.</p>

                            <form method="POST" action="{{ route('client.missions.review', $mission) }}" class="mt-4 space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700">Rating (1 to 5 Stars)</label>
                                    <select name="rating" required class="mt-1 w-full rounded-xl border-slate-200 text-sm focus:border-blue-600 focus:ring-blue-100">
                                        <option value="5">5 &mdash; Excellent delivery</option>
                                        <option value="4">4 &mdash; Very good</option>
                                        <option value="3">3 &mdash; Good</option>
                                        <option value="2">2 &mdash; Below expectations</option>
                                        <option value="1">1 &mdash; Poor</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-slate-700">Review Feedback</label>
                                    <textarea name="comment" rows="3" class="mt-1 w-full rounded-xl border-slate-200 text-sm placeholder:text-slate-400 focus:border-blue-600 focus:ring-blue-100" placeholder="Describe the quality of communication and deliverables..."></textarea>
                                </div>
                                <button type="submit" class="sl-button-primary text-xs px-4 py-2">
                                    <span>Submit Review</span>
                                </button>
                            </form>
                        </section>
                    @elseif($hasReviewed)
                        <section class="sl-panel p-6 text-emerald-800 bg-emerald-50/50 flex items-center gap-3">
                            <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
                            <p class="text-xs font-semibold">You have already submitted a verified review for this completed mission.</p>
                        </section>
                    @endif
                @endif
            </main>

            <!-- Sidebar Info Panel -->
            <aside class="lg:sticky lg:top-6 space-y-6">
                <section class="sl-panel overflow-hidden">
                    <div class="bg-slate-900 p-6 text-white">
                        <p class="text-xs font-bold uppercase tracking-widest text-blue-400">Allocated Budget</p>
                        <p class="mt-2 text-3xl font-bold">{{ number_format($mission->budget, 2) }} MAD</p>
                        <p class="mt-1 text-xs text-slate-300">Target milestone value</p>
                    </div>

                    <div class="space-y-4 p-6 text-xs text-slate-600">
                        <div>
                            <p class="font-bold uppercase tracking-wider text-slate-400">Deadline</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->deadline }}</p>
                        </div>

                        <div>
                            <p class="font-bold uppercase tracking-wider text-slate-400">Proposals Received</p>
                            <p class="mt-1 text-sm font-semibold text-slate-900">{{ $mission->applications_count }} offers</p>
                        </div>

                        <div class="border-t border-slate-100 pt-4">
                            <p class="font-bold uppercase tracking-wider text-slate-400">Mission Progress</p>
                            <div class="mt-3 space-y-3">
                                <div class="flex items-center gap-2 text-slate-900 font-medium">
                                    <span class="h-2 w-2 rounded-full bg-blue-600"></span>
                                    <span>Brief Published</span>
                                </div>
                                <div class="flex items-center gap-2 {{ $mission->applications_count ? 'text-slate-900 font-medium' : 'text-slate-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ $mission->applications_count ? 'bg-blue-600' : 'bg-slate-300' }}"></span>
                                    <span>Offers Received</span>
                                </div>
                                <div class="flex items-center gap-2 {{ in_array($mission->status, ['in_progress', 'completed']) ? 'text-slate-900 font-medium' : 'text-slate-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ in_array($mission->status, ['in_progress', 'completed']) ? 'bg-amber-500' : 'bg-slate-300' }}"></span>
                                    <span>In Delivery</span>
                                </div>
                                <div class="flex items-center gap-2 {{ $mission->status === 'completed' ? 'text-emerald-700 font-medium' : 'text-slate-400' }}">
                                    <span class="h-2 w-2 rounded-full {{ $mission->status === 'completed' ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                                    <span>Completed &amp; Validated</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
    </div>
</x-workspace-shell>
