<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'description', 'duration_minutes',
        'positive_mark', 'negative_mark', 'is_premium', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_premium' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'exam_questions');
    }

    public function attempts()
    {
        return $this->hasMany(ExamAttempt::class);
    }
}