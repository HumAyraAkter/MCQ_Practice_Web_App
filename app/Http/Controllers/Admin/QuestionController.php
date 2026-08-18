<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::with('category', 'subCategory');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $questions = $query->latest()->paginate(20);
        $categories = Category::all();

        return view('admin.questions.index', compact('questions', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.questions.create', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string',
            'is_premium' => 'nullable|boolean',
        ]);

        Question::create([
            'category_id' => $validated['category_id'],
            'sub_category_id' => $validated['sub_category_id'] ?? null,
            'question_text' => $validated['question_text'],
            'options' => [
                'A' => $validated['option_a'],
                'B' => $validated['option_b'],
                'C' => $validated['option_c'],
                'D' => $validated['option_d'],
            ],
            'correct_option' => $validated['correct_option'],
            'explanation' => $validated['explanation'] ?? null,
            'is_premium' => $request->boolean('is_premium'),
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Question added successfully.');
    }

    public function edit(Question $question)
    {
        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.questions.edit', compact('question', 'categories', 'subCategories'));
    }

    public function update(Request $request, Question $question)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'question_text' => 'required|string',
            'option_a' => 'required|string',
            'option_b' => 'required|string',
            'option_c' => 'required|string',
            'option_d' => 'required|string',
            'correct_option' => 'required|in:A,B,C,D',
            'explanation' => 'nullable|string',
            'is_premium' => 'nullable|boolean',
        ]);

        $question->update([
            'category_id' => $validated['category_id'],
            'sub_category_id' => $validated['sub_category_id'] ?? null,
            'question_text' => $validated['question_text'],
            'options' => [
                'A' => $validated['option_a'],
                'B' => $validated['option_b'],
                'C' => $validated['option_c'],
                'D' => $validated['option_d'],
            ],
            'correct_option' => $validated['correct_option'],
            'explanation' => $validated['explanation'] ?? null,
            'is_premium' => $request->boolean('is_premium'),
        ]);

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success', 'Question deleted successfully.');
    }

   public function bulkForm()
{
    $categories = Category::all();
    $subCategories = SubCategory::all();
    $exams = Exam::orderBy('title')->get();

    return view('admin.questions.bulk-create', compact('categories', 'subCategories', 'exams'));
}

public function bulkStore(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'nullable|exists:sub_categories,id',
        'exam_id' => 'nullable|exists:exams,id',
        'raw_text' => 'required|string',
    ]);

    $blocks = preg_split('/(?=^Q:)/mi', trim($request->raw_text));

    $created = 0;
    $skipped = [];

    DB::transaction(function () use ($blocks, $request, &$created, &$skipped) {
        foreach ($blocks as $index => $block) {
            $block = trim($block);
            if ($block === '') continue;

            preg_match('/Q:\s*(.+)/i', $block, $q);
            preg_match('/A\)\s*(.+)/i', $block, $a);
            preg_match('/B\)\s*(.+)/i', $block, $b);
            preg_match('/C\)\s*(.+)/i', $block, $c);
            preg_match('/D\)\s*(.+)/i', $block, $d);
            preg_match('/Answer:\s*([ABCD])/i', $block, $ans);
            preg_match('/Explanation:\s*(.+)/i', $block, $exp);

            if (!$q || !$a || !$b || !$c || !$d || !$ans) {
                $skipped[] = $index + 1;
                continue;
            }

            $question = Question::create([
                'category_id' => $request->category_id,
                'sub_category_id' => $request->sub_category_id,
                'question_text' => trim($q[1]),
                'options' => [
                    'A' => trim($a[1]),
                    'B' => trim($b[1]),
                    'C' => trim($c[1]),
                    'D' => trim($d[1]),
                ],
                'correct_option' => strtoupper($ans[1]),
                'explanation' => $exp[1] ?? null,
                'is_premium' => $request->boolean('is_premium'),
            ]);

            // Exam select kora thakle, tokhoni attach kore dewa
            if ($request->filled('exam_id')) {
                $question->exams()->syncWithoutDetaching([$request->exam_id]);
            }

            $created++;
        }
    });

    $message = "{$created} টা প্রশ্ন সফলভাবে যোগ হয়েছে।";
    if ($request->filled('exam_id')) {
        $message .= ' এবং নির্বাচিত exam-এর সাথে attach করা হয়েছে।';
    }
    if (count($skipped)) {
        $message .= ' ফরম্যাট ভুলের কারণে #' . implode(', #', $skipped) . ' নাম্বার ব্লক স্কিপ করা হয়েছে।';
    }

    return redirect()->route('admin.questions.index')->with('success', $message);
}
}