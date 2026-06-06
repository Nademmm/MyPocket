@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-[#6b7854]']) }}>
    {{ $value ?? $slot }}
</label>
