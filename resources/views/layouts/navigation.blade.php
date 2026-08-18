<nav x-data="{ open: false }" class="bg-[#121214] border-b border-white/[0.05]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center gap-3">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg border border-[#E2B767]/40 flex items-center justify-center bg-gradient-to-br from-[#FFE5A3]/20 to-[#C39645]/10 shadow-[0_0_12px_rgba(226,183,103,0.15)]">
                            <svg class="w-4 h-4 text-[#E2B767]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                            </svg>
                        </div>
                        <span class="text-[#E2B767] font-serif font-bold text-lg tracking-wider">
                            CodeyHumayra
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-gray-400 hover:text-amber-400 focus:text-amber-400 border-b-2 transition duration-150 ease-in-out font-medium"
                        style="color: {{ request()->routeIs('dashboard') ? '#F59E0B' : '#9CA3AF' }}; border-color: {{ request()->routeIs('dashboard') ? '#F59E0B' : 'transparent' }};">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <x-nav-link :href="route('exams.index')" :active="request()->routeIs('exams.*')"
                        class="text-gray-400 hover:text-amber-400 focus:text-amber-400 border-b-2 transition duration-150 ease-in-out font-medium"
                        style="color: {{ request()->routeIs('exams.*') ? '#F59E0B' : '#9CA3AF' }}; border-color: {{ request()->routeIs('exams.*') ? '#F59E0B' : 'transparent' }};">
                        {{ __('Exams') }}
                    </x-nav-link>

                    <x-nav-link :href="route('results.index')" :active="request()->routeIs('results.*') || request()->routeIs('exams.result')"
                        class="text-gray-400 hover:text-amber-400 focus:text-amber-400 border-b-2 transition duration-150 ease-in-out font-medium"
                        style="color: {{ (request()->routeIs('results.*') || request()->routeIs('exams.result')) ? '#F59E0B' : '#9CA3AF' }}; border-color: {{ (request()->routeIs('results.*') || request()->routeIs('exams.result')) ? '#F59E0B' : 'transparent' }};">
                        {{ __('Results') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white/[0.05] text-sm leading-4 font-medium rounded-xl text-gray-300 bg-[#1A1A1E] hover:text-white hover:bg-white/[0.03] focus:outline-none transition ease-in-out duration-150 shadow-md cursor-pointer">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <div class="bg-[#1A1A1E] border border-white/[0.08] rounded-xl overflow-hidden shadow-2xl p-1">
                            <x-dropdown-link :href="route('profile.edit')" class="block w-full px-4 py-2 text-left text-sm text-gray-300 hover:bg-white/[0.04] hover:text-white rounded-lg transition-colors">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();"
                                        class="block w-full px-4 py-2 text-left text-sm text-gray-300 hover:bg-rose-500/10 hover:text-rose-400 rounded-lg transition-colors cursor-pointer">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-xl text-gray-400 hover:text-white hover:bg-white/[0.05] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#121214] border-t border-white/[0.05]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-300 hover:bg-white/[0.02]"
                style="color: {{ request()->routeIs('dashboard') ? '#F59E0B' : '#9CA3AF' }}; border-color: {{ request()->routeIs('dashboard') ? '#F59E0B' : 'transparent' }}; background-color: {{ request()->routeIs('dashboard') ? 'rgba(245,158,11,0.05)' : 'transparent' }};">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('exams.index')" :active="request()->routeIs('exams.*')"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-300 hover:bg-white/[0.02]"
                style="color: {{ request()->routeIs('exams.*') ? '#F59E0B' : '#9CA3AF' }}; border-color: {{ request()->routeIs('exams.*') ? '#F59E0B' : 'transparent' }}; background-color: {{ request()->routeIs('exams.*') ? 'rgba(245,158,11,0.05)' : 'transparent' }};">
                {{ __('Exams') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('results.index')" :active="request()->routeIs('results.*') || request()->routeIs('exams.result')"
                class="block pl-3 pr-4 py-2 border-l-4 text-base font-medium text-gray-300 hover:bg-white/[0.02]"
                style="color: {{ (request()->routeIs('results.*') || request()->routeIs('exams.result')) ? '#F59E0B' : '#9CA3AF' }}; border-color: {{ (request()->routeIs('results.*') || request()->routeIs('exams.result')) ? '#F59E0B' : 'transparent' }}; background-color: {{ (request()->routeIs('results.*') || request()->routeIs('exams.result')) ? 'rgba(245,158,11,0.05)' : 'transparent' }};">
                {{ __('Results') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white/[0.05]">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="block px-3 py-2 rounded-lg text-base font-medium text-gray-400 hover:text-white hover:bg-white/[0.02]">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="block w-full text-left px-3 py-2 rounded-lg text-base font-medium text-gray-400 hover:text-rose-400 hover:bg-rose-500/5 cursor-pointer">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>