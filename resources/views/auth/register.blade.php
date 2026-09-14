<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <fieldset class="mt-6">
            <legend class="text-sm font-semibold text-[var(--ink)]">Choose your path</legend>
            <div class="mt-3 grid gap-3 sm:grid-cols-2">
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="client" class="peer sr-only" {{ old('role') === 'client' ? 'checked' : '' }} required>
                    <span class="block rounded-2xl border border-[var(--line)] p-4 transition peer-checked:border-[var(--blue)] peer-checked:bg-blue-50 peer-focus:ring-2 peer-focus:ring-blue-200">
                        <span class="block text-sm font-bold text-[var(--ink)]">I need a freelancer</span>
                        <span class="mt-1 block text-xs leading-5 text-[var(--muted)]">Publish a mission and bring your idea to life.</span>
                    </span>
                </label>
                <label class="relative cursor-pointer">
                    <input type="radio" name="role" value="freelance" class="peer sr-only" {{ old('role') === 'freelance' ? 'checked' : '' }}>
                    <span class="block rounded-2xl border border-[var(--line)] p-4 transition peer-checked:border-[var(--violet)] peer-checked:bg-violet-50 peer-focus:ring-2 peer-focus:ring-violet-200">
                        <span class="block text-sm font-bold text-[var(--ink)]">I offer my skills</span>
                        <span class="mt-1 block text-xs leading-5 text-[var(--muted)]">Discover missions that match your strengths.</span>
                    </span>
                </label>
            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </fieldset>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
