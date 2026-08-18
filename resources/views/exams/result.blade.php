<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            Exam Result
        </h2>
    </x-slot>

    <div class="py-12 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Anti-Cheat Cancellation Alert -->
            @if ($attempt->status === 'cancelled')
                <div class="mb-6 p-4 bg-rose-500/5 border border-rose-500/20 text-rose-400 text-sm rounded-xl font-medium animate-fade-in flex items-start gap-2.5 shadow-inner">
                    <span class="text-base leading-none select-none">⚠️</span>
                    <p class="leading-relaxed">
                        This attempt was <strong class="font-semibold text-white">cancelled</strong> due to a suspected anti-cheating violation (tab switch / window minimize).
                    </p>
                </div>
            @endif

            <!-- Score Summary Card -->
            <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 sm:p-8 mb-8 shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-amber-500/10">
                <p class="text-xs font-semibold text-amber-400/80 bg-amber-400/5 border border-amber-400/10 px-2.5 py-1 rounded-md uppercase tracking-wider inline-block mb-3">
                    {{ $attempt->exam->title }}
                </p>
                
                <h1 class="text-3xl sm:text-4xl font-serif font-extrabold text-white tracking-wide">
                    Score: <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645]">{{ number_format($attempt->score, 2) }}</span>
                </h1>

                <!-- Micro Stats Summary Grid -->
                <div class="grid grid-cols-3 gap-4 mt-6">
                    <!-- Correct -->
                    <div class="bg-emerald-500/5 border border-emerald-500/10 p-4 rounded-xl text-center group transition-colors hover:border-emerald-500/20">
                        <p class="text-2xl sm:text-3xl font-mono font-bold text-emerald-400">{{ $attempt->correct_count }}</p>
                        <p class="text-xs sm:text-sm font-medium text-gray-400 mt-1">Correct</p>
                    </div>
                    <!-- Wrong -->
                    <div class="bg-rose-500/5 border border-rose-500/10 p-4 rounded-xl text-center group transition-colors hover:border-rose-500/20">
                        <p class="text-2xl sm:text-3xl font-mono font-bold text-rose-400">{{ $attempt->wrong_count }}</p>
                        <p class="text-xs sm:text-sm font-medium text-gray-400 mt-1">Wrong</p>
                    </div>
                    <!-- Unanswered -->
                    <div class="bg-white/5 border border-white/[0.03] p-4 rounded-xl text-center group transition-colors hover:border-white/10">
                        <p class="text-2xl sm:text-3xl font-mono font-bold text-gray-300">{{ $attempt->unanswered_count }}</p>
                        <p class="text-xs sm:text-sm font-medium text-gray-400 mt-1">Unanswered</p>
                    </div>
                </div>

                <!-- Footer details inside card -->
                <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 border-t border-white/[0.05] pt-5">
                    <div class="text-xs text-gray-500 font-medium flex items-center gap-1.5">
                        📅 Submitted: {{ $attempt->submitted_at?->format('d M Y, h:i A') }}
                    </div>

                    <a href="{{ route('exams.index') }}" class="flex justify-center items-center py-2.5 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                        Back to Exams
                    </a>
                </div>
            </div>

            <!-- Question-wise Review Heading -->
            <h2 class="text-xl font-serif font-bold text-white mb-5 tracking-wide flex items-center gap-2">
                <span>📊</span> Answer Review
            </h2>

            <!-- Review Cards Stack -->
            <div class="space-y-4">
                @foreach ($attempt->answers as $answer)
                    @php $q = $answer->question; @endphp
                    <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 shadow-xl relative overflow-hidden transition-all duration-200 border-l-4 {{ $answer->is_correct === true ? 'border-l-emerald-500' : ($answer->is_correct === false ? 'border-l-rose-500' : 'border-l-gray-500') }}">
                        
                        <!-- Question Header Block -->
                        <div class="flex justify-between items-start gap-4 mb-4">
                            <p class="font-serif font-bold text-base sm:text-lg text-white leading-relaxed">
                                <span class="text-amber-400 font-mono font-normal mr-1">{{ $loop->iteration }}.</span> {{ $q->question_text }}
                            </p>
                            @if(in_array($q->id, $bookmarkedIds))
                                <span class="text-xl shrink-0 select-none" title="Bookmarked">⭐</span>
                            @endif
                        </div>

                        <!-- Options Wrapper Grid -->
                        <div class="space-y-2">
                            @foreach ($q->options as $key => $optionText)
                                @php
                                    $isCorrectOption = $key === $q->correct_option;
                                    $isSelectedOption = $key === $answer->selected_option;
                                @endphp
                                <div class="flex items-center justify-between p-3 rounded-xl border text-sm transition-all
                                    {{ $isCorrectOption ? 'bg-emerald-500/5 border-emerald-500/20 text-emerald-400 font-semibold' : '' }}
                                    {{ $isSelectedOption && !$isCorrectOption ? 'bg-rose-500/5 border-rose-500/20 text-rose-400 font-semibold' : '' }}
                                    {{ !$isCorrectOption && !$isSelectedOption ? 'bg-white/[0.01] border-white/[0.03] text-gray-400' : '' }}
                                ">
                                    <div>
                                        <strong class="{{ $isCorrectOption ? 'text-emerald-400' : ($isSelectedOption ? 'text-rose-400' : 'text-gray-500 font-mono') }} mr-2">{{ $key }}.</strong> 
                                        {{ $optionText }}
                                    </div>
                                    
                                    <!-- Dynamic Validation Badges -->
                                    @if ($isCorrectOption)
                                        <span class="text-xs bg-emerald-500/10 border border-emerald-500/20 px-2.5 py-0.5 rounded-md font-semibold tracking-wider uppercase text-emerald-400 shrink-0 ml-2">✓ Correct</span>
                                    @elseif ($isSelectedOption)
                                        <span class="text-xs bg-rose-500/10 border border-rose-500/20 px-2.5 py-0.5 rounded-md font-semibold tracking-wider uppercase text-rose-400 shrink-0 ml-2">✗ Your Answer</span>
                                    @endif
                                </div>
                            @endforeach
                        </div>

                        <!-- Explanation Block -->
                        @if ($q->explanation)
                            <div class="mt-5 p-4 bg-amber-500/5 border border-amber-500/20 text-xs sm:text-sm text-gray-300 rounded-xl shadow-inner leading-relaxed">
                                <strong class="font-serif text-amber-400 block mb-1">💡 Explanation:</strong> 
                                {{ $q->explanation }}
                            </div>
                        @endif

                        <!-- Not Answered Notification -->
                        @if (! $answer->selected_option)
                            <p class="mt-4 text-xs text-gray-500 italic bg-white/5 border border-white/[0.03] inline-block px-3 py-1 rounded-lg">
                                🚫 You did not answer this question.
                            </p>
                        @endif
                    </div>
                @endforeach
            </div>

        </div>
    </div>
</x-app-layout>
