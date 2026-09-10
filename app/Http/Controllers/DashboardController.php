<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Membership;
use App\Models\AttendanceLog;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Seat;
use App\Models\SeatAssignment;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\ExamQuestion;

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
        | ONLINE EXAM STATISTICS
        |--------------------------------------------------------------------------
        */

        $totalExamCategories = ExamCategory::where(
            'library_id',
            $libraryId
        )->count();


        $activeExamCategories = ExamCategory::where(
            'library_id',
            $libraryId
        )
            ->where('is_active', true)
            ->count();


        $totalExams = Exam::where(
            'library_id',
            $libraryId
        )->count();


        $publishedExams = Exam::where(
            'library_id',
            $libraryId
        )
            ->where('is_published', true)
            ->where('is_active', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Question Bank
        |--------------------------------------------------------------------------
        |
        | Current implementation stores questions through exam_questions.
        | This count is intentionally library-scoped through the parent exam.
        |
        | Once the reusable Question Bank architecture is introduced,
        | this variable will point to the standalone question-bank table.
        |
        */

      $questionBankCount = ExamQuestion::where(
    'library_id',
    $libraryId
)->count();


        /*
        |--------------------------------------------------------------------------
        | Online Exam Management
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
                'expiringMemberships',

                'totalExamCategories',
                'activeExamCategories',
                'totalExams',
                'publishedExams',
                'questionBankCount'
            )
        );
    }
}