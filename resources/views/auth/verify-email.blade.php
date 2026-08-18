<x-guest-layout>
    <div class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl bg-[#121214] border border-white/[0.05] shadow-2xl rounded-2xl p-6 sm:p-10 backdrop-blur-sm transition-all duration-300 hover:border-amber-400/30">
        
        <!-- Title Header -->
        <div class="mb-6 text-center">
            <div class="w-12 h-12 bg-amber-400/5 border border-amber-400/20 text-amber-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl select-none">
                ✉️
            </div>
            <h2 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
                Verify Your Email
            </h2>
        </div>

        <!-- Main Notice Text -->
        <div class="mb-6 text-xs sm:text-sm text-gray-300 text-center font-sans leading-relaxed">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>

        <!-- Success Flash Message -->
        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs sm:text-sm rounded-xl font-medium text-center animate-fade-in">
                🎉 {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <!-- Action Section -->
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 border-t border-white/[0.05]">
            <!-- Resend Form -->
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto order-1 sm:order-1">
                @csrf
                <button type="submit" class="w-full sm:w-auto flex justify-center items-center py-3 px-5 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto text-center order-2 sm:order-2">
                @csrf
                <button type="submit" class="text-sm text-gray-400 hover:text-rose-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 font-medium transition-colors duration-200 cursor-pointer py-2 px-4 block w-full sm:w-auto">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
