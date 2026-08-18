@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-amber-400 text-start text-base font-semibold text-amber-400 bg-amber-400/5 focus:outline-none focus:text-amber-400 focus:bg-amber-400/10 focus:border-amber-400 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2.5 border-l-4 border-transparent text-start text-base font-medium text-gray-400 hover:text-white hover:bg-white/[0.02] hover:border-white/10 focus:outline-none focus:text-white focus:bg-white/[0.02] focus:border-white/10 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
