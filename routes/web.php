<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\ExternalExamStudentController;
use App\Http\Controllers\MembershipPlanController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SeatAssignmentController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SaasDashboardController;
use App\Http\Controllers\SaasLibraryController;
use App\Http\Controllers\SaasSubscriptionController;
use App\Http\Controllers\SaasPlanController;
use App\Http\Controllers\PublicPricingController;

use App\Http\Controllers\SaasPaymentController;
use App\Http\Controllers\SaasRenewalController;
use App\Http\Controllers\SaasAnalyticsController;
use App\Http\Controllers\SaasReportController;
use App\Http\Controllers\SaasCustomerController;
use App\Http\Controllers\SaasSettingsController;
use App\Http\Controllers\SubscriptionExpiredController;

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\StudentExamAuthController;
use App\Http\Controllers\StudentExamDashboardController;
use App\Http\Controllers\StudentExamAccountController;
use App\Http\Controllers\StudentExamController;
use App\Http\Controllers\StudentExamAttemptController;
use App\Http\Controllers\ExamUserAuthController;
use App\Http\Controllers\ExamUserDashboardController;
use App\Http\Controllers\ExamUserExamController;
use App\Http\Controllers\ExamUserAttemptController;
use App\Http\Controllers\ExamUserCategoryController;

use App\Http\Controllers\ExamController;
use App\Http\Controllers\CurrentAffairsController;
use App\Http\Controllers\ExaminationDashboardController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamCategoryController;
use App\Http\Controllers\ExamSubjectController;
use App\Http\Controllers\ExamTopicController;
use App\Http\Controllers\ExamQuestionPaperController;
use App\Http\Controllers\ExamAssignmentController;


/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::view('/', 'welcome')->name('home');

Route::get(
    '/pricing',
    [PublicPricingController::class, 'index']
)->name('pricing');


/*
|--------------------------------------------------------------------------
| Student Exam Portal Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam/login',
    [StudentExamAuthController::class, 'showLogin']
)->name('student-exam.login');

Route::post(
    '/exam/login',
    [StudentExamAuthController::class, 'login']
)->name('student-exam.login.store');

Route::post(
    '/exam/logout',
    [StudentExamAuthController::class, 'logout']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.logout');

    /*
|--------------------------------------------------------------------------
| External / Public Exam User Authentication
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam-user/register',
    [ExamUserAuthController::class, 'showRegister']
)->name('exam-user.register');

Route::post(
    '/exam-user/register',
    [ExamUserAuthController::class, 'register']
)->name('exam-user.register.store');

Route::get(
    '/exam-user/login',
    [ExamUserAuthController::class, 'showLogin']
)->name('exam-user.login');

Route::post(
    '/exam-user/login',
    [ExamUserAuthController::class, 'login']
)->name('exam-user.login.store');

Route::post(
    '/exam-user/logout',
    [ExamUserAuthController::class, 'logout']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.logout');

    /*
|--------------------------------------------------------------------------
| External Exam User - Category Selection
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam-user/categories',
    [ExamUserCategoryController::class, 'edit']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.categories.edit');

Route::put(
    '/exam-user/categories',
    [ExamUserCategoryController::class, 'update']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.categories.update');

    /*
|--------------------------------------------------------------------------
| External Exam User Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam-user/dashboard',
    [ExamUserDashboardController::class, 'index']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.dashboard');

    /*
|--------------------------------------------------------------------------
| External Exam User - Exam Details
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam-user/exams/{exam}',
    [ExamUserExamController::class, 'show']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.exam.show');

    /*
|--------------------------------------------------------------------------
| External Exam User - Exam Attempt
|--------------------------------------------------------------------------
*/

