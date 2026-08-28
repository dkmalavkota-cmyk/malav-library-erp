<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Membership;
use App\Models\AttendanceLog;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Seat;
use App\Models\SeatAssignment;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        /*
        |--------------------------------------------------------------------------
        | Basic Statistics
        |--------------------------------------------------------------------------
        */

        $totalStudents = Student::where(
            'library_id',
            $libraryId
        )->count();


        $activeMemberships = Membership::where(
                'library_id',
                $libraryId
            )
            ->where(
                'status',
                'Active'
            )
            ->count();


        $todayAttendance = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'attendance_date',
                today()
            )
            ->count();


        $todayCollection = Payment::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'payment_date',
                today()
            )
            ->sum('amount');


/*
|--------------------------------------------------------------------------
| Seat Statistics
|--------------------------------------------------------------------------
*/

$totalSeats = Seat::where(
    'library_id',
    $libraryId
)->count();


/*
|--------------------------------------------------------------------------
| Assigned Seat Statistics
|--------------------------------------------------------------------------
|
| Any seat having at least one active assignment is counted
| as occupied/assigned on the dashboard.
|
| Morning only      = 1
| Evening only      = 1
| Full Day          = 1
| Morning + Evening = 1
|
*/

$activeAssignments = SeatAssignment::where(
        'library_id',
        $libraryId
    )
    ->where(
        'status',
        'Active'
    )
    ->whereNull('released_date')
    ->get();


$occupiedSeatIds = $activeAssignments
    ->pluck('seat_id')
    ->unique();


$occupiedSeats = $occupiedSeatIds->count();


$availableSeats = max(
    0,
    $totalSeats - $occupiedSeats
);


        /*
        |--------------------------------------------------------------------------
        | Today's Expense
        |--------------------------------------------------------------------------
        */

        $todayExpense = Expense::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'expense_date',
                today()
            )
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Expiring Memberships
        |--------------------------------------------------------------------------
        */

        $expiringMemberships = Membership::where(
                'library_id',
                $libraryId
            )
            ->where(
                'status',
                'Active'
            )
            ->whereBetween(
                'end_date',
                [
                    today(),
                    today()->copy()->addDays(7),
                ]
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Send Data To Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
    'dashboard',
    compact(
        'totalStudents',
        'activeMemberships',
        'todayAttendance',
        'todayCollection',
        'totalSeats',
        'occupiedSeats',
        'availableSeats',
        'todayExpense',
        'expiringMemberships'
    )
);
    }
}