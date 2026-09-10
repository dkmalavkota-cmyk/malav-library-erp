<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    /**
     * Show exam instructions before starting.
     */
    public function instructions(Exam $exam)
    {
        $account = Auth::guard('student_exam')->user();

        abort_unless($account, 401);

        $account->load('student');

        $student = $account->student;

        abort_unless($student, 403);

        /*
        |--------------------------------------------------------------------------
        | Security
        |--------------------------------------------------------------------------
        | Student can only access active + published exams
        | belonging to the same library.
        */
        abort_unless(
            $exam->library_id === $student->library_id &&
            $exam->is_active &&
            $exam->is_published,
            404
        );

        $exam->load([
            'category',
        ]);

        $questionCount = $exam->questions()->count();

        return view(
            'student-exam.instructions',
            compact(
                'account',
                'exam',
                'questionCount'
            )
        );
    }
}