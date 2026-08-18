<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'sub_category_id', 'question_text',
        'options', 'correct_option', 'explanation', 'is_premium',
    ];

    protected function casts(): array
    {
        return [
            'options' => 'array',
            'is_premium' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_questions');
    }
}