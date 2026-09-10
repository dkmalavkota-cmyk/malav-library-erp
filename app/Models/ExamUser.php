<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ExamUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'password',
        'is_active',
        'last_login_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Categories selected by the examination user.
     */
    public function selectedCategories(): BelongsToMany
    {
        return $this->belongsToMany(
            ExamCategory::class,
            'exam_user_categories',
            'exam_user_id',
            'exam_category_id'
        )->withTimestamps();
    }

    /**
     * Libraries to which this examination user has access.
     */
    public function libraryAccess(): HasMany
    {
        return $this->hasMany(
            ExamUserLibraryAccess::class,
            'exam_user_id'
        );
    }

    /**
     * Get currently active library access records.
     */
    public function activeLibraryAccess(): HasMany
    {
        return $this->hasMany(
            ExamUserLibraryAccess::class,
            'exam_user_id'
        )
            ->where('status', 'active')
            ->where(function ($query) {
                $query
                    ->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query
                    ->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            });
    }

    /**
     * Check whether the user currently has access to a library.
     */
    public function hasLibraryAccess(int $libraryId): bool
    {
        return $this->activeLibraryAccess()
            ->where('library_id', $libraryId)
            ->exists();
    }

    /**
     * Get the user's initials.
     */
    public function initials(): string
    {
        return strtoupper(
            substr($this->name ?? 'E', 0, 1)
        );
    }
}