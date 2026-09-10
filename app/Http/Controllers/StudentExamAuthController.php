<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentExamAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class StudentExamAuthController extends Controller
{
    /**
     * Student exam login page.
     */
    public function showLogin()
    {
        return view('student-exam.auth.login');
    }

    /**
     * Student login.
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => [
                'required',
                'email',
            ],
            'password' => [
                'required',
                'string',
            ],
        ]);

        $account = StudentExamAccount::where(
            'email',
            $validated['email']
        )
            ->where('is_active', true)
            ->with('student')
            ->first();

        if (
            ! $account ||
            ! Hash::check(
                $validated['password'],
                $account->password
            )
        ) {
            throw ValidationException::withMessages([
                'email' => 'Invalid email or password.',
            ]);
        }

        if (! $account->student) {
            throw ValidationException::withMessages([
                'email' => 'Student account is not linked to a valid student.',
            ]);
        }

        Auth::guard('student_exam')->login(
            $account,
            $request->boolean('remember')
        );

        $request->session()->regenerate();

        $account->update([
            'last_login_at' => now(),
        ]);

        return redirect()->route('student-exam.dashboard');
    }

    /**
     * Student logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('student_exam')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('student-exam.login');
    }
}