<section>
    <header class="border-b border-slate-100 pb-4 mb-6">
        <div class="flex items-center gap-2.5">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-50 text-indigo-600">
                <x-icon name="shield-check" class="w-4 h-4" />
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 leading-tight">
                    {{ __('Update Password') }}
                </h2>
                <p class="mt-0.5 text-xs text-slate-500">
                    {{ __('Ensure your account is using a strong, random password to stay secure.') }}
                </p>
            </div>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block w-full" autocomplete="current-password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="block w-full" autocomplete="new-password" placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->updatePassword->get('password')" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm New Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block w-full" autocomplete="new-password" placeholder="Repeat new password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>
                <x-icon name="check" class="w-4 h-4" />
                <span>{{ __('Update Password') }}</span>
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center gap-1.5 text-xs font-semibold text-emerald-700"
                >
                    <x-icon name="check-circle" class="w-4 h-4 text-emerald-600" />
                    <span>{{ __('Password updated successfully.') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>
