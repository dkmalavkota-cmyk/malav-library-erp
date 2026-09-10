<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Support\Facades\Auth;

class ExamUserExamController extends Controller
{
    /**
     * Show examination details to external exam user.
     */
    public function show(Exam $exam)
    {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        /*
        |--------------------------------------------------------------------------
        | Active Library Access
        |--------------------------------------------------------------------------
        */

        $libraryIds = $examUser
            ->activeLibraryAccess()
            ->pluck('library_id');

        if (! $libraryIds->contains((int) $exam->library_id)) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Only published and active exams
        |--------------------------------------------------------------------------
        */

        if (! $exam->is_active || ! $exam->is_published) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Check examination timing
        |--------------------------------------------------------------------------
        */

        if (
            $exam->starts_at !== null &&
            now()->lt($exam->starts_at)
        ) {
            abort(404);
        }

        if (
            $exam->ends_at !== null &&
            now()->gt($exam->ends_at)
        ) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Regular Exam Category Authorization
        |--------------------------------------------------------------------------
        */

        if ($exam->exam_type === 'regular') {

            $hasCategoryAccess = $examUser
                ->selectedCategories()
                ->where(
                    'exam_categories.id',
                    $exam->exam_category_id
                )
                ->where(
                    'exam_categories.library_id',
                    $exam->library_id
                )
                ->exists();

            if (! $hasCategoryAccess) {
                abort(404);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Major Tests
        |--------------------------------------------------------------------------
        */

        if ($exam->exam_type === 'major_test') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Load Exam Information
        |--------------------------------------------------------------------------
        */

        $exam->load([
            'category',
            'questions',
        ]);

        /*
        |--------------------------------------------------------------------------
        | User Attempt Information
        |--------------------------------------------------------------------------
        |
        | Used only for the examination details UI.
        | The actual security check remains inside the start action.
        |
        */

        $attemptCount = ExamAttempt::query()
            ->where('exam_id', $exam->id)
            ->where('exam_user_id', $examUser->id)
            ->whereIn('status', [
                'in_progress',
                'submitted',
                'expired',
            ])
            ->count();

        $attemptLimitReached =
            $exam->attempt_limit > 0 &&
            $attemptCount >= $exam->attempt_limit;

        /*
        |--------------------------------------------------------------------------
        | Exam Details Page
        |--------------------------------------------------------------------------
        */

        return view(
            'exam-user.exam.show',
            compact(
                'examUser',
                'exam',
                'attemptCount',
                'attemptLimitReached'
            )
        );
    }
}