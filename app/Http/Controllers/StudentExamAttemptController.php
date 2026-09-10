<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAssignment;
use App\Models\ExamAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentExamAttemptController extends Controller
{
    /**
     * Start an exam.
     */
    public function start(Exam $exam)
    {
        $account = Auth::guard('student_exam')->user();

        abort_unless($account, 401);

        $account->load('student');

        $student = $account->student;

        abort_unless($student, 403);

        /*
        |--------------------------------------------------------------------------
        | Library Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $exam->library_id === (int) $student->library_id,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Exam Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $exam->is_active && $exam->is_published,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Exam Schedule
        |--------------------------------------------------------------------------
        */

        if (
            $exam->starts_at &&
            now()->lt($exam->starts_at)
        ) {
            return redirect()
                ->route('student-exam.instructions', $exam)
                ->with(
                    'error',
                    'This exam has not started yet.'
                );
        }

        if (
            $exam->ends_at &&
            now()->gt($exam->ends_at)
        ) {
            return redirect()
                ->route('student-exam.instructions', $exam)
                ->with(
                    'error',
                    'This exam has already ended.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Student Eligibility
        |--------------------------------------------------------------------------
        |
        | Major Test:
        |   Available to eligible students of the same library.
        |
        | Current Affairs:
        |   Available to eligible students of the same library.
        |
        | Other exams:
        |   Require an active assignment.
        |
        | This preserves ExamAssignment for private/assigned exams.
        |--------------------------------------------------------------------------
        */

        $assignment = null;

        $isMajorTest = $exam->exam_type === 'major_test';
        $isCurrentAffairs = $exam->exam_type === 'current_affairs';

        if (! $isMajorTest && ! $isCurrentAffairs) {
            $assignment = ExamAssignment::where('exam_id', $exam->id)
                ->where('student_id', $student->id)
                ->where('library_id', $student->library_id)
                ->where('status', '!=', 'cancelled')
                ->first();

            abort_unless($assignment, 403);
        }

        /*
        |--------------------------------------------------------------------------
        | Existing In-Progress Attempt
        |--------------------------------------------------------------------------
        |
        | IMPORTANT:
        | Resume must be checked before attempt limit.
        |--------------------------------------------------------------------------
        */

        $existingAttempt = ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->where('library_id', $student->library_id)
            ->where('status', 'in_progress')
            ->latest('id')
            ->first();

        if ($existingAttempt) {
            if ($existingAttempt->hasExpired()) {
                $this->finalizeExpiredAttempt(
                    $existingAttempt,
                    $exam
                );

                return redirect()
                    ->route('student-exam.result', [
                        'exam' => $exam,
                        'attempt' => $existingAttempt,
                    ]);
            }

            return redirect()
                ->route('student-exam.attempt', [
                    'exam' => $exam,
                    'attempt' => $existingAttempt,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Attempt Limit
        |--------------------------------------------------------------------------
        |
        | attempt_limit <= 0 means unlimited attempts.
        |--------------------------------------------------------------------------
        */

        $completedAttempts = ExamAttempt::where('exam_id', $exam->id)
            ->where('student_id', $student->id)
            ->where('library_id', $student->library_id)
            ->whereIn('status', [
                'submitted',
                'expired',
            ])
            ->count();

        if (
            (int) $exam->attempt_limit > 0 &&
            $completedAttempts >= (int) $exam->attempt_limit
        ) {
            return redirect()
                ->route('student-exam.instructions', $exam)
                ->with(
                    'error',
                    'You have reached the maximum number of attempts for this exam.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Load Question Paper
        |--------------------------------------------------------------------------
        */

        $exam->load([
            'questions.options',
        ]);

        $questions = $exam->questions;

        if ($questions->isEmpty()) {
            return redirect()
                ->route('student-exam.instructions', $exam)
                ->with(
                    'error',
                    'This exam does not have any questions yet.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Create Attempt Safely
        |--------------------------------------------------------------------------
        */

        $attempt = DB::transaction(function () use (
            $exam,
            $student,
            $questions
        ) {
            /*
            |--------------------------------------------------------------------------
            | Re-check active attempt inside transaction
            |--------------------------------------------------------------------------
            */

            $existingAttempt = ExamAttempt::where('exam_id', $exam->id)
                ->where('student_id', $student->id)
                ->where('library_id', $student->library_id)
                ->where('status', 'in_progress')
                ->lockForUpdate()
                ->latest('id')
                ->first();

            if ($existingAttempt) {
                return $existingAttempt;
            }

            /*
            |--------------------------------------------------------------------------
            | Re-check attempt count inside transaction
            |--------------------------------------------------------------------------
            */

            $completedAttempts = ExamAttempt::where('exam_id', $exam->id)
                ->where('student_id', $student->id)
                ->where('library_id', $student->library_id)
                ->whereIn('status', [
                    'submitted',
                    'expired',
                ])
                ->lockForUpdate()
                ->count();

            if (
                (int) $exam->attempt_limit > 0 &&
                $completedAttempts >= (int) $exam->attempt_limit
            ) {
                abort(
                    403,
                    'You have reached the maximum number of attempts for this exam.'
                );
            }

            $attemptNumber = $completedAttempts + 1;

            /*
            |--------------------------------------------------------------------------
            | Total Marks Snapshot
            |--------------------------------------------------------------------------
            */

            $totalMarks = $questions->sum(
                function ($question) {
                    if (
                        $question->pivot &&
                        $question->pivot->marks !== null
                    ) {
                        return (float) $question->pivot->marks;
                    }

                    return (float) ($question->marks ?? 0);
                }
            );

            /*
            |--------------------------------------------------------------------------
            | Timer
            |--------------------------------------------------------------------------
            */

            $startedAt = now();

            $durationMinutes = max(
                1,
                (int) $exam->duration_minutes
            );

            $expiresAt = $startedAt->copy()
                ->addMinutes($durationMinutes);

            /*
            |--------------------------------------------------------------------------
            | Create Attempt
            |--------------------------------------------------------------------------
            */

            $attempt = ExamAttempt::create([
                'library_id' => $student->library_id,
                'exam_id' => $exam->id,
                'student_id' => $student->id,
                'exam_user_id' => null,
                'attempt_number' => $attemptNumber,
                'status' => 'in_progress',
                'started_at' => $startedAt,
                'submitted_at' => null,
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
            | Create Answer Rows
            |--------------------------------------------------------------------------
            */

            foreach ($questions as $question) {
                $attempt->answers()->create([
                    'library_id' => $student->library_id,
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

        /*
        |--------------------------------------------------------------------------
        | Mark Assignment Started
        |--------------------------------------------------------------------------
        */

        if (
            $assignment &&
            $assignment->status === 'assigned'
        ) {
            $assignment->update([
                'status' => 'started',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Open Exam
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student-exam.attempt', [
                'exam' => $exam,
                'attempt' => $attempt,
            ]);
    }

    /**
     * Show the active exam attempt.
     */
    public function show(
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $account = Auth::guard('student_exam')->user();

        abort_unless($account, 401);

        $account->load('student');

        $student = $account->student;

        abort_unless($student, 403);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $exam->library_id === (int) $student->library_id,
            404
        );

        abort_unless(
            (int) $attempt->exam_id === (int) $exam->id,
            404
        );

        abort_unless(
            (int) $attempt->student_id === (int) $student->id,
            403
        );

        abort_unless(
            (int) $attempt->library_id === (int) $student->library_id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Expiry Check
        |--------------------------------------------------------------------------
        */

        if (
            $attempt->status === 'in_progress' &&
            $attempt->hasExpired()
        ) {
            $this->finalizeExpiredAttempt(
                $attempt,
                $exam
            );

            return redirect()
                ->route('student-exam.result', [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ])
                ->with(
                    'error',
                    'Your exam time has expired.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Already Completed
        |--------------------------------------------------------------------------
        */

        if ($attempt->status !== 'in_progress') {
            return redirect()
                ->route('student-exam.result', [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Load Questions + Answers
        |--------------------------------------------------------------------------
        */

        $attempt->load([
            'answers.question.options',
        ]);

        $questions = $attempt->answers
            ->sortBy(
                fn ($answer) =>
                    $answer->question->sort_order ?? 0
            )
            ->values();

        return view(
            'student-exam.attempt',
            compact(
                'account',
                'student',
                'exam',
                'attempt',
                'questions'
            )
        );
    }

    /**
     * Submit an exam attempt.
     */
    public function submit(
        Request $request,
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $account = Auth::guard('student_exam')->user();

        abort_unless($account, 401);

        $account->load('student');

        $student = $account->student;

        abort_unless($student, 403);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $exam->library_id === (int) $student->library_id,
            404
        );

        abort_unless(
            (int) $attempt->exam_id === (int) $exam->id,
            404
        );

        abort_unless(
            (int) $attempt->student_id === (int) $student->id,
            403
        );

        abort_unless(
            (int) $attempt->library_id === (int) $student->library_id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Already Completed
        |--------------------------------------------------------------------------
        */

        if ($attempt->status !== 'in_progress') {
            return redirect()
                ->route('student-exam.result', [
                    'exam' => $exam,
                    'attempt' => $attempt,
                ])
                ->with(
                    'error',
                    'This exam attempt has already been completed.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Validate Request
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

        $submittedAnswers = $validated['answers'] ?? [];

        /*
        |--------------------------------------------------------------------------
        | Finalize Attempt Safely
        |--------------------------------------------------------------------------
        */

        $wasExpired = false;

        DB::transaction(function () use (
            $attempt,
            $exam,
            $submittedAnswers,
            &$wasExpired
        ) {
            /*
            |--------------------------------------------------------------------------
            | Lock Attempt
            |--------------------------------------------------------------------------
            */

            $lockedAttempt = ExamAttempt::whereKey($attempt->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Prevent Double Submit
            |--------------------------------------------------------------------------
            */

            if ($lockedAttempt->status !== 'in_progress') {
                return;
            }

            /*
            |--------------------------------------------------------------------------
            | Determine Timer State
            |--------------------------------------------------------------------------
            */

            $wasExpired = $lockedAttempt->hasExpired();

            /*
            |--------------------------------------------------------------------------
            | Load Attempt Answers
            |--------------------------------------------------------------------------
            */

            $answers = $lockedAttempt->answers()
                ->with([
                    'question.options',
                ])
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Load Exam Questions + Pivot
            |--------------------------------------------------------------------------
            */

            $exam->load([
                'questions',
            ]);

            $examQuestions = $exam->questions
                ->keyBy('id');

            /*
            |--------------------------------------------------------------------------
            | Result Counters
            |--------------------------------------------------------------------------
            */

            $obtainedMarks = 0;
            $correctAnswers = 0;
            $wrongAnswers = 0;
            $unanswered = 0;

            $now = now();

            /*
            |--------------------------------------------------------------------------
            | Score Answers
            |--------------------------------------------------------------------------
            */

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

                /*
                |--------------------------------------------------------------------------
                | Submitted Option
                |--------------------------------------------------------------------------
                */

                $selectedOptionId = $submittedAnswers[$question->id]
                    ?? null;

                /*
                |--------------------------------------------------------------------------
                | No Answer
                |--------------------------------------------------------------------------
                */

                if (
                    $selectedOptionId === null ||
                    $selectedOptionId === ''
                ) {
                    /*
                    | If this is a timer expiry, preserve an answer that
                    | may already have been saved before the timer ended.
                    */
                    if (
                        $wasExpired &&
                        $answer->selected_option_id
                    ) {
                        $selectedOptionId =
                            $answer->selected_option_id;
                    } else {
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
                }

                /*
                |--------------------------------------------------------------------------
                | Verify Option Belongs To Question
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
                | Exam-Specific Question
                |--------------------------------------------------------------------------
                */

                $examQuestion = $examQuestions->get(
                    $question->id
                );

                /*
                |--------------------------------------------------------------------------
                | Positive Marks
                |--------------------------------------------------------------------------
                */

                if (
                    $examQuestion &&
                    $examQuestion->pivot &&
                    $examQuestion->pivot->marks !== null
                ) {
                    $questionMarks =
                        (float) $examQuestion->pivot->marks;
                } else {
                    $questionMarks =
                        (float) ($question->marks ?? 0);
                }

                /*
                |--------------------------------------------------------------------------
                | Negative Marks
                |--------------------------------------------------------------------------
                */

                if (
                    $examQuestion &&
                    $examQuestion->pivot &&
                    $examQuestion->pivot->negative_marks !== null
                ) {
                    $negativeMarks =
                        (float) $examQuestion->pivot->negative_marks;
                } else {
                    $negativeMarks =
                        (float) ($exam->negative_marks ?? 0);
                }

                /*
                |--------------------------------------------------------------------------
                | Correct / Wrong
                |--------------------------------------------------------------------------
                */

                $isCorrect = (bool) $selectedOption->is_correct;

                $marksAwarded = 0;

                if ($isCorrect) {
                    $marksAwarded = $questionMarks;
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;

                    if ($exam->negative_marking) {
                        $marksAwarded = -abs($negativeMarks);
                    }
                }

                $obtainedMarks += $marksAwarded;

                /*
                |--------------------------------------------------------------------------
                | Save Answer
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
            | Prevent Negative Final Score
            |--------------------------------------------------------------------------
            */

            $obtainedMarks = max(
                0,
                $obtainedMarks
            );

            /*
            |--------------------------------------------------------------------------
            | Pass / Fail
            |--------------------------------------------------------------------------
            */

            $isPassed =
                $obtainedMarks >=
                (float) $exam->passing_marks;

            /*
            |--------------------------------------------------------------------------
            | Complete Attempt
            |--------------------------------------------------------------------------
            */

            $lockedAttempt->update([
                'status' => $wasExpired
                    ? 'expired'
                    : 'submitted',

                'submitted_at' => $now,

                'obtained_marks' => $obtainedMarks,

                'correct_answers' => $correctAnswers,

                'wrong_answers' => $wrongAnswers,

                'unanswered' => $unanswered,

                'is_passed' => $isPassed,
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | Refresh Attempt
        |--------------------------------------------------------------------------
        */

        $attempt->refresh();

        /*
        |--------------------------------------------------------------------------
        | Mark Assignment Completed
        |--------------------------------------------------------------------------
        */

        if ($attempt->status === 'submitted') {
            ExamAssignment::where('exam_id', $exam->id)
                ->where('student_id', $student->id)
                ->where('library_id', $student->library_id)
                ->where('status', 'started')
                ->update([
                    'status' => 'completed',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Redirect To Result
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('student-exam.result', [
                'exam' => $exam,
                'attempt' => $attempt,
            ])
            ->with(
                'success',
                $attempt->status === 'expired'
                    ? 'Exam time expired. Your saved answers have been evaluated.'
                    : 'Exam submitted successfully.'
            );
    }

    /**
     * Show exam result.
     */
    public function result(
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $account = Auth::guard('student_exam')->user();

        abort_unless($account, 401);

        $account->load('student');

        $student = $account->student;

        abort_unless($student, 403);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        */

        abort_unless(
            (int) $exam->library_id === (int) $student->library_id,
            404
        );

        abort_unless(
            (int) $attempt->exam_id === (int) $exam->id,
            404
        );

        abort_unless(
            (int) $attempt->student_id === (int) $student->id,
            403
        );

        abort_unless(
            (int) $attempt->library_id === (int) $student->library_id,
            403
        );

        /*
        |--------------------------------------------------------------------------
        | Only Completed Attempts
        |--------------------------------------------------------------------------
        */

        abort_unless(
            in_array(
                $attempt->status,
                [
                    'submitted',
                    'expired',
                ],
                true
            ),
            403
        );

        $attempt->load([
            'answers.question.options',
            'exam.category',
        ]);

        return view(
            'student-exam.result',
            compact(
                'account',
                'student',
                'exam',
                'attempt'
            )
        );
    }

    /**
     * Finalize an expired attempt.
     *
     * Previously only the status was changed to expired.
     * Now all answers already saved in the attempt are evaluated.
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
            | Load Answers
            |--------------------------------------------------------------------------
            */

            $answers = $lockedAttempt->answers()
                ->with([
                    'question.options',
                ])
                ->get();

            /*
            |--------------------------------------------------------------------------
            | Load Exam Questions
            |--------------------------------------------------------------------------
            */

            $exam->load([
                'questions',
            ]);

            $examQuestions = $exam->questions
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

                /*
                |--------------------------------------------------------------------------
                | Use Already Saved Answer
                |--------------------------------------------------------------------------
                */

                $selectedOptionId =
                    $answer->selected_option_id;

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
                | Verify Option Ownership
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
                | Exam-Specific Question
                |--------------------------------------------------------------------------
                */

                $examQuestion = $examQuestions->get(
                    $question->id
                );

                /*
                |--------------------------------------------------------------------------
                | Marks
                |--------------------------------------------------------------------------
                */

                $questionMarks =
                    $examQuestion?->pivot?->marks !== null
                        ? (float) $examQuestion->pivot->marks
                        : (float) ($question->marks ?? 0);

                $negativeMarks =
                    $examQuestion?->pivot?->negative_marks !== null
                        ? (float) $examQuestion->pivot->negative_marks
                        : (float) ($exam->negative_marks ?? 0);

                /*
                |--------------------------------------------------------------------------
                | Score
                |--------------------------------------------------------------------------
                */

                $isCorrect =
                    (bool) $selectedOption->is_correct;

                $marksAwarded = 0;

                if ($isCorrect) {
                    $marksAwarded = $questionMarks;
                    $correctAnswers++;
                } else {
                    $wrongAnswers++;

                    if ($exam->negative_marking) {
                        $marksAwarded = -abs($negativeMarks);
                    }
                }

                $obtainedMarks += $marksAwarded;

                /*
                |--------------------------------------------------------------------------
                | Save Evaluated Answer
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
            | Prevent Negative Final Score
            |--------------------------------------------------------------------------
            */

            $obtainedMarks = max(
                0,
                $obtainedMarks
            );

            /*
            |--------------------------------------------------------------------------
            | Pass / Fail
            |--------------------------------------------------------------------------
            */

            $isPassed =
                $obtainedMarks >=
                (float) $exam->passing_marks;

            /*
            |--------------------------------------------------------------------------
            | Mark Expired
            |--------------------------------------------------------------------------
            */

            $lockedAttempt->update([
                'status' => 'expired',
                'submitted_at' => $now,
                'obtained_marks' => $obtainedMarks,
                'correct_answers' => $correctAnswers,
                'wrong_answers' => $wrongAnswers,
                'unanswered' => $unanswered,
                'is_passed' => $isPassed,
            ]);
        });

        $attempt->refresh();
    }
}