<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-amber-600">
            <x-icon name="shield-check" class="w-6 h-6" />
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Confirm Security</h1>
        <p class="mt-2 text-xs leading-relaxed text-slate-500">
            {{ __('This is a secure area of the platform. Please confirm your password before continuing.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Current Password')" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-sm">
                <span>{{ __('Confirm Password') }}</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
