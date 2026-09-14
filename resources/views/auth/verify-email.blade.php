<x-guest-layout>
    <div class="mb-6 text-center">
        <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
            <x-icon name="bell" class="w-6 h-6" />
        </div>
        <h1 class="text-2xl font-bold tracking-tight text-slate-900">Verify Your Email</h1>
        <p class="mt-2 text-xs leading-relaxed text-slate-500">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 flex items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50/80 p-3 text-xs font-medium text-emerald-800">
            <x-icon name="check-circle" class="w-4 h-4 text-emerald-600 shrink-0" />
            <span>{{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
        </div>
    @endif

    <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                <x-icon name="arrow-right" class="w-4 h-4" />
                <span>{{ __('Resend Verification Email') }}</span>
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-xs font-semibold text-slate-500 hover:text-slate-800 transition-colors">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
