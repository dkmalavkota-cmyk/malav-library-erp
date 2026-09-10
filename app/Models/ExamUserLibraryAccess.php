<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamUserLibraryAccess extends Model
{
    use HasFactory;

    protected $table = 'exam_user_library_access';

    protected $fillable = [
        'exam_user_id',
        'library_id',
        'status',
        'access_type',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    /**
     * Public examination user.
     */
    public function examUser(): BelongsTo
    {
        return $this->belongsTo(
            ExamUser::class,
            'exam_user_id'
        );
    }

    /**
     * Library to which access belongs.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Check whether access is currently active.
     */
    public function isCurrentlyActive(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        if ($this->starts_at !== null && now()->lt($this->starts_at)) {
            return false;
        }

        if ($this->ends_at !== null && now()->gt($this->ends_at)) {
            return false;
        }

        return true;
    }
}