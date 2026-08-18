<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-2xl text-white leading-tight tracking-wide">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-8 bg-[#0B0B0C] min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome + Subscription status -->
            <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 flex justify-between items-center flex-wrap gap-4 transition-all duration-300 hover:border-amber-500/20 shadow-xl">
                <div>
                    <h1 class="text-xl sm:text-2xl font-serif font-bold text-white">Welcome back, {{ Auth::user()->name }}!</h1>
                    <p class="text-gray-400 text-sm mt-1">
                        Account Status: 
                        @if (Auth::user()->isPremium())
                            <span class="text-amber-400 font-bold bg-amber-400/10 px-2 py-0.5 rounded-md border border-amber-400/20">Premium</span>
                            @if ($subscription)
                                <span class="text-gray-500 text-xs">(expires {{ $subscription->end_date->format('d M Y') }})</span>
                            @endif
                        @else
                            <span class="text-gray-400 font-bold bg-white/5 px-2 py-0.5 rounded-md border border-white/10">Free</span>
                        @endif
                    </p>
                </div>
                @if (! Auth::user()->isPremium())
                    <a href="{{ route('subscription.plans') }}" class="flex justify-center items-center py-2.5 px-5 border border-transparent rounded-xl text-sm font-semibold text-black bg-gradient-to-r from-[#FFE5A3] via-[#E2B767] to-[#C39645] hover:from-white hover:to-[#E2B767] shadow-[0_4px_15px_rgba(226,183,103,0.15)] hover:shadow-[0_4px_20px_rgba(226,183,103,0.3)] transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200 cursor-pointer">
                        Upgrade to Premium
                    </a>
                @endif
            </div>

            <!-- Stats cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <!-- Total Exams -->
                <div class="bg-[#121214] border border-white/[0.05] p-5 rounded-2xl transition-all duration-300 hover:border-white/10 hover:-translate-y-1 shadow-lg group">
                    <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Total Exams Taken</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-2 text-white">{{ $totalExams }}</p>
                </div>
                <!-- Passed -->
                <div class="bg-[#121214] border border-white/[0.05] p-5 rounded-2xl transition-all duration-300 hover:border-emerald-500/20 hover:-translate-y-1 shadow-lg group">
                    <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Passed</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-2 text-emerald-400">{{ $passCount }}</p>
                </div>
                <!-- Failed -->
                <div class="bg-[#121214] border border-white/[0.05] p-5 rounded-2xl transition-all duration-300 hover:border-rose-500/20 hover:-translate-y-1 shadow-lg group">
                    <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Failed</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-2 text-rose-400">{{ $failCount }}</p>
                </div>
                <!-- Pass Rate -->
                <div class="bg-[#121214] border border-white/[0.05] p-5 rounded-2xl transition-all duration-300 hover:border-amber-500/20 hover:-translate-y-1 shadow-lg group">
                    <p class="text-gray-400 text-xs sm:text-sm font-medium group-hover:text-gray-300 transition-colors">Pass Rate</p>
                    <p class="text-2xl sm:text-3xl font-bold mt-2 text-amber-400">{{ $passPercentage }}%</p>
                </div>
            </div>

            <!-- Progress Graph -->
            <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 shadow-lg">
                <h2 class="font-serif font-semibold text-lg text-white mb-4">Score Progress <span class="text-xs font-sans text-gray-400 font-normal ml-1">(Last 10 Exams)</span></h2>
                @if ($graphData->count() > 0)
                    <div class="w-full relative h-[200px] sm:h-[250px] md:h-[300px]">
                        <canvas id="progressChart"></canvas>
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Take some exams to see your progress graph here.</p>
                @endif
            </div>

            <!-- Recent Attempts -->
            <div class="bg-[#121214] border border-white/[0.05] rounded-2xl p-6 shadow-lg">
                <div class="flex justify-between items-center mb-6 flex-wrap gap-2">
                    <h2 class="font-serif font-semibold text-lg text-white">Recent Exams</h2>
                    <a href="{{ route('bookmarks.index') }}" class="text-xs sm:text-sm text-amber-400 hover:text-amber-300 font-medium bg-amber-400/5 hover:bg-amber-400/10 px-3 py-1.5 rounded-xl border border-amber-400/10 transition-all">
                        📌 {{ $bookmarkCount }} Bookmarked Questions
                    </a>
                </div>

                <div class="space-y-2">
                    @forelse ($recentAttempts as $attempt)
                        <a href="{{ route('exams.result', $attempt) }}" class="flex justify-between items-center py-3.5 px-4 border border-white/[0.02] bg-white/[0.01] hover:bg-white/[0.03] hover:border-white/[0.08] rounded-xl transition-all duration-200 group">
                            <div>
                                <p class="font-medium text-gray-200 group-hover:text-white transition-colors">{{ $attempt->exam->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $attempt->submitted_at?->format('d M Y, h:i A') }}</p>
                            </div>
                            <span class="font-bold text-sm sm:text-base {{ $attempt->score >= 0 ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ number_format($attempt->score, 2) }}
                            </span>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm py-2">No exams taken yet. <a href="{{ route('exams.index') }}" class="text-amber-400 hover:underline ml-1">Browse exams</a>.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

    @if ($graphData->count() > 0)
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById('progressChart');
                
                // Chart Gradient
                const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 300);
                gradient.addColorStop(0, 'rgba(226, 183, 103, 0.25)');
                gradient.addColorStop(1, 'rgba(226, 183, 103, 0.0)');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($graphData->pluck('label')) !!},
                        datasets: [{
                            label: 'Score',
                            data: {!! json_encode($graphData->pluck('score')) !!},
                            borderColor: '#E2B767',
                            borderWidth: 3,
                            pointBackgroundColor: '#FFE5A3',
                            pointHoverBackgroundColor: '#FFFFFF',
                            pointHoverBorderColor: '#E2B767',
                            pointHoverBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            tension: 0.35,
                            fill: true,
                            backgroundColor: gradient,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { display: false }
                        },
                        scales: {
                            x: {
                                grid: { color: 'rgba(255, 255, 255, 0.04)' },
                                ticks: { color: '#888888', font: { size: 11 } }
                            },
                            y: {
                                grid: { color: 'rgba(255, 255, 255, 0.04)' },
                                ticks: { color: '#888888', font: { size: 11 } }
                            }
                        }
                    }
                });
            });
        </script>
    @endif
</x-app-layout>
