<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - MCQ App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0B0B0C] text-gray-200 antialiased font-sans select-none">
    <div class="flex min-h-screen">
        
        <!-- Premium Sidebar Wrapper -->
        <aside class="w-64 bg-[#121214] border-r border-white/[0.05] text-gray-300 flex-shrink-0 flex flex-col justify-between">
            <div>
                <!-- Sidebar Header with Logo Brand (Matching user nav style) -->
                <div class="p-5 border-b border-white/[0.05] flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg border border-[#E2B767]/40 flex items-center justify-center bg-gradient-to-br from-[#FFE5A3]/20 to-[#C39645]/10 shadow-[0_0_12px_rgba(226,183,103,0.15)]">
                        <svg class="w-4 h-4 text-[#E2B767]" xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75M10.5 18a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 18H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 12H13.5" />
                        </svg>
                    </div>
                    <span class="text-[#E2B767] font-serif font-bold text-base tracking-wider uppercase">
                        MCQ Admin
                    </span>
                </div>

                <!-- Navigation Sidebar Links -->
                <nav class="p-4 space-y-1.5">
                    <!-- Dashboard Link -->
                    <a href="{{ route('admin.dashboard') }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 
                       {{ request()->routeIs('admin.dashboard') 
                           ? 'bg-gradient-to-r from-[#FFE5A3]/10 to-[#C39645]/5 border border-amber-400/20 text-amber-400 font-semibold shadow-[0_0_15px_rgba(226,183,103,0.02)]' 
                           : 'hover:text-white hover:bg-white/[0.03] border border-transparent' }}">
                        Dashboard
                    </a>

                    <!-- Categories Link -->
                    <a href="{{ route('admin.categories.index') }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 
                       {{ request()->routeIs('admin.categories.*') 
                           ? 'bg-gradient-to-r from-[#FFE5A3]/10 to-[#C39645]/5 border border-amber-400/20 text-amber-400 font-semibold shadow-[0_0_15px_rgba(226,183,103,0.02)]' 
                           : 'hover:text-white hover:bg-white/[0.03] border border-transparent' }}">
                        Categories
                    </a>

                    <!-- Questions Link -->
                    <a href="{{ route('admin.questions.index') }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 
                       {{ request()->routeIs('admin.questions.*') 
                           ? 'bg-gradient-to-r from-[#FFE5A3]/10 to-[#C39645]/5 border border-amber-400/20 text-amber-400 font-semibold shadow-[0_0_15px_rgba(226,183,103,0.02)]' 
                           : 'hover:text-white hover:bg-white/[0.03] border border-transparent' }}">
                        Questions
                    </a>
<a href="{{ route('admin.questions.bulkCreate') }}"
   class="block px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 
   {{ request()->routeIs('admin.questions.bulkCreate') 
       ? 'bg-gradient-to-r from-[#FFE5A3]/10 to-[#C39645]/5 border border-amber-400/20 text-amber-400 font-semibold' 
       : 'hover:text-white hover:bg-white/[0.03] border border-transparent' }}">
    ➕ Bulk Add Questions
</a>
                    <!-- Exams Link -->
                    <a href="{{ route('admin.exams.index') }}"
                       class="block px-4 py-2.5 rounded-xl text-sm font-medium transition-all duration-200 
                       {{ request()->routeIs('admin.exams.*') 
                           ? 'bg-gradient-to-r from-[#FFE5A3]/10 to-[#C39645]/5 border border-amber-400/20 text-amber-400 font-semibold shadow-[0_0_15px_rgba(226,183,103,0.02)]' 
                           : 'hover:text-white hover:bg-white/[0.03] border border-transparent' }}">
                        Exams
                    </a>
                </nav>
            </div>

            <!-- Bottom Sidebar Area (Logout Section) -->
            <div class="p-4 border-t border-white/[0.05]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2.5 rounded-xl text-sm font-medium text-gray-400 hover:text-rose-400 hover:bg-rose-500/5 transition-all cursor-pointer">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Dynamic Main Content Wrapper -->
        <main class="flex-1 p-6 sm:p-10 overflow-y-auto">
            <!-- Flash Session Success Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-sm rounded-xl font-medium animate-fade-in flex items-center gap-2 shadow-md">
                    ✨ {{ session('success') }}
                </div>
            @endif

            <!-- Inject Sub Views -->
            @yield('content')
        </main>

    </div>
</body>
</html>
