<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            {{ $exam->title }}
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 sm:p-8 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-amber-500/20">
                
                <!-- Soft Glow Accent -->
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

                <!-- Category & Title -->
                <div>
                    <span class="text-xs font-semibold text-amber-400/80 bg-amber-400/5 border border-amber-400/10 px-2.5 py-1 rounded-md uppercase tracking-wider">
                        {{ $exam->category->name }}
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mt-4 tracking-wide">
                        {{ $exam->title }}
                    </h1>
                    <p class="text-gray-400 text-sm sm:text-base mt-3 leading-relaxed">
                        {{ $exam->description }}
                    </p>
                </div>

                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-4 mt-8 text-sm">
                    <!-- Duration -->
                    <div class="bg-[#1A1A1E] border border-white/[0.03] p-4 rounded-xl group transition-all duration-200 hover:border-white/10">
                        <p class="text-gray-400 font-medium flex items-center gap-1.5 mb-1 text-xs">⏱ Duration</p>
                        <p class="font-bold text-white text-base sm:text-lg">{{ $exam->duration_minutes }} <span class="text-xs font-normal text-gray-500">mins</span></p>
                    </div>
                    <!-- Questions Count -->
                    <div class="bg-[#1A1A1E] border border-white/[0.03] p-4 rounded-xl group transition-all duration-200 hover:border-white/10">
                        <p class="text-gray-400 font-medium flex items-center gap-1.5 mb-1 text-xs">📝 Total Questions</p>
                        <p class="font-bold text-white text-base sm:text-lg">{{ $exam->questions()->count() }} <span class="text-xs font-normal text-gray-500">items</span></p>
                    </div>
                    <!-- Marking Scheme -->
                    <div class="bg-[#1A1A1E] border border-white/[0.03] p-4 rounded-xl group transition-all duration-200 hover:border-white/10">
                        <p class="text-gray-400 font-medium flex items-center gap-1.5 mb-1 text-xs">🎯 Marking</p>
                        <p class="font-bold text-white text-base sm:text-lg">
                            <span class="text-emerald-400">+{{ $exam->positive_mark }}</span> 
                            <span class="text-gray-600 mx-1">/</span> 
                            <span class="text-rose-400">-{{ $exam->negative_mark }}</span>
                        </p>
                    </div>
                    <!-- Access Type -->
                    <div class="bg-[#1A1A1E] border border-white/[0.03] p-4 rounded-xl group transition-all duration-200 hover:border-white/10">
                        <p class="text-gray-400 font-medium flex items-center gap-1.5 mb-1 text-xs">💎 Access Type</p>
                        <p class="font-bold text-base sm:text-lg {{ $exam->is_premium ? 'text-amber-400' : 'text-gray-400' }}">
                            {{ $exam->is_premium ? 'Premium 🔒' : 'Free' }}
                        </p>
                    </div>
                </div>

                <!-- Aesthetic Warning Alert Box -->
                <div class="mt-8 p-4 bg-amber-500/5 border border-amber-500/20 rounded-xl text-xs sm:text-sm text-amber-400 flex items-start gap-3 shadow-inner">
                    <span class="text-base leading-none select-none">⚠️</span>
                    <p class="leading-relaxed">
                        <strong class="font-semibold text-white">Anti-Cheat Alert:</strong> Do not switch tabs or minimize the browser during the exam. Doing so will automatically submit and cancel your current attempt.
                    </p>
                </div>

                <!-- Submit / Start Action Button -->
                <form action="{{ route('exams.start', $exam) }}" method="POST" class="mt-8">
                    @csrf
                    <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_20px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                        Start Exam
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
