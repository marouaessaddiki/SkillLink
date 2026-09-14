<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Set New Password</h1>
        <p class="mt-1.5 text-xs text-slate-500">Please choose a strong password with at least 8 characters</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <x-text-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
            <x-text-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat new password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-sm">
                <span>{{ __('Reset Password & Sign In') }}</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
