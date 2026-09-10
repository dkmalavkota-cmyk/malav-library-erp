<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamQuestionPaperController extends Controller
{
    /**
     * Display the question paper builder.
     */
    public function index(Exam $exam)
    {
        $this->authorizeExam($exam);

        $exam->load('category');

        /*
        |--------------------------------------------------------------------------
        | Questions already added to this exam
        |--------------------------------------------------------------------------
        */
        $selectedQuestions = $exam->questions()
            ->with([
                'subject',
                'topic',
                'options',
            ])
            ->orderBy('exam_question.sort_order')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | IDs already attached
        |--------------------------------------------------------------------------
        */
        $selectedQuestionIds = $selectedQuestions
            ->pluck('id')
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Available Question Bank questions
        |--------------------------------------------------------------------------
        */
        $availableQuestions = ExamQuestion::query()
            ->with([
                'subject',
                'topic',
                'options',
            ])
            ->where('library_id', Auth::user()->library_id)
            ->where('is_active', true)
            ->when(
                !empty($selectedQuestionIds),
                function ($query) use ($selectedQuestionIds) {
                    $query->whereNotIn('id', $selectedQuestionIds);
                }
            )
            ->orderBy('subject_id')
            ->orderBy('topic_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */
        $questionCount = $selectedQuestions->count();

        $questionMarks = $selectedQuestions->sum(function ($question) {
            return (float) ($question->pivot->marks ?? $question->marks ?? 0);
        });

        $remainingMarks = max(
            0,
            (float) $exam->total_marks - $questionMarks
        );

        return view('exams.question-paper', compact(
            'exam',
            'selectedQuestions',
            'availableQuestions',
            'questionCount',
            'questionMarks',
            'remainingMarks'
        ));
    }


    /**
     * Add questions from Question Bank to exam.
     */
    public function store(Request $request, Exam $exam)
    {
        $this->authorizeExam($exam);

        $validated = $request->validate([
            'question_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'question_ids.*' => [
                'required',
                'integer',
                'exists:exam_questions,id',
            ],
        ]);

        $questionIds = collect($validated['question_ids'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Only allow questions belonging to same library
        |--------------------------------------------------------------------------
        */
        $questions = ExamQuestion::query()
            ->whereIn('id', $questionIds)
            ->where('library_id', Auth::user()->library_id)
            ->where('is_active', true)
            ->get()
            ->keyBy('id');

        if ($questions->count() !== $questionIds->count()) {
            return back()
                ->withErrors([
                    'question_ids' => 'One or more selected questions are invalid.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Existing questions
        |--------------------------------------------------------------------------
        */
        $existingIds = $exam->questions()
            ->whereIn('exam_questions.id', $questionIds)
            ->pluck('exam_questions.id')
            ->toArray();

        /*
        |--------------------------------------------------------------------------
        | Next sort order
        |--------------------------------------------------------------------------
        */
        $nextSortOrder = (int) (
            DB::table('exam_question')
                ->where('exam_id', $exam->id)
                ->max('sort_order') ?? -1
        );

        $rows = [];

        foreach ($questionIds as $questionId) {

            /*
            | Skip duplicates
            */
            if (in_array($questionId, $existingIds, true)) {
                continue;
            }

            $question = $questions->get($questionId);

            $nextSortOrder++;

            $rows[] = [
                'exam_id' => $exam->id,
                'exam_question_id' => $question->id,
                'sort_order' => $nextSortOrder,

                /*
                | Use Question Bank marks by default.
                | Admin can later override them if needed.
                */
                'marks' => $question->marks,

                /*
                | Use Question Bank negative marks by default.
                */
                'negative_marks' => $question->negative_marks,

                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        if (!empty($rows)) {
            DB::table('exam_question')->insert($rows);
        }

        return redirect()
            ->route('exam-question-paper.index', $exam)
            ->with(
                'success',
                count($rows) . ' question(s) added to the exam.'
            );
    }


    /**
     * Reorder questions inside exam.
     */
    public function reorder(Request $request, Exam $exam)
    {
        $this->authorizeExam($exam);

        $validated = $request->validate([
            'question_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'question_ids.*' => [
                'required',
                'integer',
            ],
        ]);

        $submittedQuestionIds = collect($validated['question_ids'])
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Security: only questions actually attached to this exam
        |--------------------------------------------------------------------------
        */
        $attachedQuestionIds = DB::table('exam_question')
            ->where('exam_id', $exam->id)
            ->pluck('exam_question_id')
            ->map(fn ($id) => (int) $id)
            ->values();

        /*
        | Every submitted ID must belong to this exam.
        */
        if (
            $submittedQuestionIds->diff($attachedQuestionIds)->isNotEmpty()
        ) {
            abort(403, 'Invalid question for this exam.');
        }

        /*
        |--------------------------------------------------------------------------
        | Update order
        |--------------------------------------------------------------------------
        */
        DB::transaction(function () use (
            $exam,
            $submittedQuestionIds
        ) {
            foreach ($submittedQuestionIds as $index => $questionId) {
                DB::table('exam_question')
                    ->where('exam_id', $exam->id)
                    ->where('exam_question_id', $questionId)
                    ->update([
                        'sort_order' => $index,
                        'updated_at' => now(),
                    ]);
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Question order updated successfully.',
        ]);
    }


    /**
     * Remove a question from exam.
     */
    public function destroy(
        Exam $exam,
        ExamQuestion $question
    ) {
        $this->authorizeExam($exam);

        /*
        |--------------------------------------------------------------------------
        | Security: verify question is actually attached to this exam
        |--------------------------------------------------------------------------
        */
        $attached = DB::table('exam_question')
            ->where('exam_id', $exam->id)
            ->where('exam_question_id', $question->id)
            ->exists();

        abort_unless($attached, 404);

        /*
        |--------------------------------------------------------------------------
        | Remove question only from this exam
        |--------------------------------------------------------------------------
        */
        DB::table('exam_question')
            ->where('exam_id', $exam->id)
            ->where('exam_question_id', $question->id)
            ->delete();

        return redirect()
            ->route('exam-question-paper.index', $exam)
            ->with(
                'success',
                'Question removed from the exam.'
            );
    }


    /**
     * Verify exam belongs to current library.
     */
    private function authorizeExam(Exam $exam): void
    {
        $libraryId = Auth::user()->library_id;

        abort_unless($libraryId, 403);

        abort_unless(
            (int) $exam->library_id ===
            (int) $libraryId,
            403
        );
    }
}