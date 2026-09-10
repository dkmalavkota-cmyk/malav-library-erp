<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CurrentAffairsController extends Controller
{
    /**
     * Current Affairs management dashboard.
     *
     * Shows only current-affairs exams belonging to
     * the authenticated user's library.
     */
    public function index(Request $request)
    {
        $libraryId = $this->libraryId();

        $query = Exam::query()
            ->with('category')
            ->where('library_id', $libraryId)
            ->where('exam_type', 'current_affairs');

        /*
         * Month filter.
         *
         * Example:
         * ?month=2026-09
         *
         * We filter by starts_at so tests created for a particular
         * month are grouped naturally without adding another DB column.
         */
        $month = $request->input('month');

        if ($month && preg_match('/^\d{4}-\d{2}$/', $month)) {
            [$year, $monthNumber] = explode('-', $month);

            $query
                ->whereNotNull('starts_at')
                ->whereYear('starts_at', (int) $year)
                ->whereMonth('starts_at', (int) $monthNumber);
        }

        $exams = $query
            ->latest('starts_at')
            ->latest('id')
            ->paginate(12)
            ->withQueryString();

        /*
         * Available months for the month selector.
         *
         * No hard-coded "2 tests per month" logic.
         * Whatever number of Current Affairs tests admin creates
         * will appear automatically.
         */
        $availableMonths = Exam::query()
            ->where('library_id', $libraryId)
            ->where('exam_type', 'current_affairs')
            ->whereNotNull('starts_at')
            ->selectRaw('YEAR(starts_at) as year, MONTH(starts_at) as month')
            ->groupByRaw('YEAR(starts_at), MONTH(starts_at)')
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get();

        $statsQuery = Exam::query()
            ->where('library_id', $libraryId)
            ->where('exam_type', 'current_affairs');

        $totalTests = (clone $statsQuery)->count();

        $activeTests = (clone $statsQuery)
            ->where('is_active', true)
            ->where('is_published', true)
            ->count();

        $upcomingTests = (clone $statsQuery)
            ->where(function ($q) {
                $q->whereNull('starts_at')
                    ->orWhere('starts_at', '>', now());
            })
            ->count();

        $completedTests = (clone $statsQuery)
            ->whereNotNull('ends_at')
            ->where('ends_at', '<', now())
            ->count();

        return view('current-affairs.index', compact(
            'exams',
            'availableMonths',
            'month',
            'totalTests',
            'activeTests',
            'upcomingTests',
            'completedTests'
        ));
    }

    /**
     * Redirect to the existing Exam creation system.
     *
     * Current Affairs still uses the shared Exam engine.
     */
    public function create()
    {
        $this->libraryId();

        return redirect()->route('exams.create', [
            'exam_type' => 'current_affairs',
        ]);
    }

    /**
     * Store a Current Affairs exam through the shared Exam engine.
     *
     * We intentionally do not duplicate ExamController's creation logic.
     */
    public function store(Request $request)
    {
        $this->libraryId();

        return redirect()
            ->route('exams.create', [
                'exam_type' => 'current_affairs',
            ])
            ->with('info', 'Current Affairs tests are created using the shared Exam system.');
    }

    /**
     * Show a Current Affairs exam using the existing Exam details page.
     */
    public function show(Exam $exam)
    {
        $this->authorizeExam($exam);

        abort_unless($exam->exam_type === 'current_affairs', 404);

        return redirect()->route('exams.show', $exam);
    }

    /**
     * Edit a Current Affairs exam using the existing Exam editor.
     */
    public function edit(Exam $exam)
    {
        $this->authorizeExam($exam);

        abort_unless($exam->exam_type === 'current_affairs', 404);

        return redirect()->route('exams.edit', $exam);
    }

    /**
     * Update is intentionally delegated to the shared Exam engine.
     */
    public function update(Request $request, Exam $exam)
    {
        $this->authorizeExam($exam);

        abort_unless($exam->exam_type === 'current_affairs', 404);

        return redirect()->route('exams.edit', $exam);
    }

    /**
     * Delete a Current Affairs exam.
     *
     * Deletion remains handled by the existing ExamController.
     */
    public function destroy(Exam $exam)
    {
        $this->authorizeExam($exam);

        abort_unless($exam->exam_type === 'current_affairs', 404);

        return redirect()
            ->route('exams.show', $exam)
            ->with('info', 'Please use the existing exam management action to delete this test.');
    }

    /**
     * Resolve the authenticated library.
     */
    private function libraryId(): int
    {
        $libraryId = Auth::user()?->library_id;

        abort_unless($libraryId, 403, 'No library is associated with this account.');

        return (int) $libraryId;
    }

    /**
     * Ensure the exam belongs to the current library.
     */
    private function authorizeExam(Exam $exam): void
    {
        abort_unless(
            (int) $exam->library_id === $this->libraryId(),
            403
        );
    }
}