<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExamQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'subject_id',
        'topic_id',
        'question_text',
        'question_type',
        'explanation',
        'marks',
        'negative_marks',
        'difficulty',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'question_type' => 'string',
        'marks' => 'decimal:2',
        'negative_marks' => 'decimal:2',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Library.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Subject.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            ExamSubject::class,
            'subject_id'
        );
    }

    /**
     * Topic.
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(
            ExamTopic::class,
            'topic_id'
        );
    }

    /**
     * Question options.
     */
    public function options(): HasMany
    {
        return $this->hasMany(
            ExamQuestionOption::class,
            'exam_question_id'
        )->orderBy('sort_order');
    }

    /**
     * Correct options.
     */
    public function correctOptions(): HasMany
    {
        return $this->hasMany(
            ExamQuestionOption::class,
            'exam_question_id'
        )->where('is_correct', true);
    }

    /**
     * Exams using this question.
     */
    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(
            Exam::class,
            'exam_question',
            'exam_question_id',
            'exam_id'
        )
            ->withPivot([
                'sort_order',
                'marks',
                'negative_marks',
            ])
            ->withTimestamps()
            ->orderBy('exam_question.sort_order');
    }
}