<?php

namespace App\Http\Controllers;

use App\Models\ExamUser;
use App\Models\StudentExamAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ExamUserAuthController extends Controller
{
    /**
     * External / Library student exam login page.
     *
     * Both library students and external students
     * use the same exam login page.
     */
    public function showLogin()
    {
        return view('exam-user.auth.login');
    }

    /**
     * External student registration page.
     *
     * Only outside/public students register here.
     */
    public function showRegister()
    {
        return view('exam-user.auth.register');
    }

    /**
     * Register external student.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:exam_users,email',
            ],

            'mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        $examUser = ExamUser::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'mobile' => $validated['mobile'] ?? null,
            'password' => $validated['password'],
            'is_active' => true,
        ]);

        Auth::guard('exam_user')->login($examUser);
       

        $request->session()->regenerate();

        $examUser->update([
            'last_login_at' => now(),
        ]);

        /*
         * New external candidates must choose
         * their preparation categories first.
         */
        return redirect()
            ->route('exam-user.categories.edit')
            ->with(
                'success',
                'Account created successfully. Please select your preparation categories.'
            );
    }

    /**
     * Login library student OR external student.
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

        /*
        |--------------------------------------------------------------------------
        | 1. Check Library Student Exam Account
        |--------------------------------------------------------------------------
        |
        | Library students receive their exam portal credentials
        | from the library/admin.
        |
        */

        $studentAccount = StudentExamAccount::query()
            ->where('email', $validated['email'])
            ->where('is_active', true)
            ->with('student')
            ->first();

        if ($studentAccount) {

            /*
             * Account exists but is not linked to a student.
             */
            if (! $studentAccount->student) {
                throw ValidationException::withMessages([
                    'email' => 'Student account is not linked to a valid student.',
                ]);
            }

            /*
             * Verify library student password.
             */
            if (
                Hash::check(
                    $validated['password'],
                    $studentAccount->password
                )
            ) {

                /*
                 * Make sure no external user session
                 * remains active.
                 */
                Auth::guard('exam_user')->logout();

                /*
                 * Login through library student exam guard.
                 */
                Auth::guard('student_exam')->login(
                    $studentAccount,
                    $request->boolean('remember')
                );

                $request->session()->regenerate();

                $studentAccount->update([
                    'last_login_at' => now(),
                ]);

                return redirect()
                    ->route('student-exam.dashboard');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 2. Check External / Public Exam User
        |--------------------------------------------------------------------------
        */

        $examUser = ExamUser::query()
            ->where('email', $validated['email'])
            ->where('is_active', true)
            ->first();

        if (
            $examUser &&
            Hash::check(
                $validated['password'],
                $examUser->password
            )
        ) {

            /*
             * Make sure no library student session
             * remains active.
             */
            Auth::guard('student_exam')->logout();

            /*
             * Login through external exam user guard.
             */
            Auth::guard('exam_user')->login(
                $examUser,
                $request->boolean('remember')
            );

            $request->session()->regenerate();

            $examUser->update([
                'last_login_at' => now(),
            ]);

           if ($examUser->selectedCategories()->count() === 0) {
    return redirect()
        ->route('exam-user.categories.edit')
        ->with(
            'success',
            'Please select your preparation categories before continuing.'
        );
}

return redirect()
    ->route('exam-user.dashboard');
        }

        /*
        |--------------------------------------------------------------------------
        | Invalid Credentials
        |--------------------------------------------------------------------------
        */

        throw ValidationException::withMessages([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Logout library student or external student.
     */
    public function logout(Request $request)
    {
        /*
         * Logout from both guards.
         * Only the currently authenticated guard
         * will actually have a session to clear.
         */
        Auth::guard('student_exam')->logout();
        Auth::guard('exam_user')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('exam-user.login');
    }
}