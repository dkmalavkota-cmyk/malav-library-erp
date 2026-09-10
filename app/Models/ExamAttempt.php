<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'exam_id',
        'student_id',
        'exam_user_id',
        'attempt_number',
        'status',
        'started_at',
        'submitted_at',
        'expires_at',
        'total_marks',
        'obtained_marks',
        'correct_answers',
        'wrong_answers',
        'unanswered',
        'is_passed',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'submitted_at' => 'datetime',
        'expires_at' => 'datetime',
        'total_marks' => 'decimal:2',
        'obtained_marks' => 'decimal:2',
        'is_passed' => 'boolean',
    ];

    /**
     * Library that owns this attempt.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Exam being attempted.
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(
            Exam::class,
            'exam_id'
        );
    }

    /**
     * Library student making this attempt.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }

    /**
     * External/public exam user making this attempt.
     */
    public function examUser(): BelongsTo
    {
        return $this->belongsTo(
            ExamUser::class,
            'exam_user_id'
        );
    }

    /**
     * Answers submitted in this attempt.
     */
    public function answers(): HasMany
    {
        return $this->hasMany(
            ExamAttemptAnswer::class,
            'exam_attempt_id'
        );
    }

    /**
     * Check whether the attempt is currently running.
     */
    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    /**
     * Check whether the attempt has expired.
     */
    public function hasExpired(): bool
    {
        return $this->expires_at !== null
            && now()->greaterThanOrEqualTo($this->expires_at);
    }

    /**
     * Check whether the attempt is completed.
     */
    public function isCompleted(): bool
    {
        return in_array(
            $this->status,
            [
                'submitted',
                'expired',
            ],
            true
        );
    }
}