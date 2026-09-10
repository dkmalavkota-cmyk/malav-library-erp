<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'library_id',
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

    /**
     * Generate student code automatically.
     */
    protected static function booted(): void
    {
        static::creating(function ($student) {

            if (empty($student->student_code)) {

                $library = $student->library_id
                    ? Library::find($student->library_id)
                    : null;

                $prefix = $library?->student_prefix ?: 'LIB';

                $lastId = (
                    DB::table('students')
                        ->where('library_id', $student->library_id)
                        ->max('id')
                    ?? 0
                ) + 1;

                $student->student_code =
                    strtoupper($prefix) .
                    str_pad(
                        $lastId,
                        6,
                        '0',
                        STR_PAD_LEFT
                    );
            }
        });
    }

    /**
     * Library this student belongs to.
     */
    public function library(): BelongsTo
    {
        return $this->belongsTo(
            Library::class,
            'library_id'
        );
    }

    /**
     * Student memberships.
     */
    public function memberships(): HasMany
    {
        return $this->hasMany(
            Membership::class,
            'student_id'
        );
    }

    /**
     * Student seat assignments.
     */
    public function seatAssignments(): HasMany
    {
        return $this->hasMany(
            SeatAssignment::class,
            'student_id'
        );
    }

    /**
     * Student payments.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(
            Payment::class,
            'student_id'
        );
    }

    /**
     * Student attendance logs.
     */
    public function attendanceLogs(): HasMany
    {
        return $this->hasMany(
            AttendanceLog::class,
            'student_id'
        );
    }

    /**
     * Exam assignments received by this student.
     */
    public function examAssignments(): HasMany
    {
        return $this->hasMany(
            ExamAssignment::class,
            'student_id'
        );
    }

    /**
     * Full name accessor.
     */
    public function getFullNameAttribute(): string
    {
        return trim(
            $this->first_name . ' ' . $this->last_name
        );
    }

    /**
     * Online examination account.
     *
     * One student can have one exam portal account.
     */
    public function examAccount(): HasOne
    {
        return $this->hasOne(
            StudentExamAccount::class,
            'student_id'
        );
    }
}