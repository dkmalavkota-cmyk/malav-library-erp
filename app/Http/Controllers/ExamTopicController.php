<?php

namespace App\Http\Controllers;

use App\Models\ExamQuestion;
use App\Models\ExamSubject;
use App\Models\ExamTopic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamTopicController extends Controller
{
    /**
     * Get the currently logged-in user's library.
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
     * Display topics for a subject.
     */
    public function index(
        Request $request,
        ExamSubject $examSubject
    ): View {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        $search = trim(
            (string) $request->get('search')
        );

        $status = $request->get('status');

        $topics = $examSubject->topics()
            ->where('library_id', $libraryId)

            ->withCount([
                'questions' => function ($query) use ($libraryId) {
                    $query->where(
                        'library_id',
                        $libraryId
                    );
                }
            ])

            ->when(
                $search,
                function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        )->orWhere(
                            'description',
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
                function ($query) use ($status) {
                    $query->where(
                        'is_active',
                        $status === 'active'
                    );
                }
            )

            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $totalTopics = ExamTopic::query()
            ->where(
                'library_id',
                $libraryId
            )
            ->where(
                'subject_id',
                $examSubject->id
            )
            ->count();

        $activeTopics = ExamTopic::query()
            ->where(
                'library_id',
                $libraryId
            )
            ->where(
                'subject_id',
                $examSubject->id
            )
            ->where(
                'is_active',
                true
            )
            ->count();

        $inactiveTopics =
            $totalTopics - $activeTopics;

        return view(
            'exam-topics.index',
            compact(
                'examSubject',
                'topics',
                'search',
                'status',
                'totalTopics',
                'activeTopics',
                'inactiveTopics'
            )
        );
    }

    /**
     * Show create topic form.
     */
    public function create(
        ExamSubject $examSubject
    ): View {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        return view(
            'exam-topics.create',
            compact('examSubject')
        );
    }

    /**
     * Store a new topic.
     */
    public function store(
        Request $request,
        ExamSubject $examSubject
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:9999',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $topic = ExamTopic::create([
            'library_id' => $libraryId,

            'subject_id' => $examSubject->id,

            'name' => $validated['name'],

            'slug' => ExamTopic::makeSlug(
                $validated['name'],
                $examSubject->id
            ),

            'description' =>
                $validated['description'] ?? null,

            'sort_order' =>
                $validated['sort_order'] ?? 0,

            'is_active' =>
                $request->boolean(
                    'is_active',
                    true
                ),
        ]);

        return redirect()
            ->route(
                'exam-topics.index',
                $examSubject
            )
            ->with(
                'success',
                'Topic "' .
                $topic->name .
                '" created successfully.'
            );
    }

    /**
     * Display topic details.
     */
    public function show(
        ExamSubject $examSubject,
        ExamTopic $examTopic
    ): View {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        $this->authorizeTopic(
            $examTopic,
            $examSubject,
            $libraryId
        );

        $questions = ExamQuestion::query()
            ->where(
                'library_id',
                $libraryId
            )
            ->where(
                'subject_id',
                $examSubject->id
            )
            ->where(
                'topic_id',
                $examTopic->id
            )
            ->with('options')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();
                    $totalQuestions = $questions->count();

        $activeQuestions = $questions
            ->where('is_active', true)
            ->count();

        $inactiveQuestions = $totalQuestions - $activeQuestions;

        return view(
            'exam-topics.show',
                       compact(
                'examSubject',
                'examTopic',
                'questions',
                'totalQuestions',
                'activeQuestions',
                'inactiveQuestions'
            )
        );
    }

    /**
     * Show edit topic form.
     */
    public function edit(
        ExamSubject $examSubject,
        ExamTopic $examTopic
    ): View {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        $this->authorizeTopic(
            $examTopic,
            $examSubject,
            $libraryId
        );

        return view(
            'exam-topics.edit',
            compact(
                'examSubject',
                'examTopic'
            )
        );
    }

    /**
     * Update topic.
     */
    public function update(
        Request $request,
        ExamSubject $examSubject,
        ExamTopic $examTopic
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        $this->authorizeTopic(
            $examTopic,
            $examSubject,
            $libraryId
        );

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'sort_order' => [
                'nullable',
                'integer',
                'min:0',
                'max:9999',
            ],

            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $examTopic->update([
            'name' => $validated['name'],

            'slug' => ExamTopic::makeSlug(
                $validated['name'],
                $examSubject->id,
                $examTopic->id
            ),

            'description' =>
                $validated['description'] ?? null,

            'sort_order' =>
                $validated['sort_order'] ?? 0,

            'is_active' =>
                $request->boolean('is_active'),
        ]);

        return redirect()
            ->route(
                'exam-topics.show',
                [
                    'examSubject' => $examSubject,
                    'examTopic' => $examTopic,
                ]
            )
            ->with(
                'success',
                'Topic updated successfully.'
            );
    }

    /**
     * Delete topic.
     */
    public function destroy(
        ExamSubject $examSubject,
        ExamTopic $examTopic
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        $this->authorizeSubject(
            $examSubject,
            $libraryId
        );

        $this->authorizeTopic(
            $examTopic,
            $examSubject,
            $libraryId
        );

        $examTopic->delete();

        return redirect()
            ->route(
                'exam-topics.index',
                $examSubject
            )
            ->with(
                'success',
                'Topic deleted successfully.'
            );
    }

    /**
     * Ensure subject belongs to current library.
     */
    private function authorizeSubject(
        ExamSubject $examSubject,
        int $libraryId
    ): void {
        abort_unless(
            (int) $examSubject->library_id === $libraryId,
            404
        );
    }

    /**
     * Ensure topic belongs to subject and library.
     */
    private function authorizeTopic(
        ExamTopic $examTopic,
        ExamSubject $examSubject,
        int $libraryId
    ): void {
        abort_unless(
            (int) $examTopic->library_id === $libraryId,
            404
        );

        abort_unless(
            (int) $examTopic->subject_id ===
            (int) $examSubject->id,
            404
        );
    }
}