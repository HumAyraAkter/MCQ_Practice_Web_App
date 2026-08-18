<?php

namespace App\Http\Controllers;

use App\Models\ExamAttempt;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $attempts = ExamAttempt::where('user_id', $userId)
            ->where('status', 'completed')
            ->with('exam')
            ->get();

        $totalExams = $attempts->count();

        // Pass if score >= 50% of max possible (positive_mark * total questions)
        $passCount = $attempts->filter(function ($attempt) {
            $totalQuestions = $attempt->exam->questions()->count();
            $maxScore = $totalQuestions * $attempt->exam->positive_mark;
            return $maxScore > 0 && ($attempt->score / $maxScore) >= 0.5;
        })->count();

        $failCount = $totalExams - $passCount;
        $passPercentage = $totalExams > 0 ? round(($passCount / $totalExams) * 100, 1) : 0;

        $recentAttempts = $attempts->sortByDesc('submitted_at')->take(5);

        // Data for progress graph (last 10 attempts, score over time)
        $graphData = $attempts->sortBy('submitted_at')->take(10)->map(function ($a) {
            return [
                'label' => $a->submitted_at?->format('d M'),
                'score' => $a->score,
            ];
        })->values();

        $bookmarkCount = Bookmark::where('user_id', $userId)->count();

        $subscription = Auth::user()->activeSubscription;

        return view('dashboard', compact(
            'totalExams', 'passCount', 'failCount', 'passPercentage',
            'recentAttempts', 'graphData', 'bookmarkCount', 'subscription'
        ));
    }
}