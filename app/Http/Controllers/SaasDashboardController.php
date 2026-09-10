<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use App\Models\Library;
use App\Models\SaasPayment;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SaasDashboardController extends Controller
{
    /**
     * Super Admin SaaS dashboard.
     */
    public function index(Request $request)
    {
        $libraries = Library::query()
            ->with([
                'users' => fn ($query) => $query
                    ->select([
                        'id',
                        'library_id',
                        'name',
                        'email',
                    ])
                    ->orderBy('id'),
                'subscriptions' => fn ($query) => $query
                    ->latest('ends_at'),
            ])
            ->orderByDesc('id')
            ->get();

        $libraryStats = $libraries->map(function (Library $library) {
            $latestSubscription = $library->subscriptions->first();

            $totalStudents = Student::query()
                ->where('library_id', $library->id)
                ->count();

            $onlineExamStudents = Student::query()
                ->where('library_id', $library->id)
                ->whereHas('examAccount')
                ->count();

            $totalExams = Exam::query()
                ->where('library_id', $library->id)
                ->count();

            $totalQuestions = ExamQuestion::query()
                ->where('library_id', $library->id)
                ->count();

            $totalAttempts = ExamAttempt::query()
                ->where('library_id', $library->id)
                ->count();

            $totalPaid = SaasPayment::query()
                ->where('library_id', $library->id)
                ->where('status', 'paid')
                ->sum('amount');

            return [
                'library' => $library,
                'owner' => $library->users->first(),
                'latest_subscription' => $latestSubscription,

                'total_students' => $totalStudents,
                'online_exam_students' => $onlineExamStudents,
                'total_exams' => $totalExams,
                'total_questions' => $totalQuestions,
                'total_attempts' => $totalAttempts,

                'total_paid' => $totalPaid,
            ];
        });

        $summary = [
            'total_libraries' => $libraries->count(),

            'active_libraries' => $libraries
                ->where('status', 'active')
                ->count(),

            'total_students' => Student::count(),

            'total_exams' => Exam::count(),

            'total_questions' => ExamQuestion::count(),

            'total_attempts' => ExamAttempt::count(),

            'total_revenue' => SaasPayment::query()
                ->where('status', 'paid')
                ->sum('amount'),

            'active_subscriptions' => Subscription::query()
                ->whereIn('status', ['trial', 'active'])
                ->count(),
        ];

        return view('saas.dashboard', [
            'summary' => $summary,
            'libraryStats' => $libraryStats,
        ]);
    }
}