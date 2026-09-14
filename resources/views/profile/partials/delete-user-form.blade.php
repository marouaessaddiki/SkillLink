<section class="space-y-6">
    <header class="border-b border-slate-100 pb-4">
        <div class="flex items-center gap-2.5">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-50 text-rose-600">
                <x-icon name="trash" class="w-4 h-4" />
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 leading-tight">
                    {{ __('Danger Zone &bull; Delete Account') }}
                </h2>
                <p class="mt-0.5 text-xs text-slate-500">
                    {{ __('Permanently delete your account and associated profile data.') }}
                </p>
            </div>
        </div>
    </header>

    <div class="rounded-xl border border-rose-100 bg-rose-50/50 p-4">
        <p class="text-xs leading-relaxed text-rose-900">
            {{ __('Once your account is deleted, all of its resources, active missions, and proposal history will be permanently deleted. Before deleting your account, please ensure you have settled all active commitments.') }}
        </p>

        <div class="mt-4">
            <x-danger-button
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            >
                <x-icon name="trash" class="w-4 h-4" />
                <span>{{ __('Delete Account') }}</span>
            </x-danger-button>
        </div>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 sm:p-7">
            @csrf
            @method('delete')

            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-100 text-rose-600 shrink-0">
                    <x-icon name="trash" class="w-5 h-5" />
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        {{ __('Confirm Account Deletion') }}
                    </h2>
                    <p class="text-xs text-slate-500">This action is permanent and cannot be undone.</p>
                </div>
            </div>

            <p class="mt-4 text-xs leading-relaxed text-slate-600">
                {{ __('Please enter your account password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-4">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full sm:w-3/4"
                    placeholder="{{ __('Enter your password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="mt-6 flex justify-end gap-3 pt-4 border-t border-slate-100">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Permanently Delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
