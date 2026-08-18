<x-guest-layout>
    <div class="w-full sm:max-w-md md:max-w-lg lg:max-w-xl bg-[#121214] border border-white/[0.05] shadow-2xl rounded-2xl p-6 sm:p-10 backdrop-blur-sm transition-all duration-300 hover:border-amber-400/30">
        <!-- Title Header -->
        <div class="mb-8 text-center">
            <h2 class="text-3xl sm:text-4xl font-serif font-bold text-white tracking-wide">
                Create Account
            </h2>
            <p class="text-xs sm:text-sm text-gray-400 mt-2 font-sans">
                Join us to master every subject, one question at a time.
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div class="group relative">
                <x-input-label for="name" :value="__('Name')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="name" 
                    class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200" 
                    type="text" 
                    name="name" 
                    :value="old('name')" 
                    required 
                    autofocus 
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Email Address -->
            <div class="group relative">
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="email" 
                    class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
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
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Confirm Password -->
            <div class="group relative">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
                <x-text-input id="password_confirmation" 
                    class="block mt-1 w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200"
                    type="password"
                    name="password_confirmation" 
                    required 
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-400" />
            </div>

            <!-- Already Registered & Submit Button -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2">
                <a class="text-sm text-gray-400 hover:text-amber-400 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 font-medium transition-colors duration-200 Order-2 sm:order-1" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button type="submit" class="w-full sm:w-auto min-w-[140px] flex justify-center items-center py-3 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_20px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer order-1 sm:order-2">
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
