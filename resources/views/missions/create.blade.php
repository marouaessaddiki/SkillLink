<x-workspace-shell role="client" title="Create New Mission" eyebrow="Client Workspace">
    <div class="mx-auto max-w-3xl">
        <!-- Page Header -->
        <div class="mb-8 flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
            <div>
                <a href="{{ route('missions.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors mb-2">
                    <x-icon name="arrow-left" class="w-3.5 h-3.5" />
                    <span>Back to My Missions</span>
                </a>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Publish a New Mission</h2>
                <p class="mt-1 text-sm text-slate-500">Provide clear project requirements to attract qualified proposals from verified freelancers.</p>
            </div>
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

        <form method="POST" action="{{ route('missions.store') }}" class="space-y-6">
            @csrf

            <!-- Section 1: Core Details -->
            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle sm:p-7">
                <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100 mb-5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <x-icon name="document-text" class="w-4 h-4" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-tight">Project Identification</h3>
                        <p class="text-xs text-slate-400">Title and industry categorization</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="title" :value="__('Mission Title')" />
                        <x-text-input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            required
                            class="w-full"
                            placeholder="e.g. Build a Responsive Client Portal with Laravel and MySQL"
                        />
                        <x-input-error :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="category_id" :value="__('Discipline / Category')" />
                        <select
                            id="category_id"
                            name="category_id"
                            required
                            class="w-full rounded-xl border-slate-200 bg-white text-sm text-slate-900 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors shadow-subtle"
                        >
                            <option value="">Select the primary skill discipline...</option>
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}
                                >
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" />
                    </div>
                </div>
            </div>

            <!-- Section 2: Detailed Brief -->
            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle sm:p-7">
                <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100 mb-5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                        <x-icon name="pencil" class="w-4 h-4" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-tight">Scope &amp; Deliverables</h3>
                        <p class="text-xs text-slate-400">Detailed objectives, constraints and requirements</p>
                    </div>
                </div>

                <div>
                    <x-input-label for="description" :value="__('Detailed Description')" />
                    <textarea
                        id="description"
                        name="description"
                        rows="7"
                        required
                        class="w-full rounded-xl border-slate-200 bg-white text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors shadow-subtle leading-relaxed"
                        placeholder="Outline the project goals, tech stack expectations, key milestones, and acceptance criteria..."
                    >{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" />
                </div>
            </div>

            <!-- Section 3: Commercials & Timeline -->
            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle sm:p-7">
                <div class="flex items-center gap-2.5 pb-4 border-b border-slate-100 mb-5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
                        <x-icon name="cash" class="w-4 h-4" />
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-slate-900 leading-tight">Commercial Terms</h3>
                        <p class="text-xs text-slate-400">Project budget and completion deadline</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <x-input-label for="budget" :value="__('Estimated Budget (MAD)')" />
                        <div class="relative">
                            <x-text-input
                                type="number"
                                step="0.01"
                                id="budget"
                                name="budget"
                                value="{{ old('budget') }}"
                                required
                                min="0"
                                class="w-full pr-14"
                                placeholder="5000.00"
                            />
                            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-xs font-bold text-slate-400">
                                MAD
                            </span>
                        </div>
                        <x-input-error :messages="$errors->get('budget')" />
                    </div>

                    <div>
                        <x-input-label for="deadline" :value="__('Target Completion Deadline')" />
                        <x-text-input
                            type="date"
                            id="deadline"
                            name="deadline"
                            value="{{ old('deadline') }}"
                            required
                            class="w-full"
                        />
                        <x-input-error :messages="$errors->get('deadline')" />
                    </div>
                </div>
            </div>

            <!-- Submission Bar -->
            <div class="flex items-center justify-between pt-2">
                <a
                    href="{{ route('missions.index') }}"
                    class="sl-button-secondary"
                >
                    <x-icon name="arrow-left" class="w-4 h-4" />
                    <span>Cancel</span>
                </a>

                <button
                    type="submit"
                    class="sl-button-primary px-6"
                >
                    <x-icon name="plus" class="w-4 h-4" />
                    <span>Publish Mission</span>
                </button>
            </div>
        </form>
    </div>
</x-workspace-shell>