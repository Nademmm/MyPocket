@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'w-full px-4 py-3 bg-[#faf8ed] border border-[#c5d89d]/50 text-[#2d2d2d] rounded-xl focus:outline-none focus:ring-2 focus:ring-[#c5d89d] focus:border-transparent transition']) }}>
