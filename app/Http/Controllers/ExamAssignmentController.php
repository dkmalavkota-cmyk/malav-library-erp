<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAssignment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamAssignmentController extends Controller
{
    /**
     * Show students assigned to an exam
     * and students available for assignment.
     */
    public function index(Exam $exam)
    {
        $this->authorizeExam($exam);

        $libraryId = Auth::user()->library_id;

        $exam->load('category');

        /*
         * Get students who are already assigned
         * and whose assignment is not cancelled.
         */
        $assignedStudentIds = $exam->assignments()
            ->where('status', '!=', 'cancelled')
            ->pluck('student_id')
            ->toArray();

        /*
         * Assigned students.
         */
        $assignedStudents = Student::where(
            'library_id',
            $libraryId
        )
            ->whereIn('id', $assignedStudentIds)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        /*
         * Active students who are not already assigned.
         */
        $students = Student::where(
            'library_id',
            $libraryId
        )
            ->where('status', 'Active')
            ->whereNotIn('id', $assignedStudentIds)
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();

        return view(
            'exams.assignments.index',
            compact(
                'exam',
                'assignedStudents',
                'students'
            )
        );
    }

    /**
     * Assign selected students to an exam.
     */
    public function store(Request $request, Exam $exam)
    {
        $this->authorizeExam($exam);

        $libraryId = Auth::user()->library_id;

        $validated = $request->validate([
            'student_ids' => [
                'required',
                'array',
                'min:1',
            ],

            'student_ids.*' => [
                'required',
                'integer',
                'exists:students,id',
            ],
        ]);

        /*
         * Only students belonging to the
         * current library can be assigned.
         */
        $students = Student::where(
            'library_id',
            $libraryId
        )
            ->whereIn(
                'id',
                $validated['student_ids']
            )
            ->where('status', 'Active')
            ->get();

        if ($students->isEmpty()) {
            return back()
                ->withErrors([
                    'student_ids' =>
                        'No valid students were selected.',
                ])
                ->withInput();
        }

        $created = 0;

        foreach ($students as $student) {

            /*
             * Check whether this student already has
             * an assignment for this exam.
             */
            $assignment = ExamAssignment::where(
                'exam_id',
                $exam->id
            )
                ->where(
                    'student_id',
                    $student->id
                )
                ->first();

            /*
             * Existing cancelled assignment:
             * reactivate it.
             */
            if ($assignment) {

                if ($assignment->status === 'cancelled') {

                    $assignment->update([
                        'library_id' => $libraryId,
                        'status' => 'assigned',
                        'assigned_at' => now(),
                    ]);

                    $created++;
                }

                continue;
            }

            /*
             * Create new assignment.
             */
            ExamAssignment::create([
                'library_id' => $libraryId,
                'exam_id' => $exam->id,
                'student_id' => $student->id,
                'status' => 'assigned',
                'assigned_at' => now(),
            ]);

            $created++;
        }

        return redirect()
            ->route(
                'exam-assignments.index',
                $exam
            )
            ->with(
                'success',
                $created .
                ' student(s) assigned successfully.'
            );
    }

    /**
     * Cancel a student assignment.
     */
    public function destroy(
        Exam $exam,
        ExamAssignment $assignment
    ) {
        $this->authorizeExam($exam);

        /*
         * Assignment must belong to this exam.
         */
        abort_unless(
            (int) $assignment->exam_id ===
            (int) $exam->id,
            404
        );

        /*
         * Assignment must belong to
         * current library.
         */
        abort_unless(
            (int) $assignment->library_id ===
            (int) Auth::user()->library_id,
            403
        );

        /*
         * Do not physically delete assignment
         * history. Mark it cancelled.
         */
        $assignment->update([
            'status' => 'cancelled',
        ]);

        return redirect()
            ->route(
                'exam-assignments.index',
                $exam
            )
            ->with(
                'success',
                'Student assignment cancelled successfully.'
            );
    }

    /**
     * Verify exam belongs to current library.
     */
    private function authorizeExam(Exam $exam): void
    {
        abort_unless(
            (int) $exam->library_id ===
            (int) Auth::user()->library_id,
            403
        );
    }
}