<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Library extends Model
{
    protected $table = 'libraries';

    protected $fillable = [
        'name',
        'code',
        'logo',
        'address',
        'city',
        'state',
        'country',
        'phone',
        'whatsapp',
        'email',
        'website',
        'opening_time',
        'closing_time',
        'sunday_open',
        'currency',
        'student_prefix',
        'status',
    ];

    protected $casts = [
        'sunday_open' => 'boolean',
        'opening_time' => 'datetime:H:i',
        'closing_time' => 'datetime:H:i',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}