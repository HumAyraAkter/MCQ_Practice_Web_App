<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            Available Exams
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Flash Error Notification -->
            @if (session('error'))
                <div class="mb-6 p-4 bg-rose-500/10 border border-rose-500/20 text-rose-400 text-sm rounded-xl font-medium animate-fade-in">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <!-- Exams Responsive Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($exams as $exam)
                    <div class="bg-[#121214] border {{ $exam->is_premium ? 'border-amber-400/20 shadow-[0_0_20px_rgba(226,183,103,0.03)]' : 'border-white/[0.05]' }} rounded-2xl p-6 relative flex flex-col justify-between transition-all duration-300 hover:border-amber-400/40 hover:-translate-y-1.5 shadow-xl group overflow-hidden">
                        
                        <!-- Top Badges Section -->
                        <div class="flex justify-between items-start gap-4 mb-3">
                            <span class="text-xs font-semibold text-amber-400/80 bg-amber-400/5 border border-amber-400/10 px-2.5 py-1 rounded-md uppercase tracking-wider">
                                {{ $exam->category->name }}
                            </span>

                            @if ($exam->is_premium)
                                <span class="bg-gradient-to-r from-[#FFE5A3] to-[#C39645] text-black text-[10px] font-extrabold px-2.5 py-1 rounded-md tracking-wider flex items-center gap-1 shadow-sm">
                                    🔒 PREMIUM
                                </span>
                            @endif
                        </div>

                        <!-- Content Section -->
                        <div class="flex-1">
                            <h3 class="text-lg font-serif font-bold text-white group-hover:text-amber-400 transition-colors duration-200">
                                {{ $exam->title }}
                            </h3>
                            <p class="text-gray-400 text-sm mt-2 leading-relaxed">
                                {{ Str::limit($exam->description, 80) }}
                            </p>
                        </div>

                        <!-- Metadata Footer Block -->
                        <div class="mt-5 border-t border-white/[0.05] pt-4">
                            <div class="flex items-center gap-4 text-xs font-medium text-gray-400 mb-5">
                                <span class="flex items-center gap-1.5 bg-white/5 px-2.5 py-1 rounded-lg border border-white/[0.03]">
                                    ⏱ {{ $exam->duration_minutes }} min
                                </span>
                                <span class="flex items-center gap-1.5 bg-white/5 px-2.5 py-1 rounded-lg border border-white/[0.03]">
                                    📝 {{ $exam->questions_count }} questions
                                </span>
                            </div>

                            <!-- Button Trigger -->
                            <a href="{{ route('exams.show', $exam) }}"
                               class="w-full text-center block py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.1)] group-hover:shadow-[0_4px_20px_rgba(226,183,103,0.25)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <!-- Empty State View -->
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-16 bg-[#121214] border border-white/[0.05] rounded-2xl">
                        <p class="text-gray-500 text-base font-medium">No exams available yet. Please check back later!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
