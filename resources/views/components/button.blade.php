@props(['type' => 'primary'])
@php
    $class = $type === 'primary'
        ? 'bg-blue-600 hover:bg-blue-700 text-white'
        : 'bg-gray-600 hover:bg-gray-700 text-white';
@endphp
<button {{ $attributes->merge(['class' => "$class px-4 py-2 rounded font-semibold transition"]) }}>
    {{ $slot }}
</button>
