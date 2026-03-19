@props(['value' => 0, 'max' => 100])
@php $percent = $max > 0 ? ($value / $max) * 100 : 0; @endphp
<div class="w-full bg-gray-700 rounded-full h-3 mb-2">
    <div class="bg-green-500 h-3 rounded-full" style="width: {{ $percent }}%"></div>
</div>
<div class="text-xs text-gray-400">{{ number_format($value, 0, ',', '.') }} / {{ number_format($max, 0, ',', '.') }}</div>
