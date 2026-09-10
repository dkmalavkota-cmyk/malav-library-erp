<?php

namespace App\Http\Controllers;

use App\Models\ExamSubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExamSubjectController extends Controller
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
     * Display subjects.
     */
    public function index(Request $request): View
    {
        $libraryId = $this->libraryId();

        $search = trim(
            (string) $request->get('search')
        );

        $status = $request->get('status');

        $subjects = ExamSubject::query()
            ->where('library_id', $libraryId)
            ->withCount('topics')
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
                in_array($status, ['active', 'inactive'], true),
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

        $totalSubjects = ExamSubject::where(
            'library_id',
            $libraryId
        )->count();

        $activeSubjects = ExamSubject::where(
            'library_id',
            $libraryId
        )
            ->where('is_active', true)
            ->count();

        $inactiveSubjects = $totalSubjects - $activeSubjects;

        return view(
            'exam-subjects.index',
            compact(
                'subjects',
                'search',
                'status',
                'totalSubjects',
                'activeSubjects',
                'inactiveSubjects'
            )
        );
    }

    /**
     * Show create subject page.
     */
    public function create(): View
    {
        $this->libraryId();

        return view('exam-subjects.create');
    }

    /**
     * Store subject.
     */
    public function store(Request $request): RedirectResponse
    {
        $libraryId = $this->libraryId();

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

        $subject = ExamSubject::create([
            'library_id' => $libraryId,

            'name' => $validated['name'],

            'slug' => ExamSubject::makeSlug(
                $validated['name'],
                $libraryId
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
            ->route('exam-subjects.index')
            ->with(
                'success',
                'Subject "' .
                $subject->name .
                '" created successfully.'
            );
    }

    /**
     * Display subject details.
     */
    public function show(
        ExamSubject $examSubject
    ): View {
        $libraryId = $this->libraryId();

        abort_unless(
            (int) $examSubject->library_id === $libraryId,
            404
        );

        $examSubject->loadCount('topics');

        return view(
            'exam-subjects.show',
            compact('examSubject')
        );
    }

    /**
     * Show edit subject page.
     */
    public function edit(
        ExamSubject $examSubject
    ): View {
        $libraryId = $this->libraryId();

        abort_unless(
            (int) $examSubject->library_id === $libraryId,
            404
        );

        return view(
            'exam-subjects.edit',
            compact('examSubject')
        );
    }

    /**
     * Update subject.
     */
    public function update(
        Request $request,
        ExamSubject $examSubject
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        abort_unless(
            (int) $examSubject->library_id === $libraryId,
            404
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

        $examSubject->update([
            'name' => $validated['name'],

            'slug' => ExamSubject::makeSlug(
                $validated['name'],
                $libraryId,
                $examSubject->id
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
                'exam-subjects.show',
                $examSubject
            )
            ->with(
                'success',
                'Subject updated successfully.'
            );
    }

    /**
     * Delete subject.
     */
    public function destroy(
        ExamSubject $examSubject
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        abort_unless(
            (int) $examSubject->library_id === $libraryId,
            404
        );

        if ($examSubject->topics()->exists()) {
            return redirect()
                ->route(
                    'exam-subjects.index'
                )
                ->with(
                    'error',
                    'This subject contains topics and cannot be deleted. You can deactivate it instead.'
                );
        }

        $examSubject->delete();

        return redirect()
            ->route(
                'exam-subjects.index'
            )
            ->with(
                'success',
                'Subject deleted successfully.'
            );
    }
}