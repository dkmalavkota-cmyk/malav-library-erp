<?php

namespace App\Http\Controllers;

use App\Models\ExamCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamUserCategoryController extends Controller
{
    /**
     * Show category selection page.
     */
    public function edit()
    {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        $libraryIds = $examUser
            ->activeLibraryAccess()
            ->pluck('library_id');

        $categories = ExamCategory::query()
            ->whereIn('library_id', $libraryIds)
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $selectedCategoryIds = $examUser
            ->selectedCategories()
            ->whereIn('exam_categories.library_id', $libraryIds)
            ->pluck('exam_categories.id')
            ->toArray();

        return view(
            'exam-user.categories',
            compact(
                'examUser',
                'categories',
                'selectedCategoryIds'
            )
        );
    }

    /**
     * Save selected categories.
     */
    public function update(Request $request)
    {
        $examUser = Auth::guard('exam_user')->user();

        abort_unless($examUser, 401);

        $libraryIds = $examUser
            ->activeLibraryAccess()
            ->pluck('library_id');

        $validated = $request->validate([
            'categories' => [
                'required',
                'array',
                'min:1',
                'max:5',
            ],

            'categories.*' => [
                'integer',
                'distinct',
                'exists:exam_categories,id',
            ],
        ]);

        $categoryIds = ExamCategory::query()
            ->whereIn('library_id', $libraryIds)
            ->where('is_active', true)
            ->whereIn('id', $validated['categories'])
            ->pluck('id')
            ->toArray();

        if (count($categoryIds) !== count($validated['categories'])) {
            return back()
                ->withErrors([
                    'categories' => 'One or more selected categories are not available for your active library access.',
                ])
                ->withInput();
        }

        $examUser->selectedCategories()->sync($categoryIds);

        return redirect()
            ->route('exam-user.dashboard')
            ->with(
                'success',
                'Your preparation categories have been updated successfully.'
            );
    }
}