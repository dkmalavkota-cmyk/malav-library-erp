<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'library_id',
        'name',
        'code',
        'floor',
        'total_seats',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}