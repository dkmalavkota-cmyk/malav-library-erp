<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentExamAccount extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'student_id',
        'email',
        'password',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's initials.
     */
    public function initials(): string
    {
        return strtoupper(
            substr($this->student?->first_name ?? 'S', 0, 1)
        );
    }

    /**
     * Student linked with this exam account.
     */
    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}