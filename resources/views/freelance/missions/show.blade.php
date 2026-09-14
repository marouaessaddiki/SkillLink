<x-workspace-shell role="freelance" title="Mission Details" eyebrow="Find Missions">
    <div class="mx-auto max-w-6xl">
        <a href="{{ route('freelance.missions.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors">
            <x-icon name="chevron-left" class="w-3.5 h-3.5" />
            <span>Back to Mission Board</span>
        </a>

        <div class="mt-6 grid gap-8 lg:grid-cols-[1fr_380px] lg:items-start">
            <!-- Left: Mission Details Column -->
            <article>
                <div class="flex flex-wrap items-center gap-2.5">
                    <span class="rounded-md bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                        {{ $mission->category?->name ?? 'General' }}
                    </span>
                    <x-status-badge :status="$mission->status" size="sm" />
                </div>

                <h2 class="mt-4 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl leading-tight">
                    {{ $mission->title }}
                </h2>

                <div class="mt-4 flex flex-wrap items-center gap-4 text-xs text-slate-500 border-b border-slate-200/80 pb-6">
                    <div class="flex items-center gap-1.5">
                        <span class="flex h-6 w-6 items-center justify-center rounded-full bg-slate-900 text-[10px] font-bold text-white">
                            {{ strtoupper(substr($mission->client->name ?? 'C', 0, 1)) }}
                        </span>
                        <span>Client: <strong class="text-slate-800">{{ $mission->client->name }}</strong></span>
                    </div>
                    <span>&bull;</span>
                    <span>Posted {{ $mission->created_at->diffForHumans() }}</span>
                    <span>&bull;</span>
                    <span>{{ $mission->applications_count }} {{ Str::plural('application', $mission->applications_count) }}</span>
                </div>

                <!-- Mission Description -->
                <section class="sl-panel mt-6 p-6 sm:p-8">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Mission Overview &amp; Scope</h3>
                    <div class="mt-4 whitespace-pre-line text-sm leading-relaxed text-slate-700 font-normal">
                        {{ $mission->description }}
                    </div>
                </section>

                <!-- Key Specifications -->
                <section class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="sl-panel p-5">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Target Budget</p>
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                                <x-icon name="cash" class="w-4 h-4" />
                            </span>
                        </div>
                        <p class="mt-2 text-2xl font-bold text-slate-900">
                            {{ number_format($mission->budget, 2) }} <span class="text-xs font-medium text-slate-500">MAD</span>
                        </p>
                        <p class="mt-1 text-xs text-slate-400">Fixed-price milestone target</p>
                    </div>

                    <div class="sl-panel p-5">
                        <div class="flex items-center justify-between">
                            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Expected Delivery</p>
                            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                                <x-icon name="calendar" class="w-4 h-4" />
                            </span>
                        </div>
                        <p class="mt-2 text-xl font-bold text-slate-900">{{ $mission->deadline }}</p>
                        <p class="mt-1 text-xs text-slate-400">Target delivery date</p>
                    </div>
                </section>
            </article>

            <!-- Right: Proposal Submission Box -->
            <aside class="lg:sticky lg:top-6">
                <div class="sl-panel overflow-hidden">
                    <div class="bg-slate-900 p-6 text-white">
                        <p class="text-xs font-bold uppercase tracking-widest text-blue-400">Your Proposal</p>
                        <h3 class="mt-1 text-xl font-bold text-white">Submit Your Terms</h3>
                        <p class="mt-1 text-xs text-slate-300">Clients favor clear scope definitions and realistic quotes.</p>
                    </div>

                    @if($application)
                        <!-- Already Applied State -->
                        <div class="p-6">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                    <x-icon name="check-circle" class="w-6 h-6" />
                                </span>
                                <div>
                                    <p class="font-bold text-slate-900">Proposal Submitted</p>
                                    <div class="mt-0.5">
                                        <x-status-badge :status="$application->status" size="sm" />
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 space-y-3 border-t border-slate-100 pt-4 text-xs">
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Your Proposed Price:</span>
                                    <strong class="text-slate-900">{{ number_format($application->proposed_price, 2) }} MAD</strong>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-slate-500">Date Sent:</span>
                                    <span class="text-slate-700">{{ $application->date_submission?->format('d M Y') ?? $application->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            <div class="mt-5 rounded-xl bg-slate-50 p-4 text-xs text-slate-600 border border-slate-100">
                                <p class="font-semibold text-slate-800">Your Cover Message:</p>
                                <p class="mt-1.5 leading-relaxed">{{ $application->cover_letter }}</p>
                            </div>

                            @if($application->status === 'pending')
                                <a href="{{ route('freelance.applications.edit', $application) }}" class="sl-button-secondary w-full mt-5 text-xs py-2">
                                    <x-icon name="pencil" class="w-3.5 h-3.5" />
                                    <span>Edit Pending Proposal</span>
                                </a>
                            @endif
                        </div>
                    @else
                        <!-- Proposal Submission Form -->
                        <form method="POST" action="{{ route('freelance.missions.apply', $mission) }}" class="p-6">
                            @csrf
                            <div>
                                <label for="proposed_price" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                    Your Proposed Price (MAD)
                                </label>
                                <div class="mt-1.5 flex items-center rounded-xl border border-slate-200 bg-white px-3 focus-within:border-blue-600 focus-within:ring-2 focus-within:ring-blue-100">
                                    <input id="proposed_price" name="proposed_price" type="number" min="0" step="0.01" required 
                                           class="w-full border-0 bg-transparent py-2.5 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:ring-0" 
                                           placeholder="e.g. 5000">
                                    <span class="text-xs font-bold text-slate-400">MAD</span>
                                </div>
                                <x-input-error :messages="$errors->get('proposed_price')" class="mt-1" />
                            </div>

                            <div class="mt-4">
                                <label for="cover_letter" class="block text-xs font-semibold text-slate-700 uppercase tracking-wider">
                                    Cover Letter &amp; Technical Approach
                                </label>
                                <textarea id="cover_letter" name="cover_letter" rows="5" required 
                                          class="mt-1.5 w-full rounded-xl border border-slate-200 text-sm placeholder:text-slate-400 focus:border-blue-600 focus:ring-2 focus:ring-blue-100" 
                                          placeholder="Explain your relevant experience, proposed milestones, and delivery timeframe..."></textarea>
                                <x-input-error :messages="$errors->get('cover_letter')" class="mt-1" />
                            </div>

                            <button type="submit" class="sl-button-primary mt-5 w-full py-3">
                                <span>Send Proposal</span>
                                <x-icon name="arrow-up-right" class="w-4 h-4" />
                            </button>

                            <div class="mt-5 space-y-2 border-t border-slate-100 pt-4 text-[11px] text-slate-500">
                                <p class="flex items-center gap-1.5">
                                    <x-icon name="shield-check" class="w-3.5 h-3.5 text-emerald-600" />
                                    <span>Milestone payment protection</span>
                                </p>
                                <p class="flex items-center gap-1.5">
                                    <x-icon name="check" class="w-3.5 h-3.5 text-blue-600" />
                                    <span>Direct review upon client acceptance</span>
                                </p>
                            </div>
                        </form>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</x-workspace-shell>
