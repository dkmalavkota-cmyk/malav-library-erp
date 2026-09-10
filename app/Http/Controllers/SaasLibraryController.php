<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use App\Models\Library;
use App\Models\SaasPayment;
use App\Models\Student;
use App\Models\Subscription;
use Illuminate\View\View;

class SaasLibraryController extends Controller
{
    /**
     * Show all registered SaaS libraries.
     */
    public function index(): View
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

            return [
                'library' => $library,
                'owner' => $library->users->first(),
                'latest_subscription' => $latestSubscription,

                'total_students' => Student::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'online_exam_students' => Student::query()
                    ->where('library_id', $library->id)
                    ->whereHas('examAccount')
                    ->count(),

                'total_exams' => Exam::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'total_questions' => ExamQuestion::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'total_attempts' => ExamAttempt::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'total_paid' => SaasPayment::query()
                    ->where('library_id', $library->id)
                    ->where('status', 'paid')
                    ->sum('amount'),
            ];
        });

        return view('saas.libraries.index', [
            'libraryStats' => $libraryStats,
        ]);
    }

    /**
     * Show complete SaaS information for one library.
     */
    public function show(Library $library): View
    {
        $library->load([
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

            'saasPayments' => fn ($query) => $query
                ->with('subscription')
                ->latest(),
        ]);

        $stats = [
            'total_students' => Student::query()
                ->where('library_id', $library->id)
                ->count(),

            'online_exam_students' => Student::query()
                ->where('library_id', $library->id)
                ->whereHas('examAccount')
                ->count(),

            'total_exams' => Exam::query()
                ->where('library_id', $library->id)
                ->count(),

            'total_questions' => ExamQuestion::query()
                ->where('library_id', $library->id)
                ->count(),

            'total_attempts' => ExamAttempt::query()
                ->where('library_id', $library->id)
                ->count(),

            'total_paid' => SaasPayment::query()
                ->where('library_id', $library->id)
                ->where('status', 'paid')
                ->sum('amount'),
        ];

        return view('saas.libraries.show', [
            'library' => $library,
            'owner' => $library->users->first(),
            'latestSubscription' => $library->subscriptions->first(),
            'stats' => $stats,
        ]);
    }
}