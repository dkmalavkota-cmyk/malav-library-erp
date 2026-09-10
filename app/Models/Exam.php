<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'exam_type',
        'exam_category_id',
        'description',
        'duration_minutes',
        'total_marks',
        'passing_marks',
        'negative_marks',
        'attempt_limit',
        'starts_at',
        'ends_at',
        'is_active',
        'library_id',
        'negative_marking',
        'is_published',
    ];

    protected $casts = [
        'negative_marking' => 'boolean',
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * Exam category.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            ExamCategory::class,
            'exam_category_id'
        );
    }

    /**
     * Questions attached to this exam.
     *
     * Exam -> exam_question -> exam_questions
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(
            ExamQuestion::class,
            'exam_question',
            'exam_id',
            'exam_question_id'
        )
            ->withPivot([
                'sort_order',
                'marks',
                'negative_marks',
            ])
            ->withTimestamps()
            ->orderBy('exam_question.sort_order');
    }

    /**
     * Students assigned to this exam.
     */
    public function assignments(): HasMany
    {
        return $this->hasMany(
            ExamAssignment::class,
            'exam_id'
        );
    }

    /**
     * Library owning this exam.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }
}