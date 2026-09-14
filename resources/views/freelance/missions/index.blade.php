<x-workspace-shell role="freelance" title="Find Missions" eyebrow="Freelancer Workspace">
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Explore Missions</h2>
                <p class="mt-1 text-sm text-slate-500">Discover curated opportunities and submit proposals with your terms.</p>
            </div>
            <span class="rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700 border border-blue-200">
                {{ $missions->count() }} {{ Str::plural('opportunity', $missions->count()) }} found
            </span>
        </div>

        <!-- Search and Filter Bar -->
        <form method="GET" action="{{ route('freelance.missions.index') }}" class="mt-7 rounded-2xl border border-slate-200/90 bg-white p-4 shadow-subtle">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center">
                <!-- Keyword Input -->
                <div class="flex min-w-0 flex-1 items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50/50 px-3.5 focus-within:border-blue-600 focus-within:bg-white focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                    <x-icon name="search" class="w-4 h-4 text-slate-400 shrink-0" />
                    <input name="search" value="{{ request('search') }}" placeholder="Search by title or keyword..." class="w-full border-0 bg-transparent py-2.5 text-sm text-slate-900 placeholder:text-slate-400 focus:ring-0">
                </div>

                <!-- Category Select -->
                <select name="category_id" class="rounded-xl border-slate-200 text-sm text-slate-700 focus:border-blue-600 focus:ring-blue-100">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Min Budget -->
                <input name="min_budget" value="{{ request('min_budget') }}" type="number" min="0" placeholder="Min MAD" class="w-28 rounded-xl border-slate-200 text-sm text-slate-700 focus:border-blue-600 focus:ring-blue-100">

                <!-- Max Budget -->
                <input name="max_budget" value="{{ request('max_budget') }}" type="number" min="0" placeholder="Max MAD" class="w-28 rounded-xl border-slate-200 text-sm text-slate-700 focus:border-blue-600 focus:ring-blue-100">

                <!-- Sort -->
                <select name="sort" class="rounded-xl border-slate-200 text-sm text-slate-700 focus:border-blue-600 focus:ring-blue-100">
                    <option value="latest">Latest</option>
                    <option value="deadline" {{ request('sort') === 'deadline' ? 'selected' : '' }}>Earliest Deadline</option>
                    <option value="budget_low" {{ request('sort') === 'budget_low' ? 'selected' : '' }}>Budget: Low to High</option>
                    <option value="budget_high" {{ request('sort') === 'budget_high' ? 'selected' : '' }}>Budget: High to Low</option>
                </select>

                <button type="submit" class="sl-button-primary whitespace-nowrap px-4 py-2.5">
                    <span>Search</span>
                </button>
            </div>

            <!-- Status Quick Filters -->
            <div class="mt-3.5 flex flex-wrap items-center gap-2 border-t border-slate-100 pt-3 text-xs">
                <span class="font-semibold text-slate-500">Status:</span>
                @foreach(['open' => 'Open', 'in_progress' => 'In Progress', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $statusKey => $statusLabel)
                    <a href="{{ route('freelance.missions.index', array_merge(request()->query(), ['status' => $statusKey])) }}" 
                       class="rounded-full px-3 py-1 font-medium transition-colors {{ request('status', 'open') === $statusKey ? 'bg-blue-50 text-blue-700 border border-blue-200 font-semibold' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                        {{ $statusLabel }}
                    </a>
                @endforeach
            </div>
        </form>

        <!-- Mission Cards Grid -->
        <div class="mt-7 grid gap-5 lg:grid-cols-2">
            @forelse($missions as $mission)
                <article class="sl-panel p-6 flex flex-col justify-between transition-all hover:border-slate-300">
                    <div>
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <span class="inline-block rounded-md bg-slate-100 px-2 py-0.5 text-[11px] font-semibold text-slate-600">
                                    {{ $mission->category?->name ?? 'General Category' }}
                                </span>
                                <h3 class="mt-2 text-lg font-bold text-slate-900 leading-snug">
                                    <a href="{{ route('freelance.missions.show', $mission) }}" class="hover:text-blue-600">
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
                        <div class="grid grid-cols-3 gap-2 border-y border-slate-100 py-3 text-center text-xs">
                            <div>
                                <p class="text-slate-400 font-medium">Budget</p>
                                <p class="mt-0.5 font-bold text-slate-900">{{ number_format($mission->budget, 2) }} MAD</p>
                            </div>
                            <div>
                                <p class="text-slate-400 font-medium">Deadline</p>
                                <p class="mt-0.5 font-bold text-slate-900">{{ $mission->deadline }}</p>
                            </div>
                            <div>
                                <p class="text-slate-400 font-medium">Proposals</p>
                                <p class="mt-0.5 font-bold text-blue-600">{{ $mission->applications_count }}</p>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg bg-slate-900 text-xs font-bold text-white">
                                    {{ strtoupper(substr($mission->client->name ?? 'C', 0, 1)) }}
                                </span>
                                <span class="truncate text-xs font-semibold text-slate-700">
                                    {{ $mission->client->name ?? 'Client' }}
                                </span>
                            </div>

                            <a href="{{ route('freelance.missions.show', $mission) }}" class="sl-button-primary px-3.5 py-1.5 text-xs">
                                <span>View Mission</span>
                                <x-icon name="chevron-right" class="w-3.5 h-3.5" />
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="sl-panel col-span-full p-12 text-center">
                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                        <x-icon name="search" class="w-6 h-6" />
                    </div>
                    <h3 class="mt-4 text-base font-bold text-slate-900">No missions match your search criteria</h3>
                    <p class="mt-1 text-xs text-slate-500 max-w-sm mx-auto">
                        Try clearing your search query or broadening your category and budget filters.
                    </p>
                    <a href="{{ route('freelance.missions.index') }}" class="sl-button-secondary mt-5">
                        <span>Clear All Filters</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</x-workspace-shell>
