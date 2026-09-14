<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center gap-2 rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-subtle transition-all duration-150 hover:bg-rose-700 focus:outline-none focus:ring-4 focus:ring-rose-100 active:bg-rose-800 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
