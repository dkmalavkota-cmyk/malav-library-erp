<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaasPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'library_id',
        'subscription_id',
        'amount',
        'currency',
        'payment_method',
        'transaction_id',
        'status',
        'paid_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    public function library(): BelongsTo
    {
        return $this->belongsTo(Library::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }
}