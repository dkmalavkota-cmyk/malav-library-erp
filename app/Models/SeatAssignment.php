<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeatAssignment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'seat_id',
        'membership_id',
        'assigned_date',
        'released_date',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'assigned_date' => 'date',
        'released_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}