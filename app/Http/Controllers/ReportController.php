<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Expense;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display reports dashboard.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        /*
        |--------------------------------------------------------------------------
        | Date Range
        |--------------------------------------------------------------------------
        */

        $fromDate = $request->input(
            'from_date',
            now()->startOfMonth()->format('Y-m-d')
        );

        $toDate = $request->input(
            'to_date',
            now()->format('Y-m-d')
        );


        /*
        |--------------------------------------------------------------------------
        | Collection
        |--------------------------------------------------------------------------
        */

        $totalCollection = Payment::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'payment_date',
                [$fromDate, $toDate]
            )
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Expenses
        |--------------------------------------------------------------------------
        */

        $totalExpense = Expense::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'expense_date',
                [$fromDate, $toDate]
            )
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Net Collection
        |--------------------------------------------------------------------------
        */

        $netCollection =
            $totalCollection - $totalExpense;


        /*
        |--------------------------------------------------------------------------
        | Payment Count
        |--------------------------------------------------------------------------
        */

        $paymentCount = Payment::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'payment_date',
                [$fromDate, $toDate]
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Expense Count
        |--------------------------------------------------------------------------
        */

        $expenseCount = Expense::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'expense_date',
                [$fromDate, $toDate]
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | New Students
        |--------------------------------------------------------------------------
        */

        $newStudents = Student::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'joining_date',
                [$fromDate, $toDate]
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | New Memberships
        |--------------------------------------------------------------------------
        */

        $newMemberships = Membership::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'start_date',
                [$fromDate, $toDate]
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Attendance
        |--------------------------------------------------------------------------
        */

        $attendanceCount = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'attendance_date',
                [$fromDate, $toDate]
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Payment Mode Summary
        |--------------------------------------------------------------------------
        */

        $paymentModes = Payment::selectRaw(
                'payment_mode, SUM(amount) as total'
            )
            ->where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'payment_date',
                [$fromDate, $toDate]
            )
            ->groupBy('payment_mode')
            ->orderByDesc('total')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Expense Category Summary
        |--------------------------------------------------------------------------
        */

        $expenseCategories = Expense::selectRaw(
                'category, SUM(amount) as total'
            )
            ->where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'expense_date',
                [$fromDate, $toDate]
            )
            ->groupBy('category')
            ->orderByDesc('total')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Payments
        |--------------------------------------------------------------------------
        */

        $recentPayments = Payment::with([
                'student',
                'membership.plan',
            ])
            ->where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'payment_date',
                [$fromDate, $toDate]
            )
            ->latest('payment_date')
            ->latest('id')
            ->limit(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Expenses
        |--------------------------------------------------------------------------
        */

        $recentExpenses = Expense::where(
                'library_id',
                $libraryId
            )
            ->whereBetween(
                'expense_date',
                [$fromDate, $toDate]
            )
            ->latest('expense_date')
            ->latest('id')
            ->limit(10)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Send Data To View
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.index',
            compact(
                'fromDate',
                'toDate',
                'totalCollection',
                'totalExpense',
                'netCollection',
                'paymentCount',
                'expenseCount',
                'newStudents',
                'newMemberships',
                'attendanceCount',
                'paymentModes',
                'expenseCategories',
                'recentPayments',
                'recentExpenses'
            )
        );
    }
}