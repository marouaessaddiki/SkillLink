<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Create an Account</h1>
        <p class="mt-1.5 text-xs text-slate-500">Join Morocco's premier network of clients and vetted freelancers</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="e.g. Yassine El Amrani" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block w-full" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="yassine@example.com" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Role Selection -->
        <fieldset class="pt-1">
            <legend class="text-xs font-semibold uppercase tracking-wider text-slate-700 mb-2">Select Your Role</legend>
            <div class="grid gap-3 sm:grid-cols-2">
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="client" class="peer sr-only" {{ old('role', 'client') === 'client' ? 'checked' : '' }} required>
                    <span class="block rounded-xl border border-slate-200 bg-white p-3.5 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/50 peer-checked:ring-2 peer-checked:ring-blue-100 hover:border-slate-300">
                        <span class="flex items-center gap-2">
                            <x-icon name="building" class="w-4 h-4 text-slate-700" />
                            <span class="block text-xs font-bold text-slate-900">I am a Client</span>
                        </span>
                        <span class="mt-1 block text-[11px] leading-snug text-slate-500">Publish missions and hire vetted specialists.</span>
                    </span>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="freelance" class="peer sr-only" {{ old('role') === 'freelance' ? 'checked' : '' }}>
                    <span class="block rounded-xl border border-slate-200 bg-white p-3.5 transition-all peer-checked:border-blue-600 peer-checked:bg-blue-50/50 peer-checked:ring-2 peer-checked:ring-blue-100 hover:border-slate-300">
                        <span class="flex items-center gap-2">
                            <x-icon name="user" class="w-4 h-4 text-slate-700" />
                            <span class="block text-xs font-bold text-slate-900">I am a Freelancer</span>
                        </span>
                        <span class="mt-1 block text-[11px] leading-snug text-slate-500">Apply to briefs and build verified reviews.</span>
                    </span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" />
        </fieldset>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Repeat password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full py-3 text-sm">
                <span>{{ __('Create SkillLink Account') }}</span>
                <x-icon name="arrow-right" class="w-4 h-4" />
            </x-primary-button>
        </div>

        <div class="pt-4 text-center border-t border-slate-100">
            <p class="text-xs text-slate-500">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-blue-600 hover:text-blue-700 transition-colors">
                    Sign in instead
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
