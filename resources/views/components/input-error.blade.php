@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-xs font-medium text-rose-600 space-y-1 mt-1.5']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1.5">
                <span class="h-1 w-1 rounded-full bg-rose-500 shrink-0"></span>
                <span>{{ $message }}</span>
            </li>
        @endforeach
    </ul>
@endif
