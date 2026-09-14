<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Welcome Back</h1>
        <p class="mt-1.5 text-xs text-slate-500">Sign in to your SkillLink workspace and manage your missions</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@company.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1.5">
                <x-input-label for="password" :value="__('Password')" class="!mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-blue-600 hover:text-blue-700 transition-colors" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="pt-1">
            <label for="remember_me" class="inline-flex items-center gap-2 cursor-pointer select-none">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="text-xs font-medium text-slate-600">{{ __('Remember my session') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-sm">
                <x-icon name="logout" class="w-4 h-4 rotate-180" />
                <span>{{ __('Sign In to SkillLink') }}</span>
            </x-primary-button>
        </div>

        <div class="pt-4 text-center border-t border-slate-100">
            <p class="text-xs text-slate-500">
                New to the platform?
                <a href="{{ route('register') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                    Create an account
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
