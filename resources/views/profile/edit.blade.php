@php
    $isAdmin = auth()->user()->hasRole('admin');
    $userRole = auth()->user()->hasRole('freelance') ? 'freelance' : 'client';
@endphp

@if($isAdmin)
    <x-admin-shell title="Account Settings">
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="mb-6">
                <p class="text-xs font-bold uppercase tracking-widest text-blue-600">Preferences</p>
                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Administrator Profile</h2>
                <p class="mt-1 text-sm text-slate-500">Manage your administrative credentials and security settings.</p>
            </div>

            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-subtle">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-subtle">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-subtle">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-admin-shell>
@else
    <x-workspace-shell :role="$userRole" title="Account Settings" eyebrow="Profile">
        <div class="mx-auto max-w-4xl space-y-6">
            <div class="mb-6">
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Account Settings</h2>
                <p class="mt-1 text-sm text-slate-500">Manage your profile details, login security, and account preferences.</p>
            </div>

            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-subtle">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-subtle">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200/90 bg-white p-6 sm:p-8 shadow-subtle">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </x-workspace-shell>
@endif
