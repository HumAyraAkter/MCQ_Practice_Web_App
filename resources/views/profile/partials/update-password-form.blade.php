<section>
    <header>
        <h3 class="text-lg font-serif font-semibold text-white tracking-wide">
            {{ __('Update Password') }}
        </h3>
        <p class="mt-1 text-sm text-gray-400 font-sans">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="group relative">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="block mt-1 w-full" autocomplete="current-password" />
            <x-input-error class="mt-2 text-sm text-red-400" :messages="$errors->get('current_password')" />
        </div>

        <!-- New Password -->
        <div class="group relative">
            <x-input-label for="update_password_password" :value="__('New Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
            <x-text-input id="update_password_password" name="password" type="password" class="block mt-1 w-full" autocomplete="new-password" />
            <x-input-error class="mt-2 text-sm text-red-400" :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="group relative">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="block mt-1 w-full" autocomplete="new-password" />
            <x-input-error class="mt-2 text-sm text-red-400" :messages="$errors->get('password_confirmation')" />
        </div>

        <!-- Action Button -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="flex justify-center items-center py-2.5 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400 font-medium">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
