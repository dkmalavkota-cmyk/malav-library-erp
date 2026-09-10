<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class ExamUserDashboardController extends Controller
{
    /**
     * External / public examination dashboard.
     *
     * Access rules:
     * - Regular exams: only selected preparation categories.
     * - Current Affairs: available for the user's active library access.
     * - Major Tests: not shown to public users here because their
     *   special assignment flow belongs to library/student access.
     * - Exams from other libraries are never exposed.
     */
    public function index()
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

        /*
        |--------------------------------------------------------------------------
        | Selected Categories
        |--------------------------------------------------------------------------
        |
        | Only categories belonging to libraries that this user actually
        | has active access to are considered.
        |
        */

        $selectedCategoryIds = $examUser
            ->selectedCategories()
            ->whereIn('exam_categories.library_id', $libraryIds)
            ->pluck('exam_categories.id');

        /*
        |--------------------------------------------------------------------------
        | Available Exams
        |--------------------------------------------------------------------------
        |
        | Regular:
        |   selected categories only.
        |
        | Current Affairs:
        |   available for the user's authorized libraries.
        |
        | Major Test:
        |   intentionally excluded from public dashboard for now.
        |
        */

        $exams = Exam::query()
            ->where('is_active', true)
            ->where('is_published', true)

            // Never expose an exam outside the user's authorized libraries.
            ->whereIn('library_id', $libraryIds)

            // Exam must currently be available.
            ->where(function ($query) {
                $query
                    ->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query
                    ->whereNull('ends_at')
                    ->orWhere('ends_at', '>=', now());
            })

            // Public exam visibility rules.
            ->where(function ($query) use ($selectedCategoryIds) {

                // Regular exams require selected category access.
                $query
                    ->where(function ($regularQuery) use ($selectedCategoryIds) {
                        $regularQuery
                            ->where('exam_type', 'regular')
                            ->whereIn(
                                'exam_category_id',
                                $selectedCategoryIds
                            );
                    })

                    // Current Affairs is available to authorized users
                    // without requiring category selection.
                    ->orWhere('exam_type', 'current_affairs');
            })

            ->with('category')
            ->latest()
            ->get();

        return view(
            'exam-user.dashboard',
            compact(
                'examUser',
                'exams'
            )
        );
    }
}