@extends('admin.layouts.app')

@section('content')
    <!-- Top Header Metadata -->
    <div class="mb-8">
        <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
            {{ $exam->title }}
        </h1>
        <p class="text-amber-400/80 text-sm font-medium bg-amber-400/5 border border-amber-400/10 px-3 py-1 rounded-lg inline-block mt-2 font-mono">
            📂 {{ $exam->category->name }} • 📝 {{ $exam->questions->count() }} questions attached
        </p>
    </div>

    <!-- Layout Grid Structure -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        <!-- Block 1: Exam Settings Form Card -->
        <div class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl relative overflow-hidden transition-all duration-300 hover:border-amber-400/10">
            <h2 class="font-serif font-bold text-lg text-white mb-6 tracking-wide flex items-center gap-2">
                ⚙️ Exam Settings
            </h2>
            <form action="{{ route('admin.exams.update', $exam) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div class="group relative">
                    <label class="block mb-2 text-xs font-medium text-gray-400 group-focus-within:text-amber-400 transition-colors">Title</label>
                    <input type="text" name="title" value="{{ old('title', $exam->title) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all" required>
                </div>

                <!-- Description Textarea -->
                <div class="group relative">
                    <label class="block mb-2 text-xs font-medium text-gray-400 group-focus-within:text-amber-400 transition-colors">Description</label>
                    <textarea name="description" rows="2" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all resize-none">{{ old('description', $exam->description) }}</textarea>
                </div>

                <!-- Parameters Row Grid -->
                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <label class="block mb-2 text-[11px] font-medium text-gray-400">Duration (min)</label>
                        <input type="number" name="duration_minutes" value="{{ old('duration_minutes', $exam->duration_minutes) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-3 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-medium text-gray-400">+ Mark</label>
                        <input type="number" step="0.01" name="positive_mark" value="{{ old('positive_mark', $exam->positive_mark) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-3 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-[11px] font-medium text-gray-400">- Mark</label>
                        <input type="number" step="0.01" name="negative_mark" value="{{ old('negative_mark', $exam->negative_mark) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-3 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all" required>
                    </div>
                </div>

                <!-- Access Status Checkbox 1 -->
                <div class="flex items-center pt-1">
                    <label class="inline-flex items-center cursor-pointer group select-none">
                        <input type="checkbox" name="is_premium" value="1" class="w-4 h-4 rounded bg-[#1A1A1E] border-white/[0.1] text-amber-500 shadow-sm focus:ring-amber-400/30 focus:ring-offset-[#121214]" {{ old('is_premium', $exam->is_premium) ? 'checked' : '' }}>
                        <span class="ms-2.5 text-sm text-gray-300 group-hover:text-amber-400 transition-colors">Premium Exam</span>
                    </label>
                </div>

                <!-- Access Status Checkbox 2 -->
                <div class="flex items-center">
                    <label class="inline-flex items-center cursor-pointer group select-none">
                        <input type="checkbox" name="is_active" value="1" class="w-4 h-4 rounded bg-[#1A1A1E] border-white/[0.1] text-emerald-500 shadow-sm focus:ring-emerald-400/30 focus:ring-offset-[#121214]" {{ old('is_active', $exam->is_active) ? 'checked' : '' }}>
                        <span class="ms-2.5 text-sm text-gray-300 group-hover:text-emerald-400 transition-colors">Active <span class="text-xs text-gray-500 font-normal">(visible to students)</span></span>
                    </label>
                </div>

                <!-- Submit Action Trigger -->
                <div class="pt-2 border-t border-white/[0.05]">
                    <button type="submit" class="w-full sm:w-auto flex justify-center items-center py-2.5 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                        Update Settings
                    </button>
                </div>
            </form>
        </div>

        <!-- Block 2: Attached Questions Panel Box -->
        <div class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl flex flex-col justify-between">
            <div>
                <h2 class="font-serif font-bold text-lg text-white mb-4 tracking-wide">
                    📌 Attached Questions ({{ $exam->questions->count() }})
                </h2>
                
                <div class="space-y-2 max-h-[380px] overflow-y-auto pr-1 custom-scrollbar">
                    @forelse ($exam->questions as $q)
                        <div class="flex justify-between items-center py-3 border-b border-white/[0.03] bg-white/[0.01] hover:bg-white/[0.02] px-3 rounded-xl border border-transparent hover:border-white/[0.04] transition-all group">
                            <p class="text-sm text-gray-300 group-hover:text-white transition-colors pr-4">{{ Str::limit($q->question_text, 50) }}</p>
                            <form action="{{ route('admin.exams.detach', [$exam, $q]) }}" method="POST" onsubmit="return confirm('Remove this question?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-bold text-rose-400 bg-rose-500/5 hover:bg-rose-500/10 border border-rose-500/10 px-2.5 py-1 rounded-lg transition-all cursor-pointer">
                                    Remove
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-gray-500 text-sm py-4 italic">No questions attached yet. Add from the right panel.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Block 3: Available Questions Bottom Panel Box -->
    <div class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl mt-6">
        <h2 class="font-serif font-bold text-lg text-white mb-4 tracking-wide">
            🔍 Available Questions from "{{ $exam->category->name }}"
        </h2>
        
        <div class="space-y-2 max-h-[400px] overflow-y-auto pr-1 custom-scrollbar">
            @forelse ($availableQuestions as $q)
                <div class="flex justify-between items-center py-3 border-b border-white/[0.03] bg-white/[0.01] hover:bg-white/[0.02] px-3 rounded-xl border border-transparent hover:border-white/[0.04] transition-all group">
                    <p class="text-sm text-gray-300 group-hover:text-white transition-colors pr-4">{{ Str::limit($q->question_text, 70) }}</p>
                    <form action="{{ route('admin.exams.attach', $exam) }}" method="POST">
                        @csrf
                        <input type="hidden" name="question_id" value="{{ $q->id }}">
                        <button type="submit" class="text-xs font-bold text-emerald-400 bg-emerald-500/5 hover:bg-emerald-500/10 border border-emerald-500/10 px-3 py-1.5 rounded-lg transition-all cursor-pointer">
                            + Add to Exam
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-6 bg-white/[0.01] border border-white/[0.03] rounded-xl">
                    <p class="text-gray-500 text-sm italic">
                        No more questions available in this category. 
                        <a href="{{ route('admin.questions.create') }}" class="text-amber-400 hover:underline font-normal font-sans ml-1">Add more questions →</a>
                    </p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Custom Micro Thin Scrollbar styles for list widgets -->
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.05); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(226,183,103,0.2); }
    </style>
@endsection
