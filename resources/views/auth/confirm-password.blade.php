<x-guest-layout>
    <div class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl bg-[#121214] border border-white/[0.05] shadow-2xl rounded-2xl p-6 sm:p-10 backdrop-blur-sm transition-all duration-300 hover:border-amber-400/30">
        
        <!-- Title & Icon Header -->
        <div class="mb-6 text-center">
            <div class="w-12 h-12 bg-rose-500/5 border border-rose-500/20 text-rose-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl select-none animate-pulse">
                🔒
            </div>
            <h2 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
                Confirm Password
            </h2>
        </div>

        <!-- Warning Context Text -->
        <div class="mb-6 text-xs sm:text-sm text-gray-400 text-center font-sans leading-relaxed bg-white/[0.01] border border-white/[0.03] p-4 rounded-xl">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Form Master Block -->
        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <!-- Password Input -->
            <div class="group relative">
                <x-input-label for="password" :value="__('Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />

                <x-text-input id="password" class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Submit Actions -->
            <div class="flex justify-end pt-2 border-t border-white/[0.05]">
                <button type="submit" class="w-full sm:w-auto flex justify-center items-center py-3 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
