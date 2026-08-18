<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            
            <!-- Update Profile Information Card -->
            <div class="p-6 sm:p-10 bg-[#121214] border border-white/[0.05] shadow-xl rounded-2xl transition-all duration-300 hover:border-white/10 shadow-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="p-6 sm:p-10 bg-[#121214] border border-white/[0.05] shadow-xl rounded-2xl transition-all duration-300 hover:border-white/10 shadow-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete User Card -->
            <div class="p-6 sm:p-10 bg-[#121214] border border-white/[0.05] shadow-xl rounded-2xl transition-all duration-300 hover:border-rose-500/10 shadow-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
