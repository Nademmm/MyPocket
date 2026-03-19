@props(['show' => false, 'maxWidth' => '2xl'])
<div x-data="{ show: @js($show) }" x-show="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-all" style="display: none;">
    <div @click.away="show = false" class="bg-secondary rounded-2xl shadow-glass p-6 w-full max-w-{{ $maxWidth }} mx-auto animate-fade-in">
        {{ $slot }}
    </div>
</div>
