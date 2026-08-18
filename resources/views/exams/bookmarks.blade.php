<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            Bookmarked Questions
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-5">

            @forelse ($bookmarks as $bookmark)
                @php $q = $bookmark->question; @endphp
                
                <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 shadow-xl transition-all duration-300 hover:border-white/10 shadow-lg">
                    <!-- Category Badge -->
                    <span class="text-[11px] font-semibold text-amber-400/80 bg-amber-400/5 border border-amber-400/10 px-2.5 py-1 rounded-md uppercase tracking-wider inline-block mb-3">
                        {{ $q->category->name }}
                    </span>
                    
                    <!-- Question Text -->
                    <p class="font-serif font-bold text-lg text-white leading-relaxed mb-4">
                        {{ $q->question_text }}
                    </p>

                    <!-- Options Box -->
                    <div class="space-y-2 text-sm sm:text-base">
                        @foreach ($q->options as $key => $optionText)
                            @php 
                                $isCorrect = ($key === $q->correct_option);
                            @endphp
                            <div class="p-3 rounded-xl border transition-colors {{ $isCorrect ? 'bg-emerald-500/5 border-emerald-500/20 text-emerald-400 font-semibold shadow-[0_0_15px_rgba(16,185,129,0.02)]' : 'bg-white/[0.01] border-white/[0.03] text-gray-400' }}">
                                <span class="{{ $isCorrect ? 'text-emerald-400' : 'text-amber-400/80 font-mono' }} mr-1.5 font-bold">{{ $key }}.</span>
                                {{ $optionText }} 
                                @if($isCorrect)
                                    <span class="ml-2 text-emerald-400 text-sm">✓ (Correct Answer)</span>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <!-- Explanation Widget -->
                    @if ($q->explanation)
                        <div class="mt-5 p-4 bg-amber-500/5 border border-amber-500/20 text-sm text-gray-300 rounded-xl shadow-inner leading-relaxed">
                            <strong class="font-serif text-amber-400 block mb-1">💡 Explanation:</strong> 
                            {{ $q->explanation }}
                        </div>
                    @endif
                </div>
                
            @empty
                <!-- Empty State View -->
                <div class="text-center py-16 bg-[#121214] border border-white/[0.05] rounded-2xl p-8">
                    <div class="w-16 h-16 bg-white/5 border border-white/10 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl select-none">
                        📌
                    </div>
                    <p class="text-gray-400 text-base font-medium max-w-md mx-auto leading-relaxed">
                        You haven't bookmarked any questions yet. Bookmark important or tricky questions during an exam by clicking the ⭐ icon to review them here later.
                    </p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
