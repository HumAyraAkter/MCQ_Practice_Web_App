<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\AttemptAnswer;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    // List all active exams
    public function index()
    {
        $exams = Exam::where('is_active', true)->with('category')->withCount('questions')->latest()->get();
        return view('exams.index', compact('exams'));
    }

    // Show exam details before starting
    public function show(Exam $exam)
    {
        $user = Auth::user();

        // Block free users from premium exams
        if ($exam->is_premium && ! $user->isPremium()) {
            return redirect()->route('exams.index')->with('error', 'This is a premium exam. Please subscribe to access it.');
        }

        return view('exams.show', compact('exam'));
    }

    // Start exam - create attempt and redirect to live exam page
    public function start(Exam $exam)
    {
        $user = Auth::user();

        if ($exam->is_premium && ! $user->isPremium()) {
            return redirect()->route('exams.index')->with('error', 'This is a premium exam. Please subscribe to access it.');
        }

        // Check if there's already an in-progress attempt
        $existingAttempt = ExamAttempt::where('user_id', $user->id)
            ->where('exam_id', $exam->id)
            ->where('status', 'in_progress')
            ->first();

        if ($existingAttempt) {
            return redirect()->route('exams.attempt', $existingAttempt);
        }

        $attempt = ExamAttempt::create([
            'user_id' => $user->id,
            'exam_id' => $exam->id,
            'status' => 'in_progress',
            'started_at' => now(),
        ]);

        return redirect()->route('exams.attempt', $attempt);
    }

    // Live exam page
    public function attempt(ExamAttempt $attempt)
    {
        // Security: only the owner can access
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->status !== 'in_progress') {
            return redirect()->route('exams.result', $attempt);
        }

        $exam = $attempt->exam()->with('questions')->first();

        // Calculate remaining time
        $endsAt = $attempt->started_at->addMinutes($exam->duration_minutes);
        $remainingSeconds = max(0, now()->diffInSeconds($endsAt, false));

        // If time already up, auto-submit
        if ($remainingSeconds <= 0) {
            return $this->submit(request(), $attempt);
        }

        // Get previously saved answers (in case of page reload)
        $savedAnswers = AttemptAnswer::where('exam_attempt_id', $attempt->id)
            ->pluck('selected_option', 'question_id');

        $bookmarkedIds = Bookmark::where('user_id', Auth::id())
            ->whereIn('question_id', $exam->questions->pluck('id'))
            ->pluck('question_id')
            ->toArray();

        return view('exams.attempt', compact('attempt', 'exam', 'remainingSeconds', 'savedAnswers', 'bookmarkedIds'));
    }

    // Save a single answer (AJAX call, auto-save as user progresses)
    public function saveAnswer(Request $request, ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id() || $attempt->status !== 'in_progress') {
            abort(403);
        }

        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'selected_option' => 'nullable|in:A,B,C,D',
        ]);

        AttemptAnswer::updateOrCreate(
            [
                'exam_attempt_id' => $attempt->id,
                'question_id' => $validated['question_id'],
            ],
            [
                'selected_option' => $validated['selected_option'],
            ]
        );

        return response()->json(['status' => 'saved']);
    }

    // Toggle bookmark (AJAX)
    public function toggleBookmark(Request $request)
    {
        $validated = $request->validate(['question_id' => 'required|exists:questions,id']);

        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('question_id', $validated['question_id'])
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            return response()->json(['bookmarked' => false]);
        }

        Bookmark::create(['user_id' => Auth::id(), 'question_id' => $validated['question_id']]);
        return response()->json(['bookmarked' => true]);
    }

    // Anti-cheat violation log (tab switch etc.) - auto-cancel exam
    public function reportViolation(Request $request, ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id() || $attempt->status !== 'in_progress') {
            return response()->json(['status' => 'ignored']);
        }

        // Cancel the attempt due to cheating
        $attempt->update(['status' => 'cancelled', 'submitted_at' => now()]);

        return response()->json(['status' => 'cancelled']);
    }

    // Submit exam and calculate score
    public function submit(Request $request, ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        if ($attempt->status !== 'in_progress') {
            return redirect()->route('exams.result', $attempt);
        }

        $exam = $attempt->exam;
        $questions = $exam->questions;
        $answers = AttemptAnswer::where('exam_attempt_id', $attempt->id)->get()->keyBy('question_id');

        $correctCount = 0;
        $wrongCount = 0;
        $unansweredCount = 0;

        foreach ($questions as $question) {
            $answer = $answers->get($question->id);

            if (! $answer || ! $answer->selected_option) {
                $unansweredCount++;
                continue;
            }

            $isCorrect = $answer->selected_option === $question->correct_option;

            $answer->update(['is_correct' => $isCorrect]);

            if ($isCorrect) {
                $correctCount++;
            } else {
                $wrongCount++;
            }
        }

        $score = ($correctCount * $exam->positive_mark) - ($wrongCount * $exam->negative_mark);

        $attempt->update([
            'score' => $score,
            'correct_count' => $correctCount,
            'wrong_count' => $wrongCount,
            'unanswered_count' => $unansweredCount,
            'status' => 'completed',
            'submitted_at' => now(),
        ]);

        return redirect()->route('exams.result', $attempt);
    }

    // Result / scorecard page
    public function result(ExamAttempt $attempt)
    {
        if ($attempt->user_id !== Auth::id()) {
            abort(403);
        }

        $attempt->load('exam', 'answers.question');
        $bookmarkedIds = Bookmark::where('user_id', Auth::id())->pluck('question_id')->toArray();

        return view('exams.result', compact('attempt', 'bookmarkedIds'));
    }
    public function bookmarks()
{
    $bookmarks = Bookmark::where('user_id', Auth::id())
        ->with('question.category')
        ->latest()
        ->get();

    return view('exams.bookmarks', compact('bookmarks'));
}
public function results()
{
    $userId = Auth::id();

    $attempts = ExamAttempt::where('user_id', $userId)
        ->where('status', 'completed')
        ->with('exam')
        ->orderByDesc('submitted_at')
        ->paginate(15);

    $attempts->getCollection()->transform(function ($attempt) {
        $totalQuestions = $attempt->exam->questions()->count();
        $maxScore = $totalQuestions * $attempt->exam->positive_mark;
        $attempt->is_pass = $maxScore > 0 && ($attempt->score / $maxScore) >= 0.5;
        return $attempt;
    });

    return view('exams.results', compact('attempts'));
}







}