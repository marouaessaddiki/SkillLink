<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-subtle transition-all duration-150 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-4 focus:ring-slate-100 disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
