<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentExamDashboardController extends Controller
{
    /**
     * Student Exam Portal Dashboard.
     */
    public function index()
    {
        $account = Auth::guard('student_exam')->user();

        abort_unless($account, 401);

        $account->load('student');

        $student = $account->student;

        abort_unless($student, 403);

        $libraryId = $student->library_id;

        /*
        |--------------------------------------------------------------------------
        | Assigned Exams
        |--------------------------------------------------------------------------
        |
        | Existing assigned/private exam system remains unchanged.
        |
        */

        $assignments = ExamAssignment::with([
            'exam.category',
        ])
            ->where('student_id', $student->id)
            ->where('library_id', $libraryId)
            ->where('status', '!=', 'cancelled')
            ->whereHas('exam', function ($query) use ($libraryId) {
                $query
                    ->where('library_id', $libraryId)
                    ->where('is_active', true)
                    ->where('is_published', true);
            })
            ->latest('assigned_at')
            ->get();

        $assignedExams = $assignments
            ->map(function ($assignment) {
                return $assignment->exam;
            })
            ->filter()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | ALL Current Affairs Exams
        |--------------------------------------------------------------------------
        |
        | Current Affairs are library-wide.
        | They do not require ExamAssignment.
        |
        */

        $allCurrentAffairsExams = Exam::with('category')
            ->withCount('questions')
            ->where('library_id', $libraryId)
            ->where('exam_type', 'current_affairs')
            ->where('is_active', true)
            ->where('is_published', true)
            ->orderByDesc('starts_at')
            ->orderByDesc('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Current Affairs Months
        |--------------------------------------------------------------------------
        |
        | Month comes from starts_at.
        | If starts_at is not available, created_at is used.
        |
        */

        $currentAffairsMonths = $allCurrentAffairsExams
            ->map(function ($exam) {

                $date = $exam->starts_at ?: $exam->created_at;

                return $date
                    ? $date->format('Y-m')
                    : null;
            })
            ->filter()
            ->unique()
            ->sortDesc()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Selected Current Affairs Month
        |--------------------------------------------------------------------------
        */

        $requestedMonth = request('current_affairs_month');

        if (
            $requestedMonth &&
            preg_match('/^\d{4}-\d{2}$/', $requestedMonth) &&
            $currentAffairsMonths->contains($requestedMonth)
        ) {
            $selectedCurrentAffairsMonth = $requestedMonth;
        } else {
            $selectedCurrentAffairsMonth = $currentAffairsMonths->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Selected Month Current Affairs Exams
        |--------------------------------------------------------------------------
        */

        $currentAffairsExams = $allCurrentAffairsExams
            ->filter(function ($exam) use ($selectedCurrentAffairsMonth) {

                if (!$selectedCurrentAffairsMonth) {
                    return true;
                }

                $date = $exam->starts_at ?: $exam->created_at;

                if (!$date) {
                    return false;
                }

                return $date->format('Y-m') === $selectedCurrentAffairsMonth;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | ALL Major Tests
        |--------------------------------------------------------------------------
        |
        | Major Tests are library-wide.
        | They do not require ExamAssignment.
        |
        | Every eligible student belonging to this library can see
        | published + active Major Tests.
        |
        */

        $majorTests = Exam::with('category')
            ->withCount('questions')
            ->where('library_id', $libraryId)
            ->where('exam_type', 'major_test')
            ->where('is_active', true)
            ->where('is_published', true)
            ->orderByDesc('starts_at')
            ->orderByDesc('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | All Dashboard Exams
        |--------------------------------------------------------------------------
        |
        | Main exam pool contains:
        |
        | 1. Assigned/private exams
        | 2. All Current Affairs exams
        | 3. All Major Tests
        |
        | Current Affairs month filtering is ONLY for its own section.
        |
        */

        $exams = $assignedExams
            ->merge($allCurrentAffairsExams)
            ->merge($majorTests)
            ->filter()
            ->unique('id')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Question Counts
        |--------------------------------------------------------------------------
        */

        $missingQuestionCountIds = $exams
            ->filter(function ($exam) {
                return !array_key_exists(
                    'questions_count',
                    $exam->getAttributes()
                );
            })
            ->pluck('id');

        if ($missingQuestionCountIds->isNotEmpty()) {

            $questionCounts = DB::table('exam_question')
                ->selectRaw('exam_id, COUNT(*) as total')
                ->whereIn('exam_id', $missingQuestionCountIds)
                ->groupBy('exam_id')
                ->pluck('total', 'exam_id');

            $exams->each(function ($exam) use ($questionCounts) {

                $exam->setAttribute(
                    'questions_count',
                    (int) ($questionCounts[$exam->id] ?? 0)
                );
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Available Exams
        |--------------------------------------------------------------------------
        */

        $availableExams = $exams
            ->filter(function ($exam) {

                if (!$exam) {
                    return false;
                }

                if (
                    $exam->starts_at &&
                    now()->lt($exam->starts_at)
                ) {
                    return false;
                }

                if (
                    $exam->ends_at &&
                    now()->gt($exam->ends_at)
                ) {
                    return false;
                }

                return true;
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Upcoming Exams
        |--------------------------------------------------------------------------
        */

        $upcomingExams = $exams
            ->filter(function ($exam) {

                return $exam &&
                    $exam->starts_at &&
                    now()->lt($exam->starts_at);
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Expired Exams
        |--------------------------------------------------------------------------
        */

        $expiredExams = $exams
            ->filter(function ($exam) {

                return $exam &&
                    $exam->ends_at &&
                    now()->gt($exam->ends_at);
            })
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'student-exam.dashboard',
            compact(
                'account',
                'student',
                'assignments',
                'exams',
                'availableExams',
                'upcomingExams',
                'expiredExams',
                'currentAffairsExams',
                'currentAffairsMonths',
                'selectedCurrentAffairsMonth',
                'majorTests'
            )
        );
    }
}