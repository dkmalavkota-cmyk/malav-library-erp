<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class ExamTopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'subject_id',
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
     * Library this topic belongs to.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Subject this topic belongs to.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            ExamSubject::class,
            'subject_id'
        );
    }

    /**
     * Questions belonging to this topic.
     */
    public function questions(): HasMany
    {
        return $this->hasMany(
            ExamQuestion::class,
            'topic_id'
        )->orderBy('sort_order');
    }

    /**
     * Generate a unique slug inside a subject.
     */
    public static function makeSlug(
        string $name,
        int $subjectId,
        ?int $ignoreId = null
    ): string {
        $baseSlug = Str::slug($name);

        $slug = $baseSlug;
        $counter = 2;

        while (
            static::where('subject_id', $subjectId)
                ->where('slug', $slug)
                ->when(
                    $ignoreId,
                    fn ($query) => $query->where(
                        'id',
                        '!=',
                        $ignoreId
                    )
                )
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}