<x-app-layout>
    <div class="py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl border border-slate-200/90 bg-white p-8 shadow-subtle text-center">
                <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                    <x-icon name="check-circle" class="w-6 h-6" />
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">Welcome to SkillLink</h1>
                <p class="mt-2 text-sm text-slate-500">Your account is authenticated. Redirecting to your dedicated role workspace...</p>
                <div class="mt-6 flex justify-center gap-3">
                    <a href="{{ route('dashboard') }}" class="sl-button-primary">
                        <span>Go to Workspace</span>
                        <x-icon name="arrow-right" class="w-4 h-4" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
