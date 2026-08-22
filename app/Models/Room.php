<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'floor',
        'total_seats',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}