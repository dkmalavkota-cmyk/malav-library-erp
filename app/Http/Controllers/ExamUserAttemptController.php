<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAttemptAnswer;
use App\Models\ExamUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamUserAttemptController extends Controller
{
    /**
     * Start a new attempt for an external exam user.
     */
    public function start(Exam $exam)
    {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        $this->authorizeExam($exam, $examUser->id);

        /*
        |--------------------------------------------------------------------------
        | Existing in-progress attempt
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Always check an existing running attempt BEFORE checking the
        | attempt limit. Otherwise a user who has reached the limit could
        | be blocked from resuming an already-created attempt.
        |
        */

        $existingAttempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('exam_user_id', $examUser->id)
            ->where('status', 'in_progress')
            ->latest('id')
            ->first();

        if ($existingAttempt) {
            if ($existingAttempt->hasExpired()) {
                $this->finalizeExpiredAttempt($existingAttempt, $exam);

                return redirect()
                    ->route('exam-user.exam.result', [
                        'exam' => $exam,
                        'attempt' => $existingAttempt,
                    ]);
            }

            return redirect()
                ->route('exam-user.exam.attempt', [
                    'exam' => $exam,
                    'attempt' => $existingAttempt,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Attempt limit
        |--------------------------------------------------------------------------
        */

        $attemptCount = ExamAttempt::where('exam_id', $exam->id)
            ->where('exam_user_id', $examUser->id)
            ->whereIn('status', [
                'in_progress',
                'submitted',
                'expired',
            ])
            ->count();

        if (
            (int) $exam->attempt_limit > 0 &&
            $attemptCount >= (int) $exam->attempt_limit
        ) {
            return redirect()
                ->route('exam-user.exam.show', $exam)
                ->with(
                    'error',
                    'You have reached the maximum number of attempts for this examination.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Load exam questions
        |--------------------------------------------------------------------------
        */

        $questions = $exam->questions()
            ->with('options')
            ->orderBy('exam_question.sort_order')
            ->get();

        if ($questions->isEmpty()) {
            return redirect()
                ->route('exam-user.exam.show', $exam)
                ->with(
                    'error',
                    'This examination does not contain any questions yet.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create attempt safely
        |--------------------------------------------------------------------------
        */

        $attempt = DB::transaction(function () use (
            $exam,
            $examUser,
            $questions
        ) {
            /*
            |--------------------------------------------------------------------------
            | Re-check running attempt inside transaction
            |--------------------------------------------------------------------------
            |
            | This reduces the possibility of two simultaneous start requests
            | creating two active attempts for the same user/exam.
            |
            */

            $existingAttempt = ExamAttempt::where('exam_id', $exam->id)
                ->where('exam_user_id', $examUser->id)
                ->where('status', 'in_progress')
                ->lockForUpdate()
                ->latest('id')
                ->first();

            if ($existingAttempt) {
                return $existingAttempt;
            }

            $lastAttemptNumber = ExamAttempt::where('exam_id', $exam->id)
                ->where('exam_user_id', $examUser->id)
                ->lockForUpdate()
                ->max('attempt_number');

            $attemptNumber = ((int) $lastAttemptNumber) + 1;

            $startedAt = now();

            $expiresAt = $startedAt->copy()->addMinutes(
                max(1, (int) $exam->duration_minutes)
            );

            /*
            |--------------------------------------------------------------------------
            | Snapshot total marks
            |--------------------------------------------------------------------------
            */

            $totalMarks = $questions->sum(function ($question) {
                $pivotMarks = $question->pivot?->marks;

                return $pivotMarks !== null
                    ? (float) $pivotMarks
                    : (float) ($question->marks ?? 0);
            });

            /*
            |--------------------------------------------------------------------------
            | Create attempt
            |--------------------------------------------------------------------------
            */

            $attempt = ExamAttempt::create([
                'library_id' => $exam->library_id,
                'exam_id' => $exam->id,
                'exam_user_id' => $examUser->id,
                'student_id' => null,
                'attempt_number' => $attemptNumber,
                'status' => 'in_progress',
                'started_at' => $startedAt,
                'expires_at' => $expiresAt,
                'total_marks' => $totalMarks,
                'obtained_marks' => 0,
                'correct_answers' => 0,
                'wrong_answers' => 0,
                'unanswered' => $questions->count(),
                'is_passed' => null,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create answer rows
            |--------------------------------------------------------------------------
            */

            foreach ($questions as $question) {
                ExamAttemptAnswer::create([
                    'library_id' => $exam->library_id,
                    'exam_attempt_id' => $attempt->id,
                    'exam_question_id' => $question->id,
                    'selected_option_id' => null,
                    'is_answered' => false,
                    'is_correct' => null,
                    'marks_awarded' => 0,
                    'answered_at' => null,
                ]);
            }

            return $attempt;
        });

        return redirect()
            ->route('exam-user.exam.attempt', [
                'exam' => $exam,
                'attempt' => $attempt,
            ]);
    }

    /**
     * Show external user's active attempt.
     */
    public function attempt(
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        $this->authorizeExam($exam, $examUser->id);

        $this->authorizeAttempt(
            $exam,
            $attempt,
            $examUser->id
        );

        if ($attempt->status !== 'in_progress') {
            return redirect()
                ->route('exam-user.exam.result', [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ]);
        }

        if ($attempt->hasExpired()) {
            $this->finalizeExpiredAttempt($attempt, $exam);

            return redirect()
                ->route('exam-user.exam.result', [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Load questions through attempt answers
        |--------------------------------------------------------------------------
        */

        $questions = $attempt->answers()
            ->with([
                'question.options',
            ])
            ->get();

        return view(
            'exam-user.exam.attempt',
            compact(
                'examUser',
                'exam',
                'attempt',
                'questions'
            )
        );
    }

    /**
     * Submit external user's exam.
     */
    public function submit(
        Request $request,
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        $this->authorizeExam($exam, $examUser->id);

        $this->authorizeAttempt(
            $exam,
            $attempt,
            $examUser->id
        );

        /*
        |--------------------------------------------------------------------------
        | Already finalized
        |--------------------------------------------------------------------------
        */

        if ($attempt->status !== 'in_progress') {
            return redirect()
                ->route('exam-user.exam.result', [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Validate submitted answers
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'answers' => [
                'nullable',
                'array',
            ],

            'answers.*' => [
                'nullable',
                'integer',
                'exists:exam_question_options,id',
            ],
        ]);

        $submittedAnswers = collect(
            $validated['answers'] ?? []
        )->mapWithKeys(function ($optionId, $questionId) {
            if ($optionId === null || $optionId === '') {
                return [
                    (int) $questionId => null,
                ];
            }

            return [
                (int) $questionId => (int) $optionId,
            ];
        });

        /*
        |--------------------------------------------------------------------------
        | Finalize attempt
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $attempt,
            $exam,
            $submittedAnswers
        ) {
            /*
            |--------------------------------------------------------------------------
            | Lock attempt
            |--------------------------------------------------------------------------
            |
            | Prevent two simultaneous submit requests from calculating the
            | same attempt twice.
            |
            */

            $lockedAttempt = ExamAttempt::whereKey($attempt->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedAttempt->status !== 'in_progress') {
                return;
            }

            $this->scoreAttempt(
                $lockedAttempt,
                $exam,
                $submittedAnswers,
                true
            );
        });

        return redirect()
            ->route('exam-user.exam.result', [
                'exam' => $exam,
                'attempt' => $attempt,
            ]);
    }

    /**
     * Show result.
     */
    public function result(
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        $this->authorizeExam($exam, $examUser->id);

        $this->authorizeAttempt(
            $exam,
            $attempt,
            $examUser->id
        );

        abort_unless(
            in_array(
                $attempt->status,
                [
                    'submitted',
                    'expired',
                ],
                true
            ),
            404
        );

        $attempt->load([
            'answers.question.options',
            'exam.category',
        ]);

        return view(
            'exam-user.exam.result',
            compact(
                'examUser',
                'exam',
                'attempt'
            )
        );
    }

    /**
     * Verify external attempt ownership.
     */
    private function authorizeAttempt(
        Exam $exam,
        ExamAttempt $attempt,
        int $examUserId
    ): void {
        abort_unless(
            (int) $attempt->exam_id === (int) $exam->id,
            404
        );

        abort_unless(
            (int) $attempt->exam_user_id === (int) $examUserId,
            403
        );

        abort_unless(
            (int) $attempt->library_id === (int) $exam->library_id,
            403
        );
    }

    /**
     * Verify external user can access the exam.
     */
    private function authorizeExam(
        Exam $exam,
        int $examUserId
    ): void {
        /*
        |--------------------------------------------------------------------------
        | Basic exam availability
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $exam->is_active &&
            $exam->is_published,
            404
        );

        abort_unless(
            $exam->starts_at === null ||
            now()->greaterThanOrEqualTo($exam->starts_at),
            404
        );

        abort_unless(
            $exam->ends_at === null ||
            now()->lessThanOrEqualTo($exam->ends_at),
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Load external examination user
        |--------------------------------------------------------------------------
        */

        $examUser = ExamUser::find($examUserId);

        abort_unless(
            $examUser &&
            $examUser->is_active,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Library Access
        |--------------------------------------------------------------------------
        */

        $hasLibraryAccess = $examUser
            ->activeLibraryAccess()
            ->where(
                'library_id',
                $exam->library_id
            )
            ->exists();

        abort_unless(
            $hasLibraryAccess,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Regular Exam Category Access
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

            abort_unless(
                $hasCategoryAccess,
                404
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Major Test
        |--------------------------------------------------------------------------
        |
        | Public users do not receive Major Tests through the current
        | category-selection system.
        |
        */

        if ($exam->exam_type === 'major_test') {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | Current Affairs
        |--------------------------------------------------------------------------
        |
        | Current Affairs is currently available when the external user
        | has active examination access to the exam's library.
        |
        */
    }

    /**
     * Score and finalize an attempt.
     *
     * This method is used for both normal submission and timer expiry.
     */
    private function scoreAttempt(
        ExamAttempt $attempt,
        Exam $exam,
        $submittedAnswers,
        bool $submittedByUser = false
    ): void {
        /*
        |--------------------------------------------------------------------------
        | Load all attempt answers
        |--------------------------------------------------------------------------
        */

        $answers = $attempt->answers()
            ->with([
                'question.options',
            ])
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Load exam questions with pivot marks
        |--------------------------------------------------------------------------
        */

        $examQuestions = $exam->questions()
            ->get()
            ->keyBy('id');

        $obtainedMarks = 0;
        $correctAnswers = 0;
        $wrongAnswers = 0;
        $unanswered = 0;

        $now = now();

        foreach ($answers as $answer) {
            $question = $answer->question;

            if (! $question) {
                $unanswered++;

                $answer->update([
                    'selected_option_id' => null,
                    'is_answered' => false,
                    'is_correct' => null,
                    'marks_awarded' => 0,
                    'answered_at' => null,
                ]);

                continue;
            }

            $examQuestion = $examQuestions->get(
                $question->id
            );

            /*
            |--------------------------------------------------------------------------
            | Determine selected option
            |--------------------------------------------------------------------------
            |
            | For a normal submission, use the newly submitted answer.
            |
            | For timer expiry, use the answer already saved in the database.
            |
            */

            $selectedOptionId = $submittedByUser
                ? $submittedAnswers->get((int) $question->id)
                : $answer->selected_option_id;

            /*
            |--------------------------------------------------------------------------
            | Unanswered
            |--------------------------------------------------------------------------
            */

            if (! $selectedOptionId) {
                $answer->update([
                    'selected_option_id' => null,
                    'is_answered' => false,
                    'is_correct' => null,
                    'marks_awarded' => 0,
                    'answered_at' => null,
                ]);

                $unanswered++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Verify option belongs to current question
            |--------------------------------------------------------------------------
            */

            $selectedOption = $question->options
                ->firstWhere(
                    'id',
                    (int) $selectedOptionId
                );

            if (! $selectedOption) {
                $answer->update([
                    'selected_option_id' => null,
                    'is_answered' => false,
                    'is_correct' => null,
                    'marks_awarded' => 0,
                    'answered_at' => null,
                ]);

                $unanswered++;

                continue;
            }

            /*
            |--------------------------------------------------------------------------
            | Correct answer
            |--------------------------------------------------------------------------
            */

            $isCorrect = (bool) $selectedOption->is_correct;

            /*
            |--------------------------------------------------------------------------
            | Marks
            |--------------------------------------------------------------------------
            */

            $positiveMarks = $examQuestion?->pivot?->marks !== null
                ? (float) $examQuestion->pivot->marks
                : (float) ($question->marks ?? 0);

            $negativeMarks = $examQuestion?->pivot?->negative_marks !== null
                ? (float) $examQuestion->pivot->negative_marks
                : (float) ($question->negative_marks ?? 0);

            $marksAwarded = 0;

            if ($isCorrect) {
                $marksAwarded = $positiveMarks;
                $correctAnswers++;
            } else {
                $marksAwarded = $exam->negative_marking
                    ? -$negativeMarks
                    : 0;

                $wrongAnswers++;
            }

            $obtainedMarks += $marksAwarded;

            /*
            |--------------------------------------------------------------------------
            | Save answer result
            |--------------------------------------------------------------------------
            */

            $answer->update([
                'selected_option_id' => $selectedOption->id,
                'is_answered' => true,
                'is_correct' => $isCorrect,
                'marks_awarded' => $marksAwarded,
                'answered_at' => $answer->answered_at ?? $now,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Final result
        |--------------------------------------------------------------------------
        */

        $passed = $obtainedMarks >= (float) $exam->passing_marks;

        $attempt->update([
            'status' => $attempt->hasExpired()
                ? 'expired'
                : 'submitted',

            'submitted_at' => $now,

            'obtained_marks' => $obtainedMarks,

            'correct_answers' => $correctAnswers,

            'wrong_answers' => $wrongAnswers,

            'unanswered' => $unanswered,

            'is_passed' => $passed,
        ]);
    }

    /**
     * Finalize an expired attempt.
     *
     * Answers already saved before expiry are scored.
     * Unanswered questions remain unanswered.
     */
    private function finalizeExpiredAttempt(
        ExamAttempt $attempt,
        Exam $exam
    ): void {
        DB::transaction(function () use (
            $attempt,
            $exam
        ) {
            $lockedAttempt = ExamAttempt::whereKey($attempt->id)
                ->lockForUpdate()
                ->first();

            if (! $lockedAttempt) {
                return;
            }

            if ($lockedAttempt->status !== 'in_progress') {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Score the answers that were already saved.
            |--------------------------------------------------------------------------
            */

            $this->scoreAttempt(
                $lockedAttempt,
                $exam,
                collect(),
                false
            );
        });

        $attempt->refresh();
    }
}