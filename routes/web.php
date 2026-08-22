<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SeatAssignmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;




Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

   Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


   /*
|--------------------------------------------------------------------------
| Students
|--------------------------------------------------------------------------
*/

Route::get('/students', [StudentController::class, 'index'])
    ->name('students.index');

    Route::get('/students/id-cards', [StudentController::class, 'idCards'])
    ->name('students.id-cards');

Route::get('/students/create', [StudentController::class, 'create'])
    ->name('students.create');

Route::post('/students', [StudentController::class, 'store'])
    ->name('students.store');

Route::get('/students/{student}/edit', [StudentController::class, 'edit'])
    ->name('students.edit');

Route::put('/students/{student}', [StudentController::class, 'update'])
    ->name('students.update');

    Route::get('/students/{student}', [StudentController::class, 'show'])
    ->name('students.show');

Route::delete('/students/{student}', [StudentController::class, 'destroy'])
    ->name('students.destroy');

    Route::get('/students/{student}/id-card', [StudentController::class, 'idCard'])
    ->name('students.id-card');

  /*
|--------------------------------------------------------------------------
| Rooms
|--------------------------------------------------------------------------
*/



Route::get('/rooms', [RoomController::class, 'index'])
    ->name('rooms.index');

Route::get('/rooms/create', [RoomController::class, 'create'])
    ->name('rooms.create');

Route::post('/rooms', [RoomController::class, 'store'])
    ->name('rooms.store');

Route::get('/rooms/{room}', [RoomController::class, 'show'])
    ->name('rooms.show');

Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])
    ->name('rooms.edit');

Route::put('/rooms/{room}', [RoomController::class, 'update'])
    ->name('rooms.update');

Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])
    ->name('rooms.destroy');

   /*
|--------------------------------------------------------------------------
| Seats
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/seats', [SeatController::class, 'index'])
        ->name('seats.index');

    Route::post('/seats/generate', [SeatController::class, 'generate'])
        ->name('seats.generate');

        Route::get('/seats/layout', [SeatController::class, 'layout'])
    ->name('seats.layout');

});

/*
|--------------------------------------------------------------------------
| Seat Assignments
|--------------------------------------------------------------------------
*/

Route::get('/seat-assignments', [SeatAssignmentController::class, 'index'])
    ->name('seat-assignments.index');

Route::get('/seat-assignments/create', [SeatAssignmentController::class, 'create'])
    ->name('seat-assignments.create');

Route::post('/seat-assignments', [SeatAssignmentController::class, 'store'])
    ->name('seat-assignments.store');


    Route::patch(
    '/seat-assignments/{seatAssignment}/release',
    [SeatAssignmentController::class, 'release']
)->name('seat-assignments.release');

Route::get(
    '/seat-assignments/{seatAssignment}/change',
    [SeatAssignmentController::class, 'change']
)->name('seat-assignments.change');

Route::patch(
    '/seat-assignments/{seatAssignment}/change',
    [SeatAssignmentController::class, 'updateChange']
)->name('seat-assignments.update-change');

   /*
|--------------------------------------------------------------------------
| Membership Plans
|--------------------------------------------------------------------------
*/



Route::get('/membership-plans', [MembershipPlanController::class, 'index'])
    ->name('membership-plans.index');

Route::get('/membership-plans/create', [MembershipPlanController::class, 'create'])
    ->name('membership-plans.create');

Route::post('/membership-plans', [MembershipPlanController::class, 'store'])
    ->name('membership-plans.store');

Route::get('/membership-plans/{membershipPlan}', [MembershipPlanController::class, 'show'])
    ->name('membership-plans.show');

Route::get('/membership-plans/{membershipPlan}/edit', [MembershipPlanController::class, 'edit'])
    ->name('membership-plans.edit');

Route::put('/membership-plans/{membershipPlan}', [MembershipPlanController::class, 'update'])
    ->name('membership-plans.update');

Route::delete('/membership-plans/{membershipPlan}', [MembershipPlanController::class, 'destroy'])
    ->name('membership-plans.destroy');


   /*
|--------------------------------------------------------------------------
| Memberships
|--------------------------------------------------------------------------
*/

Route::get('/memberships', [MembershipController::class, 'index'])
    ->name('memberships.index');

Route::get('/memberships/create', [MembershipController::class, 'create'])
    ->name('memberships.create');

Route::post('/memberships', [MembershipController::class, 'store'])
    ->name('memberships.store');

    Route::get('/memberships/{membership}/renew', [MembershipController::class, 'renew'])
    ->name('memberships.renew');

Route::post('/memberships/{membership}/renew', [MembershipController::class, 'renewStore'])
    ->name('memberships.renew.store');

    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */



        Route::get('/attendance', [AttendanceController::class, 'index'])
    ->name('attendance.index');

Route::get('/attendance/create', [AttendanceController::class, 'create'])
    ->name('attendance.create');

Route::post('/attendance/check-in', [AttendanceController::class, 'checkIn'])
    ->name('attendance.check-in');

Route::patch('/attendance/{attendanceLog}/check-out', [AttendanceController::class, 'checkOut'])
    ->name('attendance.check-out');

    Route::get(
    '/attendance/student/{student}',
    [AttendanceController::class, 'studentHistory']
)->name('attendance.student-history');

    /*
|--------------------------------------------------------------------------
| Attendance Kiosk
|--------------------------------------------------------------------------
*/

Route::get('/attendance/kiosk', [AttendanceController::class, 'kiosk'])
    ->name('attendance.kiosk');

Route::post('/attendance/kiosk/scan', [AttendanceController::class, 'kioskScan'])
    ->name('attendance.kiosk.scan');

    /*
|--------------------------------------------------------------------------
| Payments
|--------------------------------------------------------------------------
*/

Route::get('/payments', [PaymentController::class, 'index'])
    ->name('payments.index');

Route::get('/payments/create', [PaymentController::class, 'create'])
    ->name('payments.create');

Route::post('/payments', [PaymentController::class, 'store'])
    ->name('payments.store');


    Route::get('/payments/{payment}/receipt', [PaymentController::class, 'receipt'])
    ->name('payments.receipt');

    /*
|--------------------------------------------------------------------------
| Expense Routes
|--------------------------------------------------------------------------
*/

Route::get(
    '/expenses',
    [ExpenseController::class, 'index']
)->name('expenses.index');

Route::get(
    '/expenses/create',
    [ExpenseController::class, 'create']
)->name('expenses.create');

Route::post(
    '/expenses',
    [ExpenseController::class, 'store']
)->name('expenses.store');

Route::get(
    '/expenses/{expense}/edit',
    [ExpenseController::class, 'edit']
)->name('expenses.edit');

Route::put(
    '/expenses/{expense}',
    [ExpenseController::class, 'update']
)->name('expenses.update');

Route::delete(
    '/expenses/{expense}',
    [ExpenseController::class, 'destroy']
)->name('expenses.destroy');

    /*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/

Route::get(
    '/reports',
    [ReportController::class, 'index']
)->name('reports.index');


Route::get('/services', [ServiceController::class, 'index'])
    ->name('services.index');

    Route::get('/services/create', [ServiceController::class, 'create'])
    ->name('services.create');

Route::post('/services', [ServiceController::class, 'store'])
    ->name('services.store');


    });

    require __DIR__.'/settings.php';