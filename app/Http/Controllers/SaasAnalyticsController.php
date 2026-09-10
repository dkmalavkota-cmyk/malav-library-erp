<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use App\Models\Library;
use App\Models\Student;
use Illuminate\View\View;

class SaasAnalyticsController extends Controller
{
    /**
     * Platform-wide SaaS usage analytics.
     */
    public function index(): View
    {
        $summary = [
            'libraries' => Library::query()->count(),

            'students' => Student::query()->count(),

            'exam_students' => Student::query()
                ->whereHas('examAccount')
                ->count(),

            'exams' => Exam::query()->count(),

            'questions' => ExamQuestion::query()->count(),

            'attempts' => ExamAttempt::query()->count(),
        ];

        $libraryUsage = Library::query()
            ->orderByDesc('id')
            ->get()
            ->map(function (Library $library) {
                return [
                    'library' => $library,

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
                ];
            });

        return view('saas.analytics.index', [
            'summary' => $summary,
            'libraryUsage' => $libraryUsage,
        ]);
    }
}