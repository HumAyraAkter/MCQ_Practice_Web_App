@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mb-6 tracking-wide">
        Bulk Add Questions
    </h1>

    <form action="{{ route('admin.questions.bulkStore') }}" method="POST" class="bg-[#121214] border border-white/[0.05] p-6 sm:p-8 rounded-2xl shadow-2xl space-y-5">
        @csrf

  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-300">Category</label>
        <select name="category_id" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3" required>
            <option value="">-- Select --</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        @error('category_id') <p class="text-rose-400 text-xs mt-2">⚠️ {{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-300">Sub Category (optional)</label>
        <select name="sub_category_id" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3">
            <option value="">-- None --</option>
            @foreach ($subCategories as $sub)
                <option value="{{ $sub->id }}" {{ old('sub_category_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block mb-2 text-sm font-medium text-gray-300">
            Attach to Exam <span class="text-xs text-gray-500 font-normal">(optional)</span>
        </label>
        <select name="exam_id" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3">
            <option value="">-- শুধু Question Bank-এ যোগ হবে --</option>
            @foreach ($exams as $exam)
                <option value="{{ $exam->id }}" {{ old('exam_id') == $exam->id ? 'selected' : '' }}>{{ $exam->title }}</option>
            @endforeach
        </select>
    </div>
</div>
         

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-300">Questions (Text Format)</label>
            <textarea name="raw_text" rows="16" class="w-full bg-[#1A1A1E] border border-white/[0.1] text-gray-100 rounded-xl px-4 py-3 font-mono text-sm" placeholder="Q: প্রশ্ন এখানে লিখুন?
A) অপশন ১
B) অপশন ২
C) অপশন ৩
D) অপশন ৪
Answer: A
Explanation: (optional)" required>{{ old('raw_text') }}</textarea>
            @error('raw_text') <p class="text-rose-400 text-xs mt-2">⚠️ {{ $message }}</p> @enderror
            <p class="text-xs text-gray-500 mt-2">
                প্রতিটা প্রশ্ন নতুন <code class="text-amber-400">Q:</code> দিয়ে শুরু করুন। একাধিক প্রশ্ন একসাথে paste করা যাবে।
            </p>
        </div>

        <div class="flex items-center">
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_premium" value="1" class="w-4 h-4 rounded bg-[#1A1A1E] border-white/[0.1] text-amber-500">
                <span class="ms-2.5 text-sm text-gray-300">সব প্রশ্ন Premium হিসেবে সেভ হবে</span>
            </label>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-white/[0.05]">
            <button type="submit" class="py-3 px-6 rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] font-serif">
                Import Questions
            </button>
            <a href="{{ route('admin.questions.index') }}" class="text-sm text-gray-400 hover:text-rose-400">Cancel</a>
        </div>
    </form>
@endsection