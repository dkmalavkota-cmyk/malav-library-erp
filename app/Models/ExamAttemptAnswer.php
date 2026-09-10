<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamAttemptAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'exam_attempt_id',
        'exam_question_id',
        'selected_option_id',
        'is_answered',
        'is_correct',
        'marks_awarded',
        'answered_at',
    ];

    protected $casts = [
        'is_answered' => 'boolean',
        'is_correct' => 'boolean',
        'marks_awarded' => 'decimal:2',
        'answered_at' => 'datetime',
    ];

    /**
     * Library that owns this answer.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Exam attempt.
     */
    public function attempt(): BelongsTo
    {
        return $this->belongsTo(
            ExamAttempt::class,
            'exam_attempt_id'
        );
    }

    /**
     * Question being answered.
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(
            ExamQuestion::class,
            'exam_question_id'
        );
    }

    /**
     * Selected option.
     */
    public function selectedOption(): BelongsTo
    {
        return $this->belongsTo(
            ExamQuestionOption::class,
            'selected_option_id'
        );
    }
}