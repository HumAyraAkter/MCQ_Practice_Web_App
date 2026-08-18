<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center px-5 py-2.5 bg-transparent border border-white/10 rounded-xl font-semibold text-xs text-gray-300 uppercase tracking-widest shadow-sm hover:bg-white/5 hover:text-white focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-2 focus:ring-offset-[#121214] disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
