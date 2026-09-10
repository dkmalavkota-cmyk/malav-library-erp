<?php

namespace App\Http\Controllers;

use App\Exports\ExamQuestionsExport;
use App\Models\ExamQuestion;
use App\Models\ExamSubject;
use App\Models\ExamTopic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class ExamQuestionController extends Controller
{
    /**
     * Get current user's library ID.
     */
    private function libraryId(): int
    {
        $libraryId = auth()->user()?->library_id;

        abort_unless(
            $libraryId,
            403,
            'No library is assigned to this account.'
        );

        return (int) $libraryId;
    }

    /**
     * Ensure subject belongs to current library.
     */
    private function authorizeSubject(ExamSubject $subject): void
    {
        abort_unless(
            (int) $subject->library_id === $this->libraryId(),
            404
        );
    }

    /**
     * Ensure topic belongs to current library
     * and selected subject.
     */
    private function authorizeTopic(
        ExamSubject $subject,
        ExamTopic $topic
    ): void {
        $this->authorizeSubject($subject);

        abort_unless(
            (int) $topic->library_id === $this->libraryId()
            && (int) $topic->subject_id === (int) $subject->id,
            404
        );
    }

    /**
     * Ensure question belongs to current library,
     * subject and topic.
     */
    private function authorizeQuestion(
        ExamSubject $subject,
        ExamTopic $topic,
        ExamQuestion $question
    ): void {
        $this->authorizeTopic($subject, $topic);

        abort_unless(
            (int) $question->library_id === $this->libraryId()
            && (int) $question->subject_id === (int) $subject->id
            && (int) $question->topic_id === (int) $topic->id,
            404
        );
    }

    /**
     * Normalize question type.
     *
     * The current examination engine supports option-based questions.
     * Therefore short_answer is intentionally not accepted yet.
     */
    private function normalizeQuestionType(?string $type): string
    {
        return in_array($type, ['mcq', 'true_false'], true)
            ? $type
            : 'mcq';
    }

    /**
     * Build normalized options for a question.
     */
    private function normalizeOptions(
        string $questionType,
        array $options,
        ?int $correctOption = null,
        ?string $trueFalseAnswer = null
    ): array {
        if ($questionType === 'true_false') {
            $answer = strtolower(
                trim((string) $trueFalseAnswer)
            );

            if (!in_array($answer, ['true', 'false'], true)) {
                abort(
                    422,
                    'Please select True or False as the correct answer.'
                );
            }

            return [
                [
                    'option_text' => 'True',
                'is_correct' => $answer === 'true',
                    'sort_order' => 1,
                ],
                [
'option_text' => 'False',
                'is_correct' => $answer === 'false',
                    'sort_order' => 2,
                ],
            ];
        }

        if (
            $correctOption === null
            || !array_key_exists($correctOption, $options)
        ) {
            abort(
                422,
                'Please select a valid correct answer.'
            );
        }

        return collect($options)
            ->values()
            ->map(
                function (array $option, int $index) use ($correctOption) {
                    return [
                        'option_text' => trim((string) ($option['text'] ?? '')),
                        'is_correct' => $index === $correctOption,
                        'sort_order' => $index + 1,
                    ];
                }
            )
            ->all();
    }

    /*
    |--------------------------------------------------------------------------
    | STANDALONE QUESTION BANK
    |--------------------------------------------------------------------------
    */

    /**
     * Display complete question bank
     * for the current library.
     */
    public function questionBank(Request $request): View
    {
        $libraryId = $this->libraryId();

        $search = trim((string) $request->get('search'));
        $status = $request->get('status');
        $difficulty = $request->get('difficulty');
        $subjectId = $request->get('subject_id');
        $topicId = $request->get('topic_id');

        $subjects = ExamSubject::query()
            ->where('library_id', $libraryId)
            ->where('is_active', true)
            ->with([
                'topics' => function ($query) use ($libraryId) {
                    $query
                        ->where('library_id', $libraryId)
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('name');
                },
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $topics = collect();

        if ($subjectId) {
            $selectedSubject = $subjects->firstWhere(
                'id',
                (int) $subjectId
            );

            if ($selectedSubject) {
                $topics = $selectedSubject->topics;
            }
        }

        $questions = ExamQuestion::query()
            ->where('library_id', $libraryId)
            ->when(
                $search,
                function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where(
                            'question_text',
                            'like',
                            '%' . $search . '%'
                        )
                            ->orWhere(
                                'explanation',
                                'like',
                                '%' . $search . '%'
                            );
                    });
                }
            )
            ->when(
                $subjectId,
                fn ($query) => $query->where(
                    'subject_id',
                    $subjectId
                )
            )
            ->when(
                $topicId,
                fn ($query) => $query->where(
                    'topic_id',
                    $topicId
                )
            )
            ->when(
                in_array(
                    $status,
                    ['active', 'inactive'],
                    true
                ),
                function ($query) use ($status) {
                    $query->where(
                        'is_active',
                        $status === 'active'
                    );
                }
            )
            ->when(
                in_array(
                    $difficulty,
                    ['Easy', 'Medium', 'Hard'],
                    true
                ),
                fn ($query) => $query->where(
                    'difficulty',
                    $difficulty
                )
            )
            ->with([
                'options',
                'subject',
                'topic',
            ])
            ->orderBy('subject_id')
            ->orderBy('topic_id')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $totalQuestions = ExamQuestion::query()
            ->where('library_id', $libraryId)
            ->count();

        $activeQuestions = ExamQuestion::query()
            ->where('library_id', $libraryId)
            ->where('is_active', true)
            ->count();

        $inactiveQuestions =
            $totalQuestions - $activeQuestions;

        return view(
            'exam-questions.question-bank',
            compact(
                'questions',
                'subjects',
                'topics',
                'search',
                'status',
                'difficulty',
                'subjectId',
                'topicId',
                'totalQuestions',
                'activeQuestions',
                'inactiveQuestions'
            )
        );
    }

    /**
     * Show standalone question creation form.
     */
    public function questionBankCreate(): View
    {
        $libraryId = $this->libraryId();

        $subjects = ExamSubject::query()
            ->where('library_id', $libraryId)
            ->where('is_active', true)
            ->with([
                'topics' => function ($query) use ($libraryId) {
                    $query
                        ->where('library_id', $libraryId)
                        ->where('is_active', true)
                        ->orderBy('sort_order')
                        ->orderBy('name');
                },
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'exam-questions.question-bank-create',
            compact('subjects')
        );
    }

    /**
     * Store question from standalone Question Bank.
     */
    public function questionBankStore(
        Request $request
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        $validated = $request->validate([
            'subject_id' => [
                'required',
                'integer',
                Rule::exists('exam_subjects', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'library_id',
                            $libraryId
                        )
                    ),
            ],

            'topic_id' => [
                'required',
                'integer',
                Rule::exists('exam_topics', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'library_id',
                            $libraryId
                        )
                    ),
            ],

            'question_text' => [
                'required',
                'string',
                'max:10000',
            ],

            'question_type' => [
                'required',
                'in:mcq,true_false',
            ],

            'explanation' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'marks' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'negative_marks' => [
                'nullable',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'difficulty' => [
                'required',
                'in:Easy,Medium,Hard',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'options' => [
                'nullable',
                'array',
                'min:2',
                'max:6',
            ],

            'options.*.text' => [
                'required',
                'string',
                'max:2000',
            ],

            'correct_option' => [
                'nullable',
                'integer',
                'min:0',
                'max:5',
            ],

            'tf_answer' => [
                'nullable',
                'in:true,false',
            ],
        ]);

        $questionType = $this->normalizeQuestionType(
            $validated['question_type']
        );

        if ($questionType === 'mcq') {
            if (
                empty($validated['options'])
                || count($validated['options']) < 2
            ) {
                return back()
                    ->withErrors([
                        'options' =>
                            'MCQ requires at least 2 options.',
                    ])
                    ->withInput();
            }

            if (
                !array_key_exists(
                    (int) ($validated['correct_option'] ?? -1),
                    $validated['options']
                )
            ) {
                return back()
                    ->withErrors([
                        'correct_option' =>
                            'Please select a valid correct answer.',
                    ])
                    ->withInput();
            }
        }

        if (
            $questionType === 'true_false'
            && empty($validated['tf_answer'])
        ) {
            return back()
                ->withErrors([
                    'tf_answer' =>
                        'Please select True or False.',
                ])
                ->withInput();
        }

        $subject = ExamSubject::query()
            ->where('id', $validated['subject_id'])
            ->where('library_id', $libraryId)
            ->firstOrFail();

        $topic = ExamTopic::query()
            ->where('id', $validated['topic_id'])
            ->where('library_id', $libraryId)
            ->where('subject_id', $subject->id)
            ->first();

        if (!$topic) {
            return back()
                ->withErrors([
                    'topic_id' =>
                        'The selected topic does not belong to the selected subject.',
                ])
                ->withInput();
        }

        $options = $this->normalizeOptions(
            $questionType,
            $validated['options'] ?? [],
            isset($validated['correct_option'])
                ? (int) $validated['correct_option']
                : null,
            $validated['tf_answer'] ?? null
        );

        DB::transaction(function () use (
            $validated,
            $options,
            $subject,
            $topic,
            $libraryId,
            $questionType
        ) {
            $nextOrder = (
                (int) ExamQuestion::query()
                    ->where('library_id', $libraryId)
                    ->where('subject_id', $subject->id)
                    ->where('topic_id', $topic->id)
                    ->max('sort_order')
            ) + 1;

            $question = ExamQuestion::create([
                'library_id' => $libraryId,
                'subject_id' => $subject->id,
                'topic_id' => $topic->id,
                'question_text' => $validated['question_text'],
                'question_type' => $questionType,
                'explanation' => $validated['explanation'] ?? null,
                'marks' => $validated['marks'],
                'negative_marks' =>
                    $validated['negative_marks'] ?? 0,
                'difficulty' => $validated['difficulty'],
                'sort_order' =>
                    $validated['sort_order'] ?? $nextOrder,
                'is_active' =>
                    request()->boolean('is_active', true),
            ]);

            foreach ($options as $option) {
                $question->options()->create($option);
            }
        });

        return redirect()
            ->route('question-bank.index')
            ->with(
                'success',
                'Question added successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | SUBJECT â†’ TOPIC â†’ QUESTIONS
    |--------------------------------------------------------------------------
    */
    /**
     * Export question bank questions to Excel.
     */
    public function export(Request $request)
    {
        $libraryId = $this->libraryId();

        $subjectId = $request->filled('subject_id')
            ? (int) $request->input('subject_id')
            : null;

        $topicId = $request->filled('topic_id')
            ? (int) $request->input('topic_id')
            : null;

        $search = trim((string) $request->input('search'));

        $status = $request->input('status');

        $difficulty = $request->input('difficulty');

        return Excel::download(
            new ExamQuestionsExport(
                libraryId: $libraryId,
                subjectId: $subjectId,
                topicId: $topicId,
                search: $search ?: null,
                status: $status,
                difficulty: $difficulty,
            ),
            'question-bank-' . now()->format('Y-m-d-His') . '.xlsx'
        );
    }
    /**
     * Display questions for a topic.
     */
    public function index(
        ExamSubject $subject,
        ExamTopic $topic,
        Request $request
    ): View {
        $this->authorizeTopic($subject, $topic);

        $search = trim((string) $request->get('search'));
        $status = $request->get('status');
        $difficulty = $request->get('difficulty');

        $questions = ExamQuestion::query()
            ->where('library_id', $this->libraryId())
            ->where('subject_id', $subject->id)
            ->where('topic_id', $topic->id)
            ->when(
                $search,
                function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where(
                            'question_text',
                            'like',
                            '%' . $search . '%'
                        )
                            ->orWhere(
                                'explanation',
                                'like',
                                '%' . $search . '%'
                            );
                    });
                }
            )
            ->when(
                in_array(
                    $status,
                    ['active', 'inactive'],
                    true
                ),
                fn ($query) => $query->where(
                    'is_active',
                    $status === 'active'
                )
            )
            ->when(
                in_array(
                    $difficulty,
                    ['Easy', 'Medium', 'Hard'],
                    true
                ),
                fn ($query) => $query->where(
                    'difficulty',
                    $difficulty
                )
            )
            ->with('options')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(15)
            ->withQueryString();

        $totalQuestions = ExamQuestion::query()
            ->where('library_id', $this->libraryId())
            ->where('subject_id', $subject->id)
            ->where('topic_id', $topic->id)
            ->count();

        $activeQuestions = ExamQuestion::query()
            ->where('library_id', $this->libraryId())
            ->where('subject_id', $subject->id)
            ->where('topic_id', $topic->id)
            ->where('is_active', true)
            ->count();

        $inactiveQuestions =
            $totalQuestions - $activeQuestions;

        return view(
            'exam-questions.index',
            compact(
                'subject',
                'topic',
                'questions',
                'search',
                'status',
                'difficulty',
                'totalQuestions',
                'activeQuestions',
                'inactiveQuestions'
            )
        );
    }

        /**
     * Import questions from Excel.
     */
    public function import(Request $request)
    {
        $this->libraryId();

        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240',
            ],
        ]);

        $import = new \App\Imports\ExamQuestionsImport(
            $this->libraryId()
        );

        try {
            \Maatwebsite\Excel\Facades\Excel::import(
                $import,
                $request->file('file')
            );
        } catch (\Throwable $e) {
            return back()
                ->withErrors([
                    'file' => $e->getMessage(),
                ])
                ->withInput();
        }

        return back()->with(
            'success',
            $import->importedCount()
            . ' questions imported successfully.'
        );
    }

    /**
     * Show create question form inside topic.
     */
    public function create(
        ExamSubject $subject,
        ExamTopic $topic
    ): View {
        $this->authorizeTopic($subject, $topic);

        return view(
            'exam-questions.create',
            compact(
                'subject',
                'topic'
            )
        );
    }

    /**
     * Store question inside topic.
     */
    public function store(
        Request $request,
        ExamSubject $subject,
        ExamTopic $topic
    ): RedirectResponse {
        $this->authorizeTopic($subject, $topic);

        $validated = $request->validate([
            'question_text' => [
                'required',
                'string',
                'max:10000',
            ],

            'question_type' => [
                'required',
                'in:mcq,true_false',
            ],

            'explanation' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'marks' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'negative_marks' => [
                'nullable',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'difficulty' => [
                'required',
                'in:Easy,Medium,Hard',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'options' => [
                'nullable',
                'array',
                'min:2',
                'max:6',
            ],

            'options.*.text' => [
                'required',
                'string',
                'max:2000',
            ],

            'correct_option' => [
                'nullable',
                'integer',
                'min:0',
                'max:5',
            ],

            'tf_answer' => [
                'nullable',
                'in:true,false',
            ],
        ]);

        $questionType = $this->normalizeQuestionType(
            $validated['question_type']
        );

        if ($questionType === 'mcq') {
            if (
                empty($validated['options'])
                || count($validated['options']) < 2
            ) {
                return back()
                    ->withErrors([
                        'options' =>
                            'MCQ requires at least 2 options.',
                    ])
                    ->withInput();
            }

            if (
                !array_key_exists(
                    (int) ($validated['correct_option'] ?? -1),
                    $validated['options']
                )
            ) {
                return back()
                    ->withErrors([
                        'correct_option' =>
                            'Please select a valid correct answer.',
                    ])
                    ->withInput();
            }
        }

        if (
            $questionType === 'true_false'
            && empty($validated['tf_answer'])
        ) {
            return back()
                ->withErrors([
                    'tf_answer' =>
                        'Please select True or False.',
                ])
                ->withInput();
        }

        $options = $this->normalizeOptions(
            $questionType,
            $validated['options'] ?? [],
            isset($validated['correct_option'])
                ? (int) $validated['correct_option']
                : null,
            $validated['tf_answer'] ?? null
        );

        DB::transaction(function () use (
            $validated,
            $options,
            $subject,
            $topic,
            $questionType
        ) {
            $nextOrder = (
                (int) ExamQuestion::query()
                    ->where(
                        'library_id',
                        $this->libraryId()
                    )
                    ->where(
                        'subject_id',
                        $subject->id
                    )
                    ->where(
                        'topic_id',
                        $topic->id
                    )
                    ->max('sort_order')
            ) + 1;

            $question = ExamQuestion::create([
                'library_id' => $this->libraryId(),
                'subject_id' => $subject->id,
                'topic_id' => $topic->id,
                'question_text' =>
                    $validated['question_text'],
                'question_type' => $questionType,
                'explanation' =>
                    $validated['explanation'] ?? null,
                'marks' => $validated['marks'],
                'negative_marks' =>
                    $validated['negative_marks'] ?? 0,
                'difficulty' => $validated['difficulty'],
                'sort_order' =>
                    $validated['sort_order'] ?? $nextOrder,
                'is_active' =>
                    request()->boolean(
                        'is_active',
                        true
                    ),
            ]);

            foreach ($options as $option) {
                $question->options()->create($option);
            }
        });

        return redirect()
            ->route(
                'exam-questions.index',
                [$subject, $topic]
            )
            ->with(
                'success',
                'Question added successfully.'
            );
    }

    /**
     * Display a question.
     */
    public function show(
        ExamSubject $subject,
        ExamTopic $topic,
        ExamQuestion $question
    ): View {
        $this->authorizeQuestion(
            $subject,
            $topic,
            $question
        );

        $question->load([
            'options',
            'subject',
            'topic',
        ]);

        return view(
            'exam-questions.show',
            compact(
                'subject',
                'topic',
                'question'
            )
        );
    }

    /**
     * Show edit question form.
     */
    public function edit(
        ExamSubject $subject,
        ExamTopic $topic,
        ExamQuestion $question
    ): View {
        $this->authorizeQuestion(
            $subject,
            $topic,
            $question
        );

        $question->load('options');

        return view(
            'exam-questions.edit',
            compact(
                'subject',
                'topic',
                'question'
            )
        );
    }

    /**
     * Update question.
     */
    public function update(
        Request $request,
        ExamSubject $subject,
        ExamTopic $topic,
        ExamQuestion $question
    ): RedirectResponse {
        $this->authorizeQuestion(
            $subject,
            $topic,
            $question
        );

        $validated = $request->validate([
            'question_text' => [
                'required',
                'string',
                'max:10000',
            ],

            'question_type' => [
                'required',
                'in:mcq,true_false',
            ],

            'explanation' => [
                'nullable',
                'string',
                'max:10000',
            ],

            'marks' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'negative_marks' => [
                'nullable',
                'numeric',
                'min:0',
                'max:999999.99',
            ],

            'difficulty' => [
                'required',
                'in:Easy,Medium,Hard',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:999999',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],

            'options' => [
                'nullable',
                'array',
                'min:2',
                'max:6',
            ],

            'options.*.text' => [
                'required',
                'string',
                'max:2000',
            ],

            'correct_option' => [
                'nullable',
                'integer',
                'min:0',
                'max:5',
            ],

            'tf_answer' => [
                'nullable',
                'in:true,false',
            ],
        ]);

        $questionType = $this->normalizeQuestionType(
            $validated['question_type']
        );

        if ($questionType === 'mcq') {
            if (
                empty($validated['options'])
                || count($validated['options']) < 2
            ) {
                return back()
                    ->withErrors([
                        'options' =>
                            'MCQ requires at least 2 options.',
                    ])
                    ->withInput();
            }

            if (
                !array_key_exists(
                    (int) ($validated['correct_option'] ?? -1),
                    $validated['options']
                )
            ) {
                return back()
                    ->withErrors([
                        'correct_option' =>
                            'Please select a valid correct answer.',
                    ])
                    ->withInput();
            }
        }

        if (
            $questionType === 'true_false'
            && empty($validated['tf_answer'])
        ) {
            return back()
                ->withErrors([
                    'tf_answer' =>
                        'Please select True or False.',
                ])
                ->withInput();
        }

        $options = $this->normalizeOptions(
            $questionType,
            $validated['options'] ?? [],
            isset($validated['correct_option'])
                ? (int) $validated['correct_option']
                : null,
            $validated['tf_answer'] ?? null
        );

        DB::transaction(function () use (
            $validated,
            $options,
            $question,
            $questionType
        ) {
            $question->update([
                'question_text' =>
                    $validated['question_text'],
                'question_type' => $questionType,
                'explanation' =>
                    $validated['explanation'] ?? null,
                'marks' => $validated['marks'],
                'negative_marks' =>
                    $validated['negative_marks'] ?? 0,
                'difficulty' =>
                    $validated['difficulty'],
                'sort_order' =>
                    $validated['sort_order']
                    ?? $question->sort_order,
                'is_active' =>
                    request()->boolean('is_active'),
            ]);

            $question->options()->delete();

            foreach ($options as $option) {
                $question->options()->create($option);
            }
        });

        return redirect()
            ->route(
                'exam-questions.index',
                [$subject, $topic]
            )
            ->with(
                'success',
                'Question updated successfully.'
            );
    }

    /**
     * Delete question.
     */
    public function destroy(
        ExamSubject $subject,
        ExamTopic $topic,
        ExamQuestion $question
    ): RedirectResponse {
        $this->authorizeQuestion(
            $subject,
            $topic,
            $question
        );

        $question->delete();

        return redirect()
            ->route(
                'exam-questions.index',
                [$subject, $topic]
            )
            ->with(
                'success',
                'Question deleted successfully.'
            );
    }
}