Route::post(
    '/exam-user/exams/{exam}/start',
    [ExamUserAttemptController::class, 'start']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.exam.start');

Route::get(
    '/exam-user/exams/{exam}/attempt/{attempt}',
    [ExamUserAttemptController::class, 'attempt']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.exam.attempt');

Route::post(
    '/exam-user/exams/{exam}/attempt/{attempt}/submit',
    [ExamUserAttemptController::class, 'submit']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.exam.submit');

Route::get(
    '/exam-user/exams/{exam}/attempt/{attempt}/result',
    [ExamUserAttemptController::class, 'result']
)
    ->middleware('auth:exam_user')
    ->name('exam-user.exam.result');



/*
|--------------------------------------------------------------------------
| Student Exam Portal Dashboard
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam/dashboard',
    [StudentExamDashboardController::class, 'index']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.dashboard');


/*
|--------------------------------------------------------------------------
| Student Exam Instructions
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam/{exam}/instructions',
    [StudentExamController::class, 'instructions']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.instructions');


/*
|--------------------------------------------------------------------------
| Student Exam Attempt
|--------------------------------------------------------------------------
*/

Route::post(
    '/exam/{exam}/start',
    [StudentExamAttemptController::class, 'start']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.start');

Route::get(
    '/exam/{exam}/attempt/{attempt}',
    [StudentExamAttemptController::class, 'show']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.attempt');


/*
|--------------------------------------------------------------------------
| Student Exam Submit
|--------------------------------------------------------------------------
*/

Route::post(
    '/exam/{exam}/attempt/{attempt}/submit',
    [StudentExamAttemptController::class, 'submit']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.submit');


/*
|--------------------------------------------------------------------------
| Student Exam Result
|--------------------------------------------------------------------------
*/

Route::get(
    '/exam/{exam}/attempt/{attempt}/result',
    [StudentExamAttemptController::class, 'result']
)
    ->middleware('auth:student_exam')
    ->name('student-exam.result');


/*
|--------------------------------------------------------------------------
| Authenticated Library Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Student Exam Accounts
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/students/{student}/exam-account',
        [StudentExamAccountController::class, 'create']
    )->name('students.exam-account.create');

    Route::post(
        '/students/{student}/exam-account',
        [StudentExamAccountController::class, 'store']
    )->name('students.exam-account.store');

    Route::delete(
        '/students/{student}/exam-account',
        [StudentExamAccountController::class, 'destroy']
    )->name('students.exam-account.destroy');


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');

    Route::get(
    '/saas',
    [SaasDashboardController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.dashboard');

    Route::get(
    '/saas/libraries',
    [SaasLibraryController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.libraries.index');

Route::get(
    '/saas/libraries/{library}',
    [SaasLibraryController::class, 'show']
)
    ->middleware('role:Super Admin')
    ->name('saas.libraries.show');


Route::get(
    '/saas/subscriptions',
    [SaasSubscriptionController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.subscriptions.index');

    Route::get(
    '/subscription-expired',
    [SubscriptionExpiredController::class, 'show']
)
    ->middleware('auth')
    ->name('subscription.expired');


/*
|--------------------------------------------------------------------------
| SaaS Plans
|--------------------------------------------------------------------------
*/

Route::get(
    '/saas/plans',
    [SaasPlanController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.plans.index');

Route::get(
    '/saas/plans/create',
    [SaasPlanController::class, 'create']
)
    ->middleware('role:Super Admin')
    ->name('saas.plans.create');

Route::post(
    '/saas/plans',
    [SaasPlanController::class, 'store']
)
    ->middleware('role:Super Admin')
    ->name('saas.plans.store');

Route::get(
    '/saas/plans/{plan}/edit',
    [SaasPlanController::class, 'edit']
)
    ->middleware('role:Super Admin')
    ->name('saas.plans.edit');

Route::put(
    '/saas/plans/{plan}',
    [SaasPlanController::class, 'update']
)
    ->middleware('role:Super Admin')
    ->name('saas.plans.update');

Route::patch(
    '/saas/plans/{plan}/toggle',
    [SaasPlanController::class, 'toggle']
)
    ->middleware('role:Super Admin')
    ->name('saas.plans.toggle');





    Route::get(
    '/saas/payments',
    [SaasPaymentController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.payments.index');

    Route::get(
    '/saas/payments/create',
    [SaasPaymentController::class, 'create']
)
    ->middleware('role:Super Admin')
    ->name('saas.payments.create');

Route::post(
    '/saas/payments',
    [SaasPaymentController::class, 'store']
)
    ->middleware('role:Super Admin')
    ->name('saas.payments.store');

    Route::get(
    '/saas/renewals',
    [SaasRenewalController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.renewals.index');

    Route::post(
    '/saas/renewals/{subscription}',
    [SaasRenewalController::class, 'renew']
)
    ->middleware('role:Super Admin')
    ->name('saas.renewals.renew');


    Route::get(
    '/saas/customers',
    [SaasCustomerController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.customers.index');


// Analytics
Route::get(
    '/saas/analytics',
    [SaasAnalyticsController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.analytics.index');


// Reports
Route::get(
    '/saas/reports',
    [SaasReportController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.reports.index');


// Platform
Route::get(
    '/saas/settings',
    [SaasSettingsController::class, 'index']
)
    ->middleware('role:Super Admin')
    ->name('saas.settings.index');


    Route::get(
    '/saas/subscriptions/create',
    [SaasSubscriptionController::class, 'create']
)
    ->middleware('role:Super Admin')
    ->name('saas.subscriptions.create');

Route::post(
    '/saas/subscriptions',
    [SaasSubscriptionController::class, 'store']
)
    ->middleware('role:Super Admin')
    ->name('saas.subscriptions.store');

    Route::get(
    '/saas/subscriptions/{subscription}/edit',
    [SaasSubscriptionController::class, 'edit']
)
    ->middleware('role:Super Admin')
    ->name('saas.subscriptions.edit');

Route::put(
    '/saas/subscriptions/{subscription}',
    [SaasSubscriptionController::class, 'update']
)
    ->middleware('role:Super Admin')
    ->name('saas.subscriptions.update');


    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/students',
        [StudentController::class, 'index']
    )->name('students.index');

    Route::get(
        '/students/id-cards',
        [StudentController::class, 'idCards']
    )->name('students.id-cards');

    Route::get(
        '/students/create',
        [StudentController::class, 'create']
    )->name('students.create');

    Route::post(
        '/students',
        [StudentController::class, 'store']
    )->name('students.store');

    Route::get(
        '/students/{student}/edit',
        [StudentController::class, 'edit']
    )->name('students.edit');

    Route::put(
        '/students/{student}',
        [StudentController::class, 'update']
    )->name('students.update');

    Route::get(
        '/students/{student}',
        [StudentController::class, 'show']
    )->name('students.show');

    Route::delete(
        '/students/{student}',
        [StudentController::class, 'destroy']
    )->name('students.destroy');

    Route::get(
        '/students/{student}/id-card',
        [StudentController::class, 'idCard']
    )->name('students.id-card');


    /*
    |--------------------------------------------------------------------------
    | Rooms
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/rooms',
        [RoomController::class, 'index']
    )->name('rooms.index');

    Route::get(
        '/rooms/create',
        [RoomController::class, 'create']
    )->name('rooms.create');

    Route::post(
        '/rooms',
        [RoomController::class, 'store']
    )->name('rooms.store');

    Route::get(
        '/rooms/{room}',
        [RoomController::class, 'show']
    )->name('rooms.show');

    Route::get(
        '/rooms/{room}/edit',
        [RoomController::class, 'edit']
    )->name('rooms.edit');

    Route::put(
        '/rooms/{room}',
        [RoomController::class, 'update']
    )->name('rooms.update');

    Route::delete(
        '/rooms/{room}',
        [RoomController::class, 'destroy']
    )->name('rooms.destroy');


    /*
    |--------------------------------------------------------------------------
    | Seats
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/seats',
        [SeatController::class, 'index']
    )->name('seats.index');

    Route::post(
        '/seats/generate',
        [SeatController::class, 'generate']
    )->name('seats.generate');

    Route::get(
        '/seats/layout',
        [SeatController::class, 'layout']
    )->name('seats.layout');


    /*
    |--------------------------------------------------------------------------
    | Seat Assignments
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/seat-assignments',
        [SeatAssignmentController::class, 'index']
    )->name('seat-assignments.index');

    Route::get(
        '/seat-assignments/create',
        [SeatAssignmentController::class, 'create']
    )->name('seat-assignments.create');

    Route::post(
        '/seat-assignments',
        [SeatAssignmentController::class, 'store']
    )->name('seat-assignments.store');

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

    Route::get(
        '/membership-plans',
        [MembershipPlanController::class, 'index']
    )->name('membership-plans.index');

    Route::get(
        '/membership-plans/create',
        [MembershipPlanController::class, 'create']
    )->name('membership-plans.create');

    Route::post(
        '/membership-plans',
        [MembershipPlanController::class, 'store']
    )->name('membership-plans.store');

    Route::get(
        '/membership-plans/{membershipPlan}',
        [MembershipPlanController::class, 'show']
    )->name('membership-plans.show');

    Route::get(
        '/membership-plans/{membershipPlan}/edit',
        [MembershipPlanController::class, 'edit']
    )->name('membership-plans.edit');

    Route::put(
        '/membership-plans/{membershipPlan}',
        [MembershipPlanController::class, 'update']
    )->name('membership-plans.update');

    Route::delete(
        '/membership-plans/{membershipPlan}',
        [MembershipPlanController::class, 'destroy']
    )->name('membership-plans.destroy');


    /*
    |--------------------------------------------------------------------------
    | Memberships
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/memberships',
        [MembershipController::class, 'index']
    )->name('memberships.index');

    Route::get(
        '/memberships/create',
        [MembershipController::class, 'create']
    )->name('memberships.create');

    Route::post(
        '/memberships',
        [MembershipController::class, 'store']
    )->name('memberships.store');

    Route::get(
        '/memberships/{membership}/renew',
        [MembershipController::class, 'renew']
    )->name('memberships.renew');

    Route::post(
        '/memberships/{membership}/renew',
        [MembershipController::class, 'renewStore']
    )->name('memberships.renew.store');


    /*
    |--------------------------------------------------------------------------
    | Attendance
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/attendance',
        [AttendanceController::class, 'index']
    )->name('attendance.index');

    Route::get(
        '/attendance/create',
        [AttendanceController::class, 'create']
    )->name('attendance.create');

    Route::post(
        '/attendance/check-in',
        [AttendanceController::class, 'checkIn']
    )->name('attendance.check-in');

    Route::patch(
        '/attendance/{attendanceLog}/check-out',
        [AttendanceController::class, 'checkOut']
    )->name('attendance.check-out');

    Route::get(
        '/attendance/student/{student}',
        [AttendanceController::class, 'studentHistory']
    )->name('attendance.student-history');


    /*
    |--------------------------------------------------------------------------
    | Attendance Kiosk
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/attendance/kiosk',
        [AttendanceController::class, 'kiosk']
    )->name('attendance.kiosk');

    Route::post(
        '/attendance/kiosk/scan',
        [AttendanceController::class, 'kioskScan']
    )->name('attendance.kiosk.scan');


    /*
    |--------------------------------------------------------------------------
    | Payments
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/payments',
        [PaymentController::class, 'index']
    )->name('payments.index');

    Route::get(
        '/payments/create',
        [PaymentController::class, 'create']
    )->name('payments.create');

    Route::post(
        '/payments',
        [PaymentController::class, 'store']
    )->name('payments.store');

    Route::get(
        '/payments/{payment}/receipt',
        [PaymentController::class, 'receipt']
    )->name('payments.receipt');


    /*
    |--------------------------------------------------------------------------
    | Expenses
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
    | Question Bank - Direct Access
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:question_bank')->group(function () {

        Route::get(
            '/question-bank',
            [ExamQuestionController::class, 'questionBank']
        )->name('question-bank.index');

        Route::get(
            '/question-bank/create',
            [ExamQuestionController::class, 'questionBankCreate']
        )->name('question-bank.create');

        Route::post(
            '/question-bank',
            [ExamQuestionController::class, 'questionBankStore']
        )->name('question-bank.store');

                Route::post(
            '/question-bank/import',
            [ExamQuestionController::class, 'import']
        )->name('question-bank.import');
    });


    Route::get(
    '/question-bank/export',
    [ExamQuestionController::class, 'export']
)->name('question-bank.export');

       /*
    |--------------------------------------------------------------------------
    | Exam Subjects
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:exam')->group(function () {

        Route::get(
            '/exam-subjects',
            [ExamSubjectController::class, 'index']
        )->name('exam-subjects.index');

        Route::get(
            '/exam-subjects/create',
            [ExamSubjectController::class, 'create']
        )->name('exam-subjects.create');

        Route::post(
            '/exam-subjects',
            [ExamSubjectController::class, 'store']
        )->name('exam-subjects.store');

        Route::get(
            '/exam-subjects/{examSubject}',
            [ExamSubjectController::class, 'show']
        )->name('exam-subjects.show');

        Route::get(
            '/exam-subjects/{examSubject}/edit',
            [ExamSubjectController::class, 'edit']
        )->name('exam-subjects.edit');

        Route::put(
            '/exam-subjects/{examSubject}',
            [ExamSubjectController::class, 'update']
        )->name('exam-subjects.update');

        Route::delete(
            '/exam-subjects/{examSubject}',
            [ExamSubjectController::class, 'destroy']
        )->name('exam-subjects.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Exam Topics
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:exam')->group(function () {

        Route::get(
            '/exam-subjects/{examSubject}/topics',
            [ExamTopicController::class, 'index']
        )->name('exam-topics.index');

        Route::get(
            '/exam-subjects/{examSubject}/topics/create',
            [ExamTopicController::class, 'create']
        )->name('exam-topics.create');

        Route::post(
            '/exam-subjects/{examSubject}/topics',
            [ExamTopicController::class, 'store']
        )->name('exam-topics.store');

        Route::get(
            '/exam-subjects/{examSubject}/topics/{examTopic}',
            [ExamTopicController::class, 'show']
        )->name('exam-topics.show');

        Route::get(
            '/exam-subjects/{examSubject}/topics/{examTopic}/edit',
            [ExamTopicController::class, 'edit']
        )->name('exam-topics.edit');

        Route::put(
            '/exam-subjects/{examSubject}/topics/{examTopic}',
            [ExamTopicController::class, 'update']
        )->name('exam-topics.update');

        Route::delete(
            '/exam-subjects/{examSubject}/topics/{examTopic}',
            [ExamTopicController::class, 'destroy']
        )->name('exam-topics.destroy');
    });

      /*
    |--------------------------------------------------------------------------
    | Question Bank Questions
    |--------------------------------------------------------------------------
    | Subject â†’ Topic â†’ Questions
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:question_bank')->group(function () {

        Route::get(
            '/exam-subjects/{subject}/topics/{topic}/questions',
            [ExamQuestionController::class, 'index']
        )->name('exam-questions.index');

        Route::get(
            '/exam-subjects/{subject}/topics/{topic}/questions/create',
            [ExamQuestionController::class, 'create']
        )->name('exam-questions.create');

        Route::post(
            '/exam-subjects/{subject}/topics/{topic}/questions',
            [ExamQuestionController::class, 'store']
        )->name('exam-questions.store');

        Route::get(
            '/exam-subjects/{subject}/topics/{topic}/questions/{question}',
            [ExamQuestionController::class, 'show']
        )->name('exam-questions.show');

        Route::get(
            '/exam-subjects/{subject}/topics/{topic}/questions/{question}/edit',
            [ExamQuestionController::class, 'edit']
        )->name('exam-questions.edit');

        Route::put(
            '/exam-subjects/{subject}/topics/{topic}/questions/{question}',
            [ExamQuestionController::class, 'update']
        )->name('exam-questions.update');

        Route::delete(
            '/exam-subjects/{subject}/topics/{topic}/questions/{question}',
            [ExamQuestionController::class, 'destroy']
        )->name('exam-questions.destroy');
    });

    Route::get(
    '/question-bank/export',
    [ExamQuestionController::class, 'export']
)->name('question-bank.export');


       /*
    |--------------------------------------------------------------------------
    | Exam Categories
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:exam')->group(function () {

        Route::get(
            '/exam-categories',
            [ExamCategoryController::class, 'index']
        )->name('exam-categories.index');

        Route::get(
            '/exam-categories/create',
            [ExamCategoryController::class, 'create']
        )->name('exam-categories.create');

        Route::post(
            '/exam-categories',
            [ExamCategoryController::class, 'store']
        )->name('exam-categories.store');

        Route::get(
            '/exam-categories/{examCategory}/edit',
            [ExamCategoryController::class, 'edit']
        )->name('exam-categories.edit');

        Route::put(
            '/exam-categories/{examCategory}',
            [ExamCategoryController::class, 'update']
        )->name('exam-categories.update');

        Route::delete(
            '/exam-categories/{examCategory}',
            [ExamCategoryController::class, 'destroy']
        )->name('exam-categories.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Current Affairs
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:current_affairs')->group(function () {

        Route::get(
            '/current-affairs',
            [CurrentAffairsController::class, 'index']
        )->name('current-affairs.index');

        Route::get(
            '/current-affairs/create',
            [CurrentAffairsController::class, 'create']
        )->name('current-affairs.create');

        Route::get(
            '/current-affairs/{exam}',
            [CurrentAffairsController::class, 'show']
        )->name('current-affairs.show');

        Route::get(
            '/current-affairs/{exam}/edit',
            [CurrentAffairsController::class, 'edit']
        )->name('current-affairs.edit');
    });




       /*
    |--------------------------------------------------------------------------
    | Examination System
    |--------------------------------------------------------------------------
    */

    Route::middleware('subscription:exam')->group(function () {

        Route::get(
            '/examination',
            [ExaminationDashboardController::class, 'index']
        )->name('examination.dashboard');

                /*
        |--------------------------------------------------------------------------
        | External Examination Students
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/external-exam-students',
            [ExternalExamStudentController::class, 'index']
        )->name('external-exam-students.index');

        Route::get(
            '/external-exam-students/create',
            [ExternalExamStudentController::class, 'create']
        )->name('external-exam-students.create');

        Route::post(
            '/external-exam-students',
            [ExternalExamStudentController::class, 'store']
        )->name('external-exam-students.store');

        Route::get(
            '/external-exam-students/{examUser}',
            [ExternalExamStudentController::class, 'show']
        )->name('external-exam-students.show');

        Route::get(
            '/external-exam-students/{examUser}/edit',
            [ExternalExamStudentController::class, 'edit']
        )->name('external-exam-students.edit');

        Route::put(
            '/external-exam-students/{examUser}',
            [ExternalExamStudentController::class, 'update']
        )->name('external-exam-students.update');

        Route::post(
            '/external-exam-students/{examUser}/revoke',
            [ExternalExamStudentController::class, 'revokeAccess']
        )->name('external-exam-students.revoke');

        Route::post(
            '/external-exam-students/{examUser}/restore',
            [ExternalExamStudentController::class, 'restoreAccess']
        )->name('external-exam-students.restore');

        /*
        |--------------------------------------------------------------------------
        | Exams
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/exams',
            [ExamController::class, 'index']
        )->name('exams.index');

        Route::get(
            '/exams/create',
            [ExamController::class, 'create']
        )->name('exams.create');

        Route::post(
            '/exams',
            [ExamController::class, 'store']
        )->name('exams.store');

        /*
        |--------------------------------------------------------------------------
        | Exam Question Paper
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/exams/{exam}/question-paper',
            [ExamQuestionPaperController::class, 'index']
        )->name('exam-question-paper.index');

        Route::post(
            '/exams/{exam}/question-paper',
            [ExamQuestionPaperController::class, 'store']
        )->name('exam-question-paper.store');

        Route::delete(
            '/exams/{exam}/question-paper/{question}',
            [ExamQuestionPaperController::class, 'destroy']
        )->name('exam-question-paper.destroy');

        Route::post(
            '/exams/{exam}/question-paper/reorder',
            [ExamQuestionPaperController::class, 'reorder']
        )->name('exam-question-paper.reorder');

        /*
        |--------------------------------------------------------------------------
        | Exam Assignments
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/exams/{exam}/assignments',
            [ExamAssignmentController::class, 'index']
        )->name('exam-assignments.index');

        Route::post(
            '/exams/{exam}/assignments',
            [ExamAssignmentController::class, 'store']
        )->name('exam-assignments.store');

        Route::delete(
            '/exams/{exam}/assignments/{assignment}',
            [ExamAssignmentController::class, 'destroy']
        )->name('exam-assignments.destroy');

        /*
        |--------------------------------------------------------------------------
        | Exam Results
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/exams/{exam}/results',
            [ExamController::class, 'results']
        )->name('exams.results');

        Route::get(
            '/exams/{exam}/results/{attempt}',
            [ExamController::class, 'attemptResult']
        )->name('exams.attempt-result');

        /*
        |--------------------------------------------------------------------------
        | Exam CRUD
        |--------------------------------------------------------------------------
        */

        Route::get(
            '/exams/{exam}',
            [ExamController::class, 'show']
        )->name('exams.show');

        Route::get(
            '/exams/{exam}/edit',
            [ExamController::class, 'edit']
        )->name('exams.edit');

        Route::put(
            '/exams/{exam}',
            [ExamController::class, 'update']
        )->name('exams.update');

        Route::delete(
            '/exams/{exam}',
            [ExamController::class, 'destroy']
        )->name('exams.destroy');
    });




    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');


    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/services',
        [ServiceController::class, 'index']
    )->name('services.index');

    Route::get(
        '/services/create',
        [ServiceController::class, 'create']
    )->name('services.create');

    Route::post(
        '/services',
        [ServiceController::class, 'store']
    )->name('services.store');
});


require __DIR__ . '/settings.php';
