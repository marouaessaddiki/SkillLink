@props([
    'status' => 'open',
    'size' => 'md',
])

@php
    $statusKey = strtolower(trim($status));
    
    $config = match($statusKey) {
        'open' => [
            'label' => 'Open',
            'classes' => 'bg-sky-50/80 text-sky-700 border-sky-200/80',
            'dot' => 'bg-sky-500',
        ],
        'in_progress' => [
            'label' => 'In Progress',
            'classes' => 'bg-amber-50/80 text-amber-800 border-amber-200/80',
            'dot' => 'bg-amber-500 animate-pulse',
        ],
        'completed' => [
            'label' => 'Completed',
            'classes' => 'bg-emerald-50/80 text-emerald-800 border-emerald-200/80',
            'dot' => 'bg-emerald-500',
        ],
        'cancelled' => [
            'label' => 'Cancelled',
            'classes' => 'bg-slate-100 text-slate-600 border-slate-200',
            'dot' => 'bg-slate-400',
        ],
        'accepted' => [
            'label' => 'Accepted',
            'classes' => 'bg-emerald-50/80 text-emerald-800 border-emerald-200/80',
            'dot' => 'bg-emerald-500',
        ],
        'pending' => [
            'label' => 'Pending',
            'classes' => 'bg-indigo-50/80 text-indigo-700 border-indigo-200/80',
            'dot' => 'bg-indigo-500',
        ],
        'rejected' => [
            'label' => 'Rejected',
            'classes' => 'bg-rose-50/80 text-rose-700 border-rose-200/80',
            'dot' => 'bg-rose-500',
        ],
        default => [
            'label' => str_replace('_', ' ', ucfirst($status)),
            'classes' => 'bg-slate-100 text-slate-700 border-slate-200',
            'dot' => 'bg-slate-400',
        ],
    };

    $sizeClasses = match($size) {
        'sm' => 'px-2 py-0.5 text-[11px] gap-1.5',
        'lg' => 'px-3.5 py-1.5 text-xs gap-2',
        default => 'px-2.5 py-1 text-xs gap-1.5',
    };
@endphp

<span class="inline-flex items-center rounded-full border font-medium tracking-tight {{ $sizeClasses }} {{ $config['classes'] }}">
    <span class="h-1.5 w-1.5 rounded-full {{ $config['dot'] }}"></span>
    <span>{{ $config['label'] }}</span>
</span>
