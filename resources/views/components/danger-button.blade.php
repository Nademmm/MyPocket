<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-[#d9a3a3] to-[#c17b7b] hover:from-[#c17b7b] hover:to-[#a85a5a] border border-transparent rounded-xl font-semibold text-white tracking-wide transition']) }}>
    {{ $slot }}
</button>
