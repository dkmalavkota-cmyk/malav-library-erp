<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    protected $fillable = [
        'library_id',
        'plan_id',
        'plan_name',
        'billing_cycle',
        'starts_at',
        'ends_at',
        'status',
        'amount',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'date',
            'ends_at' => 'date',
            'amount' => 'decimal:2',
        ];
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(SaasPayment::class);
    }
}