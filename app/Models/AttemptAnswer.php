<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttemptAnswer extends Model
{
    protected $fillable = [
        'exam_attempt_id', 'question_id', 'selected_option', 'is_correct',
    ];

    protected function casts(): array
    {
        return ['is_correct' => 'boolean'];
    }

    public function attempt()
    {
        return $this->belongsTo(ExamAttempt::class, 'exam_attempt_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}