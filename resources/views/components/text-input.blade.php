@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-xl border-slate-200 bg-white text-sm text-slate-900 placeholder:text-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-100 transition-colors shadow-subtle disabled:bg-slate-50 disabled:text-slate-400']) }}>
