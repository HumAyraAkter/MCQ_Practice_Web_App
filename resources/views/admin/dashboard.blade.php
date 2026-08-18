@extends('admin.layouts.app')

@section('content')
    <!-- Page Title -->
    <h1 class="text-2xl sm:text-3xl font-serif font-bold text-white mb-6 tracking-wide">
        Dashboard Overview
    </h1>

    <!-- Core Metrics Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        
        <!-- Total Students -->
        <div class="bg-[#121214] border border-white/[0.05] p-5 sm:p-6 rounded-2xl shadow-xl transition-all duration-300 hover:border-white/10 hover:-translate-y-1 group">
            <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Total Students</p>
            <p class="text-2xl sm:text-3xl font-bold mt-2 text-white">{{ $totalUsers }}</p>
        </div>

        <!-- Premium Users -->
        <div class="bg-[#121214] border border-white/[0.05] p-5 sm:p-6 rounded-2xl shadow-xl transition-all duration-300 hover:border-emerald-500/20 hover:-translate-y-1 group">
            <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Premium Users</p>
            <p class="text-2xl sm:text-3xl font-bold mt-2 text-emerald-400">{{ $premiumUsers }}</p>
        </div>

        <!-- Free Users -->
        <div class="bg-[#121214] border border-white/[0.05] p-5 sm:p-6 rounded-2xl shadow-xl transition-all duration-300 hover:border-white/10 hover:-translate-y-1 group">
            <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Free Users</p>
            <p class="text-2xl sm:text-3xl font-bold mt-2 text-gray-400">{{ $freeUsers }}</p>
        </div>

        <!-- Total Revenue -->
        <div class="bg-[#121214] border border-white/[0.05] p-5 sm:p-6 rounded-2xl shadow-xl transition-all duration-300 hover:border-amber-500/20 hover:-translate-y-1 group relative overflow-hidden">
            <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Total Revenue</p>
            <p class="text-2xl sm:text-3xl font-bold mt-2 text-transparent bg-clip-text bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645]">
                ৳{{ number_format($totalRevenue, 2) }}
            </p>
        </div>

    </div>

    <!-- Secondary Metric: Total Exam Attempts Box -->
    <div class="bg-[#121214] border border-white/[0.05] p-6 rounded-2xl shadow-xl transition-all duration-300 hover:border-white/10 group">
        <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Total Exam Attempts</p>
        <p class="text-2xl sm:text-3xl font-bold mt-2 text-amber-400/90">{{ $totalExamAttempts }}</p>
    </div>
@endsection
