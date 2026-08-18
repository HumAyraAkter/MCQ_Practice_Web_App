<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 bg-rose-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-rose-500 active:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-[#121214] shadow-[0_4px_15px_rgba(244,63,94,0.2)] transition-all duration-150 transform hover:-translate-y-0.5 active:translate-y-0 cursor-pointer']) }}>
    {{ $slot }}
</button>
