@extends('admin.layouts.app')

@section('content')
    <!-- Top Bar: Title & Create Action Button -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white tracking-wide">
            Categories
        </h1>
        <a href="{{ route('admin.categories.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center py-2.5 px-5 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_25px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer font-serif">
            + Add Category
        </a>
    </div>

    <!-- Aesthetic Dark Table Container -->
    <div class="bg-[#121214] border border-white/[0.05] rounded-2xl shadow-2xl overflow-hidden transition-all duration-300 hover:border-amber-400/10">
        <div class="overflow-x-auto w-full">
            <table class="w-full text-left whitespace-nowrap min-w-[600px]">
                <thead class="bg-[#1A1A1E] border-b border-white/[0.05] text-xs font-semibold text-gray-400 uppercase tracking-wider">
                    <tr>
                        <th class="p-4 sm:p-5 font-medium">Name</th>
                        <th class="p-4 sm:p-5 font-medium">Slug</th>
                        <th class="p-4 sm:p-5 font-medium text-center"># Questions</th>
                        <th class="p-4 sm:p-5 font-medium text-right pr-6">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/[0.03]">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-white/[0.01] transition-colors duration-150 group">
                            <!-- Category Name -->
                            <td class="p-4 sm:p-5 text-sm font-serif font-semibold text-white group-hover:text-amber-400 transition-colors">
                                {{ $category->name }}
                            </td>
                            <!-- Slug -->
                            <td class="p-4 sm:p-5 text-sm font-mono text-gray-500">
                                {{ $category->slug }}
                            </td>
                            <!-- Question Count -->
                            <td class="p-4 sm:p-5 text-sm text-center">
                                <span class="inline-block bg-white/5 border border-white/[0.03] text-gray-300 text-xs font-semibold px-2.5 py-1 rounded-lg">
                                    {{ $category->questions_count }}
                                </span>
                            </td>
                            <!-- Action Triggers -->
                            <td class="p-4 sm:p-5 text-sm text-right pr-6 space-x-2">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.categories.edit', $category) }}" class="inline-block text-xs font-bold text-amber-400/90 hover:text-amber-300 bg-amber-400/5 hover:bg-amber-400/10 border border-amber-400/10 px-3 py-1.5 rounded-xl transition-all">
                                    Edit
                                </a>
                                <!-- Delete Button -->
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Delete this category?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-block text-xs font-bold text-rose-400/90 hover:text-rose-400 bg-rose-500/5 hover:bg-rose-500/10 border border-rose-500/10 px-3 py-1.5 rounded-xl transition-all cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <!-- Empty Row Grid View -->
                        <tr>
                            <td colspan="4" class="p-8 text-center text-sm text-gray-500 font-medium">
                                📂 No categories created yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Laravel Native Custom Dark Pagination Links wrapper -->
    <div class="mt-6 dark-pagination">
        {{ $categories->links() }}
    </div>

    <!-- Small scoped inline CSS override to ensure standard Laravel pagination stays clean in dark theme -->
    <style>
        .dark-pagination nav svg { fill: currentColor; width: 1.25rem; height: 1.25rem; inline-block: true; }
        .dark-pagination nav span, .dark-pagination nav a { border-radius: 0.75rem !important; border-color: rgba(255, 255, 255, 0.05) !important; background-color: #121214 !important; color: #9CA3AF !important; }
        .dark-pagination nav a:hover { border-color: rgba(245, 158, 11, 0.3) !important; color: #F59E0B !important; }
    </style>
@endsection
