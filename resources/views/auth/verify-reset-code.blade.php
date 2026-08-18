<x-guest-layout>
    <div class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl bg-[#121214] border border-white/[0.05] shadow-2xl rounded-2xl p-6 sm:p-10 backdrop-blur-sm transition-all duration-300 hover:border-amber-400/30">

        <div class="mb-6 text-center">
            <div class="w-12 h-12 bg-amber-400/5 border border-amber-400/20 text-amber-400 rounded-full flex items-center justify-center mx-auto mb-4 text-xl select-none">
                🔐
            </div>
            <h2 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
                Enter Reset Code
            </h2>
            <p class="text-xs sm:text-sm text-gray-400 mt-2">
                <span class="text-amber-400">{{ $email }}</span> ঠিকানায় একটি ৬-সংখ্যার কোড পাঠানো হয়েছে।
            </p>
        </div>

        <x-auth-session-status class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs sm:text-sm rounded-xl font-medium text-center shadow-inner" :status="session('status')" />

        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="group relative">
                <x-input-label for="code" :value="__('Reset Code')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="code" class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 text-center tracking-[0.6em] text-lg focus:border-amber-400 focus:ring focus:ring-amber-400/20 shadow-inner"
                               type="text" name="code" maxlength="6" inputmode="numeric" required autofocus />
                <x-input-error :messages="$errors->get('code')" class="mt-2 text-sm text-red-400" />
            </div>

            <div class="group relative">
                <x-input-label for="password" :value="__('New Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="password" class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 shadow-inner"
                               type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <div class="group relative">
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 shadow-inner"
                               type="password" name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-between pt-2 border-t border-white/[0.05] gap-4">
                <a class="text-sm text-gray-400 hover:text-amber-400 font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                    ← Resend Code
                </a>
                <button type="submit" class="w-full sm:w-auto flex justify-center items-center py-3 px-5 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                    Reset Password
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>