@extends('admin.layouts.app')

@section('content')
    <!-- Page Title -->
    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mb-6 tracking-wide">
        Create Exam
    </h1>

    <!-- Aesthetic Dark Form Card -->
    <form action="{{ route('admin.exams.store') }}" method="POST" class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl max-w-2xl space-y-5 transition-all duration-300 hover:border-amber-400/10 group relative overflow-hidden">
        @csrf
        
        <!-- Soft Ambient Light -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Category Select Dropdown -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Category
            </label>
            <select name="category_id" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner cursor-pointer" required>
                <option value="" class="bg-[#1A1A1E] text-gray-400">-- Select --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }} class="bg-[#1A1A1E] text-gray-100">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-rose-400 text-xs sm:text-sm mt-2 font-medium flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
        </div>

        <!-- Exam Title Input -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Exam Title
            </label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner" placeholder="e.g. BCS Preliminary Model Test 01" required>
            @error('title') <p class="text-rose-400 text-xs sm:text-sm mt-2 font-medium flex items-center gap-1">⚠️ {{ $message }}</p> @enderror
        </div>

        <!-- Description Textarea -->
        <div class="group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Description
            </label>
            <textarea name="description" rows="2" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner resize-none" placeholder="Short summary about the exam guidelines..."></textarea>
        </div>

        <!-- Numeric Parameters Grid (Responsive 1 col on mobile, 3 cols on desktop) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Duration -->
            <div class="group relative">
                <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                    Duration (minutes)
                </label>
                <input type="number" name="duration_minutes" value="{{ old('duration_minutes', 30) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner" required>
            </div>
            <!-- Positive Mark -->
            <div class="group relative">
                <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                    Positive Mark
                </label>
                <input type="number" step="0.01" name="positive_mark" value="{{ old('positive_mark', 1) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner" required>
            </div>
            <!-- Negative Mark -->
            <div class="group relative">
                <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                    Negative Mark
                </label>
                <input type="number" step="0.01" name="negative_mark" value="{{ old('negative_mark', 0.25) }}" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner" required>
            </div>
        </div>

        <!-- Premium Checkbox with Custom Styling -->
        <div class="flex items-center pt-2">
            <label for="is_premium" class="inline-flex items-center cursor-pointer group select-none">
                <input type="checkbox" name="is_premium" value="1" id="is_premium" class="w-4 h-4 rounded bg-[#1A1A1E] border-white/[0.1] text-amber-500 shadow-sm focus:ring-amber-400/30 focus:ring-offset-[#121214]" {{ old('is_premium') ? 'checked' : '' }}>
                <span class="ms-2.5 text-sm text-gray-300 group-hover:text-amber-400 transition-colors duration-200">
                    Premium Exam <span class="text-xs text-gray-500 font-normal">(locked for free users)</span>
                </span>
            </label>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center gap-4 pt-4 border-t border-white/[0.05]">
            <!-- Submit button -->
            <button type="submit" class="flex justify-center items-center py-3 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                Create & Add Questions
            </button>
            
            <!-- Cancel button -->
            <a href="{{ route('admin.exams.index') }}" class="text-sm text-gray-400 hover:text-rose-400 font-medium transition-colors duration-200 py-2.5 px-4 rounded-xl hover:bg-white/5">
                Cancel
            </a>
        </div>
    </form>
@endsection
