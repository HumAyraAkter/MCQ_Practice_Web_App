<section class="space-y-6">
    <header>
        <h3 class="text-lg font-serif font-semibold text-white tracking-wide">
            {{ __('Delete Account') }}
        </h3>
        <p class="mt-1 text-sm text-gray-400 font-sans">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-5 py-2.5 rounded-xl font-semibold bg-rose-600 hover:bg-rose-500 shadow-[0_4px_15px_rgba(244,63,94,0.2)] transition-all duration-200 transform hover:-translate-y-0.5"
    >{{ __('Delete Account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 bg-[#121214] border border-white/[0.05] rounded-2xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-serif font-medium text-white">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400 font-sans">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6 group relative">
                <x-input-label for="password" :value="__('Password')" class="sr-only" />
                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block mt-1 w-3/4"
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-400" />
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')" class="px-5 py-2.5 rounded-xl bg-transparent border border-white/10 text-gray-300 hover:bg-white/5 transition-all">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="px-5 py-2.5 rounded-xl bg-rose-600 hover:bg-rose-500 transition-all">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
