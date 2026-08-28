<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'library_id',
        'student_id',
        'membership_plan_id',
        'start_date',
        'end_date',
        'amount',
        'discount',
        'final_amount',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function plan()
    {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id');
    }

    public function seatAssignments()
    {
        return $this->hasMany(SeatAssignment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}