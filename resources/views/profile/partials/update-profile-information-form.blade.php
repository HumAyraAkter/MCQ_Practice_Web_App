<section>
    <header>
        <h3 class="text-lg font-serif font-semibold text-white tracking-wide">
            {{ __('Profile Information') }}
        </h3>
        <p class="mt-1 text-sm text-gray-400 font-sans">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Name -->
        <div class="group relative">
            <x-input-label for="name" :value="__('Name')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
            <x-text-input id="name" name="name" type="text" class="block mt-1 w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-sm text-red-400" :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div class="group relative">
            <x-input-label for="email" :value="__('Email')" class="text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200" />
            <x-text-input id="email" name="email" type="email" class="block mt-1 w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-sm text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-200">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-amber-400 hover:text-amber-300 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Action Button -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="flex justify-center items-center py-2.5 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-emerald-400 font-medium">
                    {{ __('Saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
