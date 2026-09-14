<x-admin-shell title="Skill Categories">
    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Taxonomy &amp; Organization</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Mission Categories</h2>
            <p class="mt-1 text-sm text-slate-500">Organize skills, domains, and missions across SkillLink.</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="sl-button-primary">
            <x-icon name="plus" class="w-4 h-4" />
            <span>Add Category</span>
        </a>
    </div>

    @if(session('success'))
        <div class="mt-6 flex items-center gap-3 rounded-xl border border-emerald-200 bg-emerald-50/80 px-4 py-3 text-sm font-medium text-emerald-800">
            <x-icon name="check-circle" class="w-5 h-5 text-emerald-600 shrink-0" />
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <section class="mt-7 grid gap-3 sm:grid-cols-3">
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Categories</p>
            <p class="mt-2 text-2xl font-bold text-slate-900">{{ $stats['total'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Active Disciplines</p>
            <p class="mt-2 text-2xl font-bold text-emerald-600">{{ $stats['active'] }}</p>
        </div>
        <div class="rounded-2xl border border-slate-200/90 bg-white p-5 shadow-subtle">
            <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Missions Classified</p>
            <p class="mt-2 text-2xl font-bold text-blue-600">{{ $stats['missions'] }}</p>
        </div>
    </section>

    <div class="mt-7 grid gap-5 sm:grid-cols-2 xl:grid-cols-3">
        @forelse($categories as $category)
            <article class="rounded-2xl border border-slate-200/90 bg-white p-6 shadow-subtle transition-all hover:border-slate-300 hover:shadow-elevated flex flex-col justify-between">
                <div>
                    <div class="flex items-start justify-between">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <x-icon name="layers" class="w-5 h-5" />
                        </span>
                        <span class="rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold uppercase text-emerald-700 border border-emerald-200">
                            Active
                        </span>
                    </div>
                    <h3 class="mt-4 text-lg font-bold text-slate-900">{{ $category->name }}</h3>
                    <p class="mt-1.5 min-h-10 text-xs leading-relaxed text-slate-500">
                        {{ $category->description ?: 'A growing domain for missions and professional freelance talent.' }}
                    </p>
                </div>

                <div class="mt-6">
                    <div class="flex gap-6 border-t border-slate-100 pt-3 text-xs">
                        <div>
                            <p class="text-lg font-bold text-slate-900">{{ $category->missions_count }}</p>
                            <p class="text-[10px] uppercase font-semibold text-slate-400">Total Missions</p>
                        </div>
                        <div>
                            <p class="text-lg font-bold text-blue-600">{{ $category->active_missions_count }}</p>
                            <p class="text-[10px] uppercase font-semibold text-slate-400">In Delivery</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="inline-flex items-center gap-1 text-xs font-semibold text-blue-600 hover:text-blue-700">
                            <x-icon name="pencil" class="w-3.5 h-3.5" />
                            <span>Edit</span>
                        </a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1 text-xs font-semibold text-rose-600 hover:text-rose-700">
                                <x-icon name="trash" class="w-3.5 h-3.5" />
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-14 text-center">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <x-icon name="layers" class="w-6 h-6" />
                </div>
                <h3 class="mt-4 font-bold text-slate-900">No categories created yet</h3>
                <p class="mt-1 text-xs text-slate-400">Create categories to classify client missions and facilitate search.</p>
                <a href="{{ route('admin.categories.create') }}" class="sl-button-primary mt-5">
                    <x-icon name="plus" class="w-4 h-4" />
                    <span>Create Category</span>
                </a>
            </div>
        @endforelse
    </div>
</x-admin-shell>
