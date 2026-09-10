<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ExamCategoryController extends Controller
{
    /**
     * Get the currently logged-in user's library.
     */
    private function libraryId(): int
    {
        $libraryId = auth()->user()?->library_id;

        abort_unless($libraryId, 403, 'No library is assigned to this account.');

        return (int) $libraryId;
    }

    /**
     * Display categories.
     */
    public function index(Request $request): View
    {
        $libraryId = $this->libraryId();

        $search = trim((string) $request->get('search'));

        $categories = ExamCategory::query()
            ->where('library_id', $libraryId)
            ->withCount('exams')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('sort_order')
            ->orderBy('name')
            ->paginate(12)
            ->withQueryString();

        $totalCategories = ExamCategory::where(
            'library_id',
            $libraryId
        )->count();

        $activeCategories = ExamCategory::where(
            'library_id',
            $libraryId
        )
            ->where('is_active', true)
            ->count();

        $totalExams = ExamCategory::where(
            'library_id',
            $libraryId
        )
            ->withCount('exams')
            ->get()
            ->sum('exams_count');

        return view(
            'exam-categories.index',
            compact(
                'categories',
                'search',
                'totalCategories',
                'activeCategories',
                'totalExams'
            )
        );
    }

    /**
     * Show create page.
     */
    public function create(): View
    {
        return view('exam-categories.create');
    }

    /**
 * Show edit page.
 */
public function edit(ExamCategory $examCategory): View
{
    $libraryId = $this->libraryId();

    abort_unless(
        (int) $examCategory->library_id === $libraryId,
        404
    );

    return view(
        'exam-categories.edit',
        compact('examCategory')
    );
}

    /**
     * Store category.
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

        $category = ExamCategory::create([
            'library_id' => $libraryId,
            'name' => $validated['name'],
            'slug' => ExamCategory::makeSlug(
                $validated['name'],
                $libraryId
            ),
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('exam-categories.index')
            ->with(
                'success',
                'Exam category "' . $category->name . '" created successfully.'
            );
    }

    /**
     * Update category.
     */
    public function update(
        Request $request,
        ExamCategory $examCategory
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        abort_unless(
            (int) $examCategory->library_id === $libraryId,
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

        $examCategory->update([
            'name' => $validated['name'],
            'slug' => ExamCategory::makeSlug(
                $validated['name'],
                $libraryId,
                $examCategory->id
            ),
            'description' => $validated['description'] ?? null,
            'sort_order' => $validated['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()
            ->route('exam-categories.index')
            ->with(
                'success',
                'Exam category updated successfully.'
            );
    }

    /**
     * Delete category.
     */
    public function destroy(
        ExamCategory $examCategory
    ): RedirectResponse {
        $libraryId = $this->libraryId();

        abort_unless(
            (int) $examCategory->library_id === $libraryId,
            404
        );

        if ($examCategory->exams()->exists()) {
            return redirect()
                ->route('exam-categories.index')
                ->with(
                    'error',
                    'This category contains exams and cannot be deleted. You can deactivate it instead.'
                );
        }

        $examCategory->delete();

        return redirect()
            ->route('exam-categories.index')
            ->with(
                'success',
                'Exam category deleted successfully.'
            );
    }
}