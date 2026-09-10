<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentExamAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentExamAccountController extends Controller
{
    /**
     * Show exam account creation form.
     */
    public function create(Student $student)
    {
        abort_unless(
            $student->library_id === auth()->user()->library_id,
            404
        );

        $account = $student->examAccount;

        return view(
            'student-exam.accounts.create',
            compact('student', 'account')
        );
    }

    /**
     * Create / update student exam account.
     */
    public function store(Request $request, Student $student)
    {
        abort_unless(
            $student->library_id === auth()->user()->library_id,
            404
        );

        $validated = $request->validate([
            'email' => [
                'required',
                'email',
                'max:255',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'confirmed',
            ],
        ]);

        StudentExamAccount::updateOrCreate(
            [
                'student_id' => $student->id,
            ],
            [
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'is_active' => true,
            ]
        );

        return redirect()
            ->route('students.show', $student)
            ->with(
                'success',
                'Student exam login created successfully.'
            );
    }

    /**
     * Disable student exam account.
     */
    public function destroy(Student $student)
    {
        abort_unless(
            $student->library_id === auth()->user()->library_id,
            404
        );

        if ($student->examAccount) {
            $student->examAccount->update([
                'is_active' => false,
            ]);
        }

        return redirect()
            ->route('students.show', $student)
            ->with(
                'success',
                'Student exam login disabled successfully.'
            );
    }
}