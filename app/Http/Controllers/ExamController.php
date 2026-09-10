<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    /**
     * Display all exams.
     */
    public function index()
    {
        $libraryId = Auth::user()->library_id;

        abort_unless($libraryId, 403);

        $exams = Exam::with('category')
            ->where('library_id', $libraryId)
            ->latest()
            ->paginate(12);

        return view(
            'exams.index',
            compact('exams')
        );
    }

    /**
     * Show create exam form.
     */
    public function create()
    {
        $libraryId = Auth::user()->library_id;

        abort_unless($libraryId, 403);

        $categories = ExamCategory::where(
            'library_id',
            $libraryId
        )
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'exams.create',
            compact('categories')
        );
    }

    /**
     * Store exam.
     */
    public function store(Request $request)
    {
        $libraryId = Auth::user()->library_id;

        abort_unless($libraryId, 403);

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'exam_type' => [
                'required',
                Rule::in([
                    'regular',
                    'current_affairs',
                    'major_test',
                ]),
            ],

            /*
            |--------------------------------------------------------------------------
            | Category
            |--------------------------------------------------------------------------
            |
            | Current exam schema uses a category for every exam type.
            | Keep the category library-scoped so another library's
            | category can never be attached.
            |
            */

            'exam_category_id' => [
                'required',
                'integer',
                Rule::exists('exam_categories', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'library_id',
                            $libraryId
                        )
                    ),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'min:1',
            ],

            'total_marks' => [
                'required',
                'integer',
                'min:1',
            ],

            'passing_marks' => [
                'required',
                'integer',
                'min:0',
            ],

            'negative_marking' => [
                'nullable',
                'boolean',
            ],

            'negative_marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'attempt_limit' => [
                'required',
                'integer',
                'min:1',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Passing Marks
        |--------------------------------------------------------------------------
        */

        if (
            (int) $validated['passing_marks'] >
            (int) $validated['total_marks']
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'passing_marks' =>
                        'Passing marks cannot be greater than total marks.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Normalize Boolean Fields
        |--------------------------------------------------------------------------
        */

        $validated['library_id'] = $libraryId;

        $validated['negative_marking'] =
            $request->boolean('negative_marking');

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['is_published'] =
            $request->boolean('is_published');

        /*
        |--------------------------------------------------------------------------
        | Generate Library-Scoped Slug
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug($validated['title']);

        if ($baseSlug === '') {
            $baseSlug = 'exam';
        }

        $slug = $baseSlug;
        $counter = 2;

        while (
            Exam::where('library_id', $libraryId)
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        $validated['slug'] = $slug;

        /*
        |--------------------------------------------------------------------------
        | Create Exam
        |--------------------------------------------------------------------------
        */

        $exam = Exam::create($validated);

        return redirect()
            ->route('exams.show', $exam)
            ->with(
                'success',
                'Exam created successfully.'
            );
    }

    /**
     * Display exam management page.
     */
    public function show(Exam $exam)
    {
        $this->authorizeExam($exam);

        $exam->load([
            'category',
            'questions.subject',
            'questions.topic',
            'questions.options',
        ]);

        $questionCount = $exam->questions->count();

        $questionMarks = $exam->questions->sum(
            function ($question) {
                return $question->pivot->marks !== null
                    ? (float) $question->pivot->marks
                    : (float) ($question->marks ?? 0);
            }
        );

        $remainingMarks = max(
            0,
            (float) $exam->total_marks -
            (float) $questionMarks
        );

        return view('exams.show', [
            'exam' => $exam,
            'questionCount' => $questionCount,
            'questionMarks' => $questionMarks,
            'remainingMarks' => $remainingMarks,
        ]);
    }

    /**
     * Display results of an exam.
     */
    public function results(Exam $exam)
    {
        $this->authorizeExam($exam);

        $attempts = ExamAttempt::with([
            'student',
            'examUser',
        ])
            ->where('exam_id', $exam->id)
            ->where(
                'library_id',
                Auth::user()->library_id
            )
            ->whereIn('status', [
                'submitted',
                'expired',
            ])
            ->latest('submitted_at')
            ->paginate(20);

        /*
        |--------------------------------------------------------------------------
        | Important
        |--------------------------------------------------------------------------
        |
        | The actual results page is:
 resources/views/exams/results.blade.php        |
        */

        return view(
    'exams.results',
    compact(
        'exam',
        'attempts'
    )
);
    }

    /**
     * Show detailed result of a specific attempt.
     */
    public function attemptResult(
        Exam $exam,
        ExamAttempt $attempt
    ) {
        $this->authorizeExam($exam);

        abort_unless(
            (int) $attempt->exam_id ===
            (int) $exam->id,
            404
        );

        abort_unless(
            (int) $attempt->library_id ===
            (int) Auth::user()->library_id,
            403
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
            'student',
            'examUser',
            'answers.question.options',
            'exam.category',
        ]);

        return view(
            'exams.attempt-result',
            compact(
                'exam',
                'attempt'
            )
        );
    }

    /**
     * Show edit form.
     */
    public function edit(Exam $exam)
    {
        $this->authorizeExam($exam);

        $libraryId = Auth::user()->library_id;

        $categories = ExamCategory::where(
            'library_id',
            $libraryId
        )
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'exams.edit',
            compact(
                'exam',
                'categories'
            )
        );
    }

    /**
     * Update exam.
     */
    public function update(
        Request $request,
        Exam $exam
    ) {
        $this->authorizeExam($exam);

        $libraryId = Auth::user()->library_id;

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'exam_type' => [
                'required',
                Rule::in([
                    'regular',
                    'current_affairs',
                    'major_test',
                ]),
            ],

            'exam_category_id' => [
                'required',
                'integer',
                Rule::exists('exam_categories', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'library_id',
                            $libraryId
                        )
                    ),
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'duration_minutes' => [
                'required',
                'integer',
                'min:1',
            ],

            'total_marks' => [
                'required',
                'integer',
                'min:1',
            ],

            'passing_marks' => [
                'required',
                'integer',
                'min:0',
            ],

            'negative_marking' => [
                'nullable',
                'boolean',
            ],

            'negative_marks' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'attempt_limit' => [
                'required',
                'integer',
                'min:1',
            ],

            'starts_at' => [
                'nullable',
                'date',
            ],

            'ends_at' => [
                'nullable',
                'date',
                'after_or_equal:starts_at',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'is_published' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Passing Marks
        |--------------------------------------------------------------------------
        */

        if (
            (int) $validated['passing_marks'] >
            (int) $validated['total_marks']
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'passing_marks' =>
                        'Passing marks cannot be greater than total marks.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Normalize Boolean Fields
        |--------------------------------------------------------------------------
        */

        $validated['negative_marking'] =
            $request->boolean('negative_marking');

        $validated['is_active'] =
            $request->boolean('is_active');

        $validated['is_published'] =
            $request->boolean('is_published');

        /*
        |--------------------------------------------------------------------------
        | Update Exam
        |--------------------------------------------------------------------------
        |
        | Slug intentionally remains stable when title changes.
        | Existing exam URLs therefore remain reliable.
        |
        */

        $exam->update($validated);

        return redirect()
            ->route('exams.show', $exam)
            ->with(
                'success',
                'Exam updated successfully.'
            );
    }

    /**
     * Delete exam.
     */
    public function destroy(Exam $exam)
    {
        $this->authorizeExam($exam);

        $exam->delete();

        return redirect()
            ->route('exams.index')
            ->with(
                'success',
                'Exam deleted successfully.'
            );
    }

    /**
     * Verify exam belongs to current library.
     */
    private function authorizeExam(
        Exam $exam
    ): void {
        $libraryId = Auth::user()->library_id;

        abort_unless(
            $libraryId,
            403
        );

        abort_unless(
            (int) $exam->library_id ===
            (int) $libraryId,
            403
        );
    }
}