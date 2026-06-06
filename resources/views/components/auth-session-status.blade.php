@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-xl border border-[#c5d89d]/50 bg-[#c5d89d]/20 px-4 py-3 text-sm text-[#6b7854]']) }}>
        {{ $status }}
    </div>
@endif
