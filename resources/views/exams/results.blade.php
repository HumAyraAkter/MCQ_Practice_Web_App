<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            My Results
        </h2>
    </x-slot>

    <div class="py-8 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 shadow-lg">

                @if ($attempts->count() > 0)
                    <div class="space-y-2">
                        @foreach ($attempts as $attempt)
                            <a href="{{ route('exams.result', $attempt) }}" class="flex justify-between items-center py-3.5 px-4 border border-white/[0.02] bg-white/[0.01] hover:bg-white/[0.03] hover:border-white/[0.08] rounded-xl transition-all duration-200 group">
                                <div>
                                    <p class="font-medium text-gray-200 group-hover:text-white transition-colors">
                                        {{ $attempt->exam->title }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $attempt->submitted_at?->format('d M Y, h:i A') }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-md border
                                        {{ $attempt->is_pass
                                            ? 'text-emerald-400 bg-emerald-400/10 border-emerald-400/20'
                                            : 'text-rose-400 bg-rose-400/10 border-rose-400/20' }}">
                                        {{ $attempt->is_pass ? 'PASS' : 'FAIL' }}
                                    </span>
                                    <span class="font-bold text-sm sm:text-base {{ $attempt->is_pass ? 'text-emerald-400' : 'text-rose-400' }}">
                                        {{ number_format($attempt->score, 2) }}
                                    </span>
                                </div>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $attempts->links() }}
                    </div>
                @else
                    <p class="text-gray-500 text-sm py-2">
                        No exams taken yet. <a href="{{ route('exams.index') }}" class="text-amber-400 hover:underline ml-1">Browse exams</a>.
                    </p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>