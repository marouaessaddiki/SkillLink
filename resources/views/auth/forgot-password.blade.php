<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
            <x-icon name="shield-check" class="w-6 h-6" />
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Reset Password</h1>
        <p class="mt-1.5 text-xs text-slate-500">Enter your account email and we'll send you a password recovery link</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus placeholder="name@company.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-sm">
                <span>{{ __('Send Password Reset Link') }}</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </x-primary-button>
        </div>

        <div class="pt-4 text-center border-t border-slate-100">
            <a href="{{ route('login') }}" class="text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                &larr; Back to sign in
            </a>
        </div>
    </form>
</x-guest-layout>
