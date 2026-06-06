<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-[#c5d89d] to-[#9cab84] hover:from-[#9cab84] hover:to-[#89986d] border border-transparent rounded-xl font-semibold text-[#2d2d2d] tracking-wide transition']) }}>
    {{ $slot }}
</button>
