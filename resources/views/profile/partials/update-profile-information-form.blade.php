<section>
    <header class="border-b border-slate-100 pb-4 mb-6">
        <div class="flex items-center gap-2.5">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <x-icon name="user" class="w-4 h-4" />
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 leading-tight">
                    {{ __('Profile Information') }}
                </h2>
                <p class="mt-0.5 text-xs text-slate-500">
                    {{ __("Update your public account name and verified email address.") }}
                </p>
            </div>
        </div>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" name="email" type="email" class="block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 rounded-xl border border-amber-200 bg-amber-50 p-3 text-xs text-amber-800">
                    <p>
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="font-bold underline hover:text-amber-900 transition-colors">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-emerald-700">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>
                <x-icon name="check" class="w-4 h-4" />
                <span>{{ __('Save Changes') }}</span>
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 3000)"
                    class="flex items-center gap-1.5 text-xs font-semibold text-emerald-700"
                >
                    <x-icon name="check-circle" class="w-4 h-4 text-emerald-600" />
                    <span>{{ __('Saved successfully.') }}</span>
                </p>
            @endif
        </div>
    </form>
</section>
