<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\ExamSubject;
use Illuminate\Support\Facades\Auth;

class ExaminationDashboardController extends Controller
{
    /**
     * Online Examination System Dashboard.
     */
    public function index()
    {
        $libraryId = Auth::user()->library_id;

        /*
        |--------------------------------------------------------------------------
        | Examination Statistics
        |--------------------------------------------------------------------------
        */

        $totalExams = Exam::where('library_id', $libraryId)
            ->count();

        $activeExams = Exam::where('library_id', $libraryId)
            ->where('is_active', true)
            ->where('is_published', true)
            ->count();

        $totalCategories = ExamCategory::where(
            'library_id',
            $libraryId
        )->count();

        $totalSubjects = ExamSubject::where(
            'library_id',
            $libraryId
        )->count();

        /*
        |--------------------------------------------------------------------------
        | Recent Exams
        |--------------------------------------------------------------------------
        */

        $recentExams = Exam::with('category')
            ->where('library_id', $libraryId)
            ->latest()
            ->take(5)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        return view(
            'examination.dashboard',
            compact(
                'totalExams',
                'activeExams',
                'totalCategories',
                'totalSubjects',
                'recentExams'
            )
        );
    }
}