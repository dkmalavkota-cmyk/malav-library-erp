<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'room_id',
        'table_no',
        'seat_number',
        'status',
        'remarks',
        'created_by',
        'updated_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Seat belongs to a Room.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * All Seat Assignments.
     */
    public function assignments()
    {
        return $this->hasMany(SeatAssignment::class);
    }

    /**
     * All Active Assignments.
     * (Morning + Evening + Full Day)
     */
   public function activeAssignments()
{
    return $this->hasMany(SeatAssignment::class)
        ->with([
            'student',
            'membership.plan',
        ])
        ->where('status', 'Active')
        ->whereNull('released_date');
}

    /**
     * Latest Active Assignment.
     * (Backward compatibility)
     */
    public function currentAssignment()
    {
        return $this->hasOne(SeatAssignment::class)
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->latestOfMany();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Check if seat has any active assignment.
     */
    public function getIsOccupiedAttribute(): bool
    {
        return $this->activeAssignments()->exists();
    }

    /**
     * Morning Assignment.
     */
    public function morningAssignment()
    {
        return $this->activeAssignments()
            ->whereHas('membership.plan', function ($query) {
                $query->where('shift', 'Morning');
            })
            ->first();
    }

    /**
     * Evening Assignment.
     */
    public function eveningAssignment()
    {
        return $this->activeAssignments()
            ->whereHas('membership.plan', function ($query) {
                $query->where('shift', 'Evening');
            })
            ->first();
    }

    /**
     * Full Day Assignment.
     */
    public function fullDayAssignment()
    {
        return $this->activeAssignments()
            ->whereHas('membership.plan', function ($query) {
                $query->where('shift', 'Full Day');
            })
            ->first();
    }

    /**
     * Seat Available?
     */
    public function isAvailable(): bool
    {
        return ! $this->is_occupied;
    }
}