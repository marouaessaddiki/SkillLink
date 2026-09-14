<x-admin-shell title="Create Category">
    <div class="mx-auto max-w-2xl">
        <!-- Header -->
        <div class="mb-7">
            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-blue-600 transition-colors mb-2">
                <x-icon name="arrow-left" class="w-3.5 h-3.5" />
                <span>Back to Categories</span>
            </a>
            <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Create Skill Category</h2>
            <p class="mt-1 text-sm text-slate-500">Add a new discipline to organize platform missions and freelancer expertise.</p>
        </div>

        <div class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle sm:p-8">
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Category Name')" />
                    <x-text-input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        class="w-full"
                        placeholder="e.g. Mobile Application Development"
                    />
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full rounded-xl border-slate-200 bg-white text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors shadow-subtle leading-relaxed"
                        placeholder="Brief summary of skills and typical missions covered by this category..."
                    >{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" />
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <a
                        href="{{ route('admin.categories.index') }}"
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
                        <span>Create Category</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-shell>