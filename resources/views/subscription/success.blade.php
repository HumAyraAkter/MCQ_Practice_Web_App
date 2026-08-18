<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            Payment Status
        </h2>
    </x-slot>

    <div class="py-16 bg-[#0B0B0C] min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-[#121214] border border-emerald-500/20 shadow-[0_0_50px_rgba(16,185,129,0.05)] rounded-2xl p-8 sm:p-10 text-center transition-all duration-300 relative overflow-hidden group">
            
            <!-- Soft Emerald Glow Background Accent -->
            <div class="absolute -top-24 -left-24 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Animated Emoji Wrapper -->
            <div class="inline-block transform hover:scale-125 transition-transform duration-300 ease-out cursor-default select-none">
                <p class="text-6xl sm:text-7xl mb-6 animate-bounce" style="animation-duration: 2s;">
                    🎉
                </p>
            </div>

            <!-- Title with Gradient Accent -->
            <h1 class="text-2xl sm:text-3xl font-serif font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-teal-300 tracking-wide">
                Welcome to Premium!
            </h1>

            <!-- Success Message Text -->
            <p class="text-gray-300 text-sm sm:text-base mt-4 font-sans leading-relaxed">
                Your subscription has been activated successfully. Thank you for joining us!
            </p>

            <!-- Premium Features Badge Wrapper -->
            <div class="mt-6 p-4 bg-white/[0.02] border border-white/[0.04] rounded-xl flex items-center justify-center gap-2 max-w-[240px] mx-auto">
                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-semibold text-gray-400 tracking-wider uppercase">All Features Unlocked</span>
            </div>

            <!-- Navigation Action Button -->
            <div class="mt-8 pt-2">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto inline-flex justify-center items-center py-3.5 px-8 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_20px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                    Go to Dashboard
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
