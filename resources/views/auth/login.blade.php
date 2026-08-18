<x-guest-layout>
    <div class="w-full sm:max-w-md bg-[#121214] border border-white/[0.05] shadow-2xl rounded-2xl p-6 sm:p-8 backdrop-blur-sm transition-all duration-300 hover:border-amber-400/30">
        
        <!-- Logo / Title Header -->
        <div class="mb-8 text-center">
            <h2 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
                Welcome Back
            </h2>
            <p class="text-xs sm:text-sm text-gray-400 mt-2 font-sans">
                Continue your journey to master every subject.
            </p>
        </div>
        
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="group relative">
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="email" 
                    class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Password -->
            <div class="group relative">
                <x-input-label for="password" :value="__('Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="password" 
                    class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between text-xs sm:text-sm">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" class="rounded bg-[#1A1A1E] border-white/[0.1] text-amber-500 shadow-sm focus:ring-amber-400/30 focus:ring-offset-[#121214]" name="remember">
                    <span class="ms-2 text-gray-400 group-hover:text-gray-200 transition-colors duration-200">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-gray-400 hover:text-amber-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 font-medium transition-colors duration-200" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <!-- Action Button -->
            <div class="pt-2">
                <button type="submit" class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_20px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                    {{ __('Log in') }}
                </button>
            </div>

            <!-- Optional Register Redirection footer link -->
            @if (Route::has('register'))
                <div class="text-center pt-2 border-t border-white/[0.05]">
                    <p class="text-xs text-gray-500">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-amber-400/90 hover:text-amber-400 font-medium transition-colors ml-1">
                            Sign Up
                        </a>
                    </p>
                </div>
            @endif
        </form>
    </div>
</x-guest-layout>
