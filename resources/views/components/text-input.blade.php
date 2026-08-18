@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner placeholder-gray-600']) !!} style="
    /* ক্রোমের কুৎসিত অটোফিল সাদা/নীল ব্যাকগ্রাউন্ড দূর করার ম্যাজিক সিএসএস */
    -webkit-box-shadow: 0 0 0px 1000px #1A1A1E inset !important;
    -webkit-text-fill-color: #F3F4F6 !important;
    caret-color: #F59E0B;
">
