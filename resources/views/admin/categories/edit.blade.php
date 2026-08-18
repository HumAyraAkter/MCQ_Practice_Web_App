@extends('admin.layouts.app')

@section('content')
    <!-- Page Title -->
    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mb-6 tracking-wide">
        Edit Category
    </h1>

    <!-- Aesthetic Dark Form Card -->
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl max-w-lg transition-all duration-300 hover:border-amber-400/20 group relative overflow-hidden">
        @csrf
        @method('PUT')
        
        <!-- Soft Ambient Light -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Input Group -->
        <div class="mb-6 group relative">
            <label class="block mb-2 text-sm font-medium text-gray-300 group-focus-within:text-amber-400 transition-colors duration-200">
                Category Name
            </label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}"
                   class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all duration-200 shadow-inner" 
                   required>
            
            <!-- Error Alert -->
            @error('name') 
                <p class="text-rose-400 text-xs sm:text-sm mt-2 font-medium flex items-center gap-1">
                    ⚠️ {{ $message }}
                </p> 
            @enderror
        </div>

        <!-- Actions Section -->
        <div class="flex items-center gap-4 pt-2 border-t border-white/[0.05]">
            <!-- Update Submit Button -->
            <button type="submit" class="flex justify-center items-center py-2.5 px-6 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
                Update
            </button>
            
            <!-- Cancel Link -->
            <a href="{{ route('admin.categories.index') }}" class="text-sm text-gray-400 hover:text-rose-400 font-medium transition-colors duration-200 py-2 px-3 rounded-xl hover:bg-white/5">
                Cancel
            </a>
        </div>
    </form>
@endsection
