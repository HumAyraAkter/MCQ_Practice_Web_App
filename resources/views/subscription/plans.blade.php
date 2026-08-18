<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            Subscription Plans
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Session Flash Errors -->
            @if (session('error'))
                <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-xl font-medium animate-fade-in">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <!-- Active Status Badge -->
            @if (Auth::user()->isPremium())
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 p-4 rounded-xl mb-8 text-center font-medium shadow-md">
                    You already have an active Premium subscription! 🎉
                </div>
            @endif

            <!-- Pricing Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                @foreach ($plans as $key => $plan)
                    <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-8 text-center relative overflow-hidden transition-all duration-300 hover:border-amber-400/40 hover:-translate-y-1 shadow-2xl flex flex-col justify-between group">
                        
                        <!-- Premium Glow Ribbon (Optional visual indicator) -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-amber-400/10 to-transparent pointer-events-none"></div>

                        <div>
                            <!-- Plan Title -->
                            <h3 class="text-xl font-serif font-bold text-white group-hover:text-amber-400 transition-colors">
                                {{ $plan['label'] }}
                            </h3>
                            
                            <!-- Pricing Dynamic Block -->
                            <div class="mt-4">
                                <span class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645]">
                                    ৳{{ $plan['price'] }}
                                </span>
                                <p class="text-gray-400 text-xs mt-2 font-medium bg-white/5 inline-block px-3 py-1 rounded-full border border-white/[0.05]">
                                    Active for {{ $plan['days'] }} days
                                </p>
                            </div>

                            <!-- Feature list -->
                            <ul class="text-sm text-gray-300 mt-8 space-y-3.5 text-left border-t border-white/[0.05] pt-6">
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Access to all Premium exams</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Detailed explanations</span>
                                </li>
                                <li class="flex items-center gap-3">
                                    <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span>Unlimited attempts</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Checkout Form and Premium Button -->
                        <form action="{{ route('subscription.checkout') }}" method="POST" class="mt-8">
                            @csrf
                            <input type="hidden" name="plan" value="{{ $key }}">
                            <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_20px_rgba(226,183,103,0.12)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.25)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                                Subscribe Now
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
