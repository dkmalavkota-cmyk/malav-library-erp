<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_code',
        'photo',
        'first_name',
        'last_name',
        'father_name',
        'mobile',
        'whatsapp',
        'email',
        'gender',
        'dob',
        'aadhaar_number',
        'address',
        'city',
        'state',
        'college',
        'course',
        'preparing_for',
        'joining_date',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'dob' => 'date',
        'joining_date' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function ($student) {

            if (empty($student->student_code)) {

                $lastId = (DB::table('students')->max('id') ?? 0) + 1;

                $student->student_code = 'ML' . str_pad($lastId, 6, '0', STR_PAD_LEFT);
            }
        });
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function seatAssignments()
    {
        return $this->hasMany(SeatAssignment::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }

    /**
 * Full Name Accessor
 */
public function getFullNameAttribute(): string
{
    return trim($this->first_name . ' ' . $this->last_name);
}
}