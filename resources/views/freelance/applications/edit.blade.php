<x-workspace-shell role="freelance" title="Edit Proposal" eyebrow="Freelancer Workspace">
    <div class="mx-auto max-w-3xl">
        <!-- Header -->
        <div class="mb-8">
            <a href="{{ route('freelance.applications.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors mb-2">
                <x-icon name="arrow-left" class="w-3.5 h-3.5" />
                <span>Back to My Applications</span>
            </a>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Edit Your Proposal</h2>
            <p class="mt-1 text-sm text-slate-500">Update your offer terms or pitch for mission: <span class="font-semibold text-slate-800">{{ $application->mission->title }}</span></p>
        </div>

        @if($errors->any())
            <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50/80 p-4 text-rose-900">
                <div class="flex items-center gap-2 text-sm font-bold">
                    <x-icon name="x-mark" class="w-4 h-4 text-rose-600 shrink-0" />
                    <span>Please correct the errors below:</span>
                </div>
                <ul class="mt-2 list-disc list-inside space-y-1 text-xs font-medium text-rose-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle sm:p-8">
            <!-- Mission Brief Banner -->
            <div class="rounded-xl border border-slate-100 bg-slate-50 p-4 mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-blue-600">Client Mission</span>
                    <h3 class="text-sm font-bold text-slate-900 mt-0.5">{{ $application->mission->title }}</h3>
                    <p class="text-xs text-slate-500 mt-0.5">Category: {{ $application->mission->category->name ?? 'General' }}</p>
                </div>
                <div class="text-left sm:text-right">
                    <span class="text-[10px] font-semibold uppercase text-slate-400">Client Budget</span>
                    <p class="text-sm font-bold text-slate-900">{{ number_format($application->mission->budget, 2) }} MAD</p>
                </div>
            </div>

            <form method="POST" action="{{ route('freelance.applications.update', $application) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="proposed_price" :value="__('Your Proposed Rate (MAD)')" />
                    <div class="relative">
                        <x-text-input
                            id="proposed_price"
                            name="proposed_price"
                            type="number"
                            min="0"
                            step="0.01"
                            required
                            value="{{ old('proposed_price', $application->proposed_price) }}"
                            class="w-full pr-14"
                        />
                        <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-xs font-bold text-slate-400">
                            MAD
                        </span>
                    </div>
                    <p class="mt-1.5 text-xs text-slate-400">Competitive pricing aligned with scope increases your chance of selection.</p>
                    <x-input-error :messages="$errors->get('proposed_price')" />
                </div>

                <div>
                    <x-input-label for="cover_letter" :value="__('Cover Letter & Pitch')" />
                    <textarea
                        id="cover_letter"
                        name="cover_letter"
                        rows="7"
                        required
                        class="w-full rounded-xl border-slate-200 bg-white text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors shadow-subtle leading-relaxed"
                    >{{ old('cover_letter', $application->cover_letter) }}</textarea>
                    <p class="mt-1.5 text-xs text-slate-400">Explain your approach, tech stack, and relevant experience.</p>
                    <x-input-error :messages="$errors->get('cover_letter')" />
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <a href="{{ route('freelance.applications.index') }}" class="sl-button-secondary">
                        <x-icon name="arrow-left" class="w-4 h-4" />
                        <span>Cancel</span>
                    </a>
                    <button type="submit" class="sl-button-primary px-6">
                        <x-icon name="check" class="w-4 h-4" />
                        <span>Update Proposal</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-workspace-shell>
