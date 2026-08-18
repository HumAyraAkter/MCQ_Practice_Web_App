@extends('admin.layouts.app')

@section('content')
    <!-- Top Action Row Bar: Title & Add Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
        <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
            Questions Bank
        </h1>
        <a href="{{ route('admin.questions.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center py-2.5 px-5 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
            + Add Question
        </a>
    </div>

    <!-- Category Filter Form Dropdown -->
    <form method="GET" class="mb-6 max-w-xs">
        <div class="relative group">
            <select name="category_id" onchange="this.form.submit()" class="w-full bg-[#121214] border border-white/[0.1] text-gray-300 rounded-xl px-4 py-2.5 text-sm focus:border-amber-400 focus:ring focus:ring-amber-400/20 transition-all cursor-pointer shadow-md">
                <option value="" class="bg-[#121214] text-gray-400">All Categories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }} class="bg-[#121214] text-gray-200">
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <!-- Aesthetic Dark Master Table -->
    <div class="bg-[#121214] border border-white/[0.05] rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 hover:border-amber-400/10">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[750px]">
                <thead class="bg-[#1A1A1E] border-b border-white/[0.05] text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <tr>
                        <th class="p-4 sm:p-5 font-medium">Question</th>
                        <th class="p-4 sm:p-5 font-medium">Category</th>
                        <th class="p-4 sm:p-5 font-medium text-center">Type</th>
                        <th class="p-4 sm:p-5 font-medium text-right pr-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse ($questions as $question)
                        <tr class="hover:bg-white/[0.01] transition-colors duration-150 group">
                            <!-- Question Text -->
                            <td class="p-4 sm:p-5 text-sm font-serif text-gray-200 group-hover:text-white transition-colors max-w-sm overflow-hidden text-ellipsis">
                                {{ Str::limit($question->question_text, 60) }}
                            </td>
                            <!-- Category Badge Label -->
                            <td class="p-4 sm:p-5 text-sm text-gray-400">
                                <span class="bg-white/5 border border-white/[0.03] text-gray-300 text-xs px-2.5 py-1 rounded-lg">
                                    {{ $question->category->name }}
                                </span>
                            </td>
                            <!-- Access Type Badge -->
                            <td class="p-4 sm:p-5 text-sm text-center">
                                @if ($question->is_premium)
                                    <span class="bg-gradient-to-r from-[#FFE5A3] to-[#C39645] text-black text-[10px] font-extrabold px-2.5 py-0.5 rounded-md tracking-wider uppercase shadow-sm">Premium 🔒</span>
                                @else
                                    <span class="bg-white/5 border border-white/10 text-gray-400 text-[10px] font-bold px-2.5 py-0.5 rounded-md tracking-wider uppercase">Free</span>
                                @endif
                            </td>
                            <!-- Action Custom Buttons -->
                            <td class="p-4 sm:p-5 text-sm text-right pr-6 space-x-2">
                                <!-- Edit trigger -->
                                <a href="{{ route('admin.questions.edit', $question) }}" class="inline-block text-xs font-bold text-amber-400/90 hover:text-amber-300 bg-amber-400/5 hover:bg-amber-400/10 border border-amber-400/10 px-3 py-1.5 rounded-xl transition-all">
                                    Edit
                                </a>
                                <!-- Destroy trigger -->
                                <form action="{{ route('admin.questions.destroy', $question) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this question?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block text-xs font-bold text-rose-400/90 hover:text-rose-400 bg-rose-500/5 hover:bg-rose-500/10 border border-rose-500/10 px-3 py-1.5 rounded-xl transition-all cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <!-- Empty Data View Row -->
                        <tr>
                            <td colspan="4" class="p-8 text-center text-sm text-gray-500 font-medium">
                                📂 No questions found in this scope.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laravel Custom Dark Pagination Helper -->
    <div class="mt-6 dark-pagination">
        {{ $questions->links() }}
    </div>

    <!-- Scoped Style Pagination Framework Helper Overrider -->
    <style>
        .dark-pagination nav svg { fill: currentColor; width: 1.25rem; height: 1.25rem; }
        .dark-pagination nav span, .dark-pagination nav a { border-radius: 0.75rem !important; border-color: rgba(255, 255, 255, 0.05) !important; background-color: #121214 !important; color: #9CA3AF !important; }
        .dark-pagination nav a:hover { border-color: rgba(245, 158, 11, 0.3) !important; color: #F59E0B !important; }
    </style>
@endsection
