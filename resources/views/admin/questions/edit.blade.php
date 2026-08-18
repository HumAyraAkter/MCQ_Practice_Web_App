@extends('admin.layouts.app')

@section('content')
    <!-- Page Title -->
    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mb-6 tracking-wide">
        Edit Question
    </h1>

    <!-- Aesthetic Dark Form Card -->
    <form action="{{ route('admin.questions.update', $question) }}" method="POST" class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl max-w-2xl space-y-5 transition-all duration-300 hover:border-amber-400/10 group relative overflow-hidden">
        @csrf
        @method('PUT')
        
        <!-- Soft Ambient Light -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Category Select -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Category
            </label>
            <select name="category_id" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner cursor-pointer" required>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $question->category_id) == $cat->id ? 'selected' : '' }} class="bg-[#1A1A1E] text-gray-100">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-rose-400 text-xs sm:text-sm mt-2 font-medium flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
        </div>

        <!-- Question Text Textarea -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Question Text
            </label>
            <textarea name="question_text" rows="3" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner resize-none" required>{{ old('question_text', $question->question_text) }}</textarea>
            @error('question_text') <p class="text-rose-400 text-xs sm:text-sm mt-2 font-medium flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
        </div>

        <!-- MCQ Options 2x2 Grid (Responsive: 1 col on mobile, 2 cols on desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Option A -->
            <div class="group relative">
                <label class="block mb-1.5 text-xs font-medium text-amber-400/80 group-focus-within:text-amber-400 transition-colors">Option A</label>
                <input type="text" name="option_a" value="{{ old('option_a', $question->options['A'] ?? '') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all shadow-inner" required>
            </div>
            <!-- Option B -->
            <div class="group relative">
                <label class="block mb-1.5 text-xs font-medium text-amber-400/80 group-focus-within:text-amber-400 transition-colors">Option B</label>
                <input type="text" name="option_b" value="{{ old('option_b', $question->options['B'] ?? '') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all shadow-inner" required>
            </div>
            <!-- Option C -->
            <div class="group relative">
                <label class="block mb-1.5 text-xs font-medium text-amber-400/80 group-focus-within:text-amber-400 transition-colors">Option C</label>
                <input type="text" name="option_c" value="{{ old('option_c', $question->options['C'] ?? '') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all shadow-inner" required>
            </div>
            <!-- Option D -->
            <div class="group relative">
                <label class="block mb-1.5 text-xs font-medium text-amber-400/80 group-focus-within:text-amber-400 transition-colors">Option D</label>
                <input type="text" name="option_d" value="{{ old('option_d', $question->options['D'] ?? '') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all shadow-inner" required>
            </div>
        </div>

        <!-- Correct Option Select -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Correct Option
            </label>
            <select name="correct_option" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner cursor-pointer" required>
                @foreach (['A', 'B', 'C', 'D'] as $opt)
                    <option value="{{ $opt }}" {{ old('correct_option', $question->correct_option) == $opt ? 'selected' : '' }} class="bg-[#1A1A1E] text-white">
                        {{ $opt }}
                    </option>
                @endforeach
            </select>
            @error('correct_option') <p class="text-rose-400 text-xs sm:text-sm mt-2 font-medium flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
        </div>

        <!-- Explanation Textarea -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Explanation <span class="text-xs text-gray-500 font-normal">(optional)</span>
            </label>
            <textarea name="explanation" rows="2" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner resize-none" placeholder="Provide detailed breakdown or logic for the correct answer...">{{ old('explanation', $question->explanation) }}</textarea>
        </div>

        <!-- Premium Question Checkbox -->
        <div class="flex items-center pt-1">
            <label for="is_premium" class="inline-flex items-center cursor-pointer group select-none">
                <input type="checkbox" name="is_premium" value="1" id="is_premium" class="w-4 h-4 rounded bg-[#1A1A1E] border-white/[0.1] text-amber-500 shadow-sm focus:ring-amber-400/30 focus:ring-offset-[#121214]" {{ old('is_premium', $question->is_premium) ? 'checked' : '' }}>
                <span class="ms-2.5 text-sm text-gray-300 group-hover:text-amber-400 transition-colors duration-200">
                    Premium Question
                </span>
            </label>
        </div>

        <!-- Form Actions Footer -->
        <div class="flex items-center gap-4 pt-4 border-t border-white/[0.05]">
            <!-- Update Button -->
            <button type="submit" class="flex justify-center items-center py-3 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                Update Question
            </button>
            
            <!-- Cancel Link -->
            <a href="{{ route('admin.questions.index') }}" class="text-sm text-gray-400 hover:text-rose-400 font-medium transition-colors duration-200 py-2.5 px-4 rounded-xl hover:bg-white/5">
                Cancel
            </a>
        </div>
    </form>
@endsection
