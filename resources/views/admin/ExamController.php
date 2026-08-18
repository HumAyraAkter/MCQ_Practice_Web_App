<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
   public function index()
{
    return 'Controller reached';
}

    public function create()
    {
        $categories = Category::all();
        return view('admin.exams.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'positive_mark' => 'required|numeric|min:0',
            'negative_mark' => 'required|numeric|min:0',
            'is_premium' => 'nullable|boolean',
        ]);

        $exam = Exam::create([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'duration_minutes' => $validated['duration_minutes'],
            'positive_mark' => $validated['positive_mark'],
            'negative_mark' => $validated['negative_mark'],
            'is_premium' => $request->boolean('is_premium'),
            'is_active' => true,
        ]);

        return redirect()->route('admin.exams.edit', $exam)
            ->with('success', 'Exam created. Now add questions to it.');
    }

    public function edit(Exam $exam)
    {
        $exam->load('questions');
        $attachedIds = $exam->questions->pluck('id')->toArray();

        // Available questions from the same category, not yet attached
        $availableQuestions = Question::where('category_id', $exam->category_id)
            ->whereNotIn('id', $attachedIds)
            ->get();

        return view('admin.exams.edit', compact('exam', 'availableQuestions', 'attachedIds'));
    }

    public function update(Request $request, Exam $exam)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'positive_mark' => 'required|numeric|min:0',
            'negative_mark' => 'required|numeric|min:0',
            'is_premium' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
        ]);

        $exam->update([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'duration_minutes' => $validated['duration_minutes'],
            'positive_mark' => $validated['positive_mark'],
            'negative_mark' => $validated['negative_mark'],
            'is_premium' => $request->boolean('is_premium'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.exams.edit', $exam)->with('success', 'Exam updated.');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'Exam deleted.');
    }

    // Attach a question to exam
    public function attachQuestion(Request $request, Exam $exam)
    {
        $request->validate(['question_id' => 'required|exists:questions,id']);

        if (! $exam->questions()->where('question_id', $request->question_id)->exists()) {
            $exam->questions()->attach($request->question_id);
        }

        return back()->with('success', 'Question added to exam.');
    }

    // Detach a question from exam
    public function detachQuestion(Exam $exam, Question $question)
    {
        $exam->questions()->detach($question->id);
        return back()->with('success', 'Question removed from exam.');
    }
}