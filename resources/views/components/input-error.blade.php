@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'text-xs sm:text-sm text-rose-400 space-y-1 font-medium mt-1 flex flex-col gap-0.5']) }}>
        @foreach ((array) $messages as $message)
            <li class="flex items-center gap-1">⚠️ {{ $message }}</li>
        @endforeach
    </ul>
@endif
