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
use Illuminate\View\View;

class SaasReportController extends Controller
{
    /**
     * Central SaaS reporting dashboard for Super Admin.
     */
    public function index(Request $request): View
    {
        $libraries = Library::query()
            ->with([
                'subscriptions' => fn ($query) => $query
                    ->latest('ends_at'),
            ])
            ->orderByDesc('id')
            ->get();

        $libraryReports = $libraries->map(function (Library $library) {
            $latestSubscription = $library->subscriptions->first();

            return [
                'library' => $library,
                'subscription' => $latestSubscription,

                'students' => Student::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'exam_students' => Student::query()
                    ->where('library_id', $library->id)
                    ->whereHas('examAccount')
                    ->count(),

                'exams' => Exam::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'questions' => ExamQuestion::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'attempts' => ExamAttempt::query()
                    ->where('library_id', $library->id)
                    ->count(),

                'revenue' => SaasPayment::query()
                    ->where('library_id', $library->id)
                    ->where('status', 'paid')
                    ->sum('amount'),
            ];
        });

        $summary = [
            'libraries' => Library::query()->count(),

            'students' => Student::query()->count(),

            'exams' => Exam::query()->count(),

            'questions' => ExamQuestion::query()->count(),

            'attempts' => ExamAttempt::query()->count(),

            'revenue' => SaasPayment::query()
                ->where('status', 'paid')
                ->sum('amount'),

            'pending_revenue' => SaasPayment::query()
                ->where('status', 'pending')
                ->sum('amount'),

            'subscriptions' => Subscription::query()->count(),

            'active_subscriptions' => Subscription::query()
                ->whereIn('status', ['trial', 'active'])
                ->count(),

            'expired_subscriptions' => Subscription::query()
                ->where(function ($query) {
                    $query
                        ->where('status', 'expired')
                        ->orWhereDate('ends_at', '<', now()->toDateString());
                })
                ->count(),
        ];

        return view('saas.reports.index', [
            'libraryReports' => $libraryReports,
            'summary' => $summary,
        ]);
    }
}