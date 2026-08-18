@extends('admin.layouts.app')

@section('content')
    <!-- Top Action Row Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
            Exams Management
        </h1>
        <a href="{{ route('admin.exams.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center py-2.5 px-5 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
            + Create Exam
        </a>
    </div>

    <!-- Aesthetic Responsive Master Table -->
    <div class="bg-[#121214] border border-white/[0.05] rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 hover:border-amber-400/10">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[850px]">
                <thead class="bg-[#1A1A1E] border-b border-white/[0.05] text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <tr>
                        <th class="p-4 sm:p-5 font-medium">Title</th>
                        <th class="p-4 sm:p-5 font-medium">Category</th>
                        <th class="p-4 sm:p-5 font-medium">Duration</th>
                        <th class="p-4 sm:p-5 font-medium text-center"># Questions</th>
                        <th class="p-4 sm:p-5 font-medium text-center">Type</th>
                        <th class="p-4 sm:p-5 font-medium text-center">Status</th>
                        <th class="p-4 sm:p-5 font-medium text-right pr-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse ($exams as $exam)
                        <tr class="hover:bg-white/[0.01] transition-colors duration-150 group">
                            <!-- Title -->
                            <td class="p-4 sm:p-5 text-sm font-serif font-semibold text-white group-hover:text-amber-400 transition-colors">
                                {{ $exam->title }}
                            </td>
                            <!-- Category Name -->
                            <td class="p-4 sm:p-5 text-sm text-gray-400">
                                {{ $exam->category->name }}
                            </td>
                            <!-- Duration -->
                            <td class="p-4 sm:p-5 text-sm font-mono text-gray-500">
                                ⏱ {{ $exam->duration_minutes }} min
                            </td>
                            <!-- Questions Attached Count -->
                            <td class="p-4 sm:p-5 text-sm text-center">
                                <span class="inline-block bg-white/5 border border-white/[0.03] text-gray-300 text-xs font-semibold px-2.5 py-1 rounded-lg">
                                    {{ $exam->questions_count }}
                                </span>
                            </td>
                            <!-- Access Type Badge -->
                            <td class="p-4 sm:p-5 text-sm text-center">
                                @if ($exam->is_premium)
                                    <span class="bg-gradient-to-r from-[#FFE5A3] to-[#C39645] text-black text-[10px] font-extrabold px-2.5 py-0.5 rounded-md tracking-wider uppercase shadow-sm">Premium 🔒</span>
                                @else
                                    <span class="bg-white/5 border border-white/10 text-gray-400 text-[10px] font-bold px-2.5 py-0.5 rounded-md tracking-wider uppercase">Free</span>
                                @endif
                            </td>
                            <!-- Visibility Status Indicator -->
                            <td class="p-4 sm:p-5 text-sm text-center">
                                @if ($exam->is_active)
                                    <span class="inline-flex items-center gap-1.5 text-xs text-emerald-400 font-medium bg-emerald-500/5 px-2.5 py-1 rounded-full border border-emerald-500/10">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Live
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 text-xs text-gray-500 font-medium bg-white/5 px-2.5 py-1 rounded-full border border-white/5">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-600"></span> Inactive
                                    </span>
                                @endif
                            </td>
                            <!-- Custom Quick Controls Trigger -->
                            <td class="p-4 sm:p-5 text-sm text-right pr-6 space-x-2">
                                <!-- Manage Edit Link -->
                                <a href="{{ route('admin.exams.edit', $exam) }}" class="inline-block text-xs font-bold text-amber-400/90 hover:text-amber-300 bg-amber-400/5 hover:bg-amber-400/10 border border-amber-400/10 px-3 py-1.5 rounded-xl transition-all">
                                    Manage
                                </a>
                                <!-- Destroy Delete Form Link -->
                                <form action="{{ route('admin.exams.destroy', $exam) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this exam?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block text-xs font-bold text-rose-400/90 hover:text-rose-400 bg-rose-500/5 hover:bg-rose-500/10 border border-rose-500/10 px-3 py-1.5 rounded-xl transition-all cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-sm text-gray-500 font-medium">
                                📂 No exams created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginator Links Render Block -->
    <div class="mt-6 dark-pagination">
        {{ $exams->links() }}
    </div>

    <!-- Scoped Inline Style Pagination Helper Override -->
    <style>
        .dark-pagination nav svg { fill: currentColor; width: 1.25rem; height: 1.25rem; }
        .dark-pagination nav span, .dark-pagination nav a { border-radius: 0.75rem !important; border-color: rgba(255, 255, 255, 0.05) !important; background-color: #121214 !important; color: #9CA3AF !important; }
        .dark-pagination nav a:hover { border-color: rgba(245, 158, 11, 0.3) !important; color: #F59E0B !important; }
    </style>
@endsection