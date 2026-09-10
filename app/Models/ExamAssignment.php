<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'exam_id',
        'student_id',
        'status',
        'assigned_at',
    ];

    protected $casts = [
        'assigned_at' => 'datetime',
    ];

    /**
     * Library that owns this assignment.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Exam assigned to the student.
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(
            Exam::class,
            'exam_id'
        );
    }

    /**
     * Student receiving the assignment.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }
}