@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-gray-300 tracking-wide mb-1.5']) }}>
    {{ $value ?? $slot }}
</label>
