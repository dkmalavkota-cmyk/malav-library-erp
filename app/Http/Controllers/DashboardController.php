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
        | Basic Statistics
        |--------------------------------------------------------------------------
        */

        $totalStudents = Student::count();

        $activeMemberships = Membership::where(
            'status',
            'Active'
        )->count();

        $todayAttendance = AttendanceLog::whereDate(
            'created_at',
            today()
        )->count();

        $todayCollection = Payment::whereDate(
            'created_at',
            today()
        )->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Seat Statistics
        |--------------------------------------------------------------------------
        */

        $totalSeats = Seat::count();

        $occupiedSeats = SeatAssignment::where(
                'status',
                'Active'
            )
            ->whereNull('released_date')
            ->count();

        $availableSeats = max(
            0,
            $totalSeats - $occupiedSeats
        );


        /*
        |--------------------------------------------------------------------------
        | Today's Expense
        |--------------------------------------------------------------------------
        */

        $todayExpense = Expense::whereDate(
            'expense_date',
            today()
        )->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Expiring Memberships
        |--------------------------------------------------------------------------
        */

        $expiringMemberships = Membership::where(
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

        return view('dashboard', compact(
            'totalStudents',
            'activeMemberships',
            'todayAttendance',
            'todayCollection',
            'totalSeats',
            'occupiedSeats',
            'availableSeats',
            'todayExpense',
            'expiringMemberships'
        ));
    }
}