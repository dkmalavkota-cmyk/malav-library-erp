<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ExamCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'name',
        'slug',
        'description',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Library that owns this category.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    /**
     * Exams inside this category.
     */
    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class, 'exam_category_id');
    }

    /**
     * Generate a clean slug.
     */
    public static function makeSlug(string $name, int $libraryId, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 2;

        while (
            static::where('library_id', $libraryId)
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where('id', '!=', $ignoreId)
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}