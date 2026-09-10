<?php

namespace App\Http\Controllers;

use App\Models\ExamUser;
use App\Models\ExamUserLibraryAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ExternalExamStudentController extends Controller
{
    /**
     * List external examination students for the logged-in library.
     */
    public function index()
    {
        $libraryId = auth()->user()->library_id;

        abort_unless($libraryId, 403);

        $students = ExamUser::query()
            ->whereHas('libraryAccess', function ($query) use ($libraryId) {
                $query->where('library_id', $libraryId);
            })
            ->with([
                'libraryAccess' => function ($query) use ($libraryId) {
                    $query->where('library_id', $libraryId);
                },
            ])
            ->withCount('selectedCategories')
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view(
            'external-exam-students.index',
            compact('students')
        );
    }

    /**
     * Show external examination student registration form.
     */
    public function create()
    {
        abort_unless(auth()->user()->library_id, 403);

        return view('external-exam-students.create');
    }

    /**
     * Register an external examination student for the logged-in library.
     */
    public function store(Request $request)
    {
        $libraryId = auth()->user()->library_id;

        abort_unless($libraryId, 403);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

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

        DB::transaction(function () use ($validated, $libraryId) {

            $examUser = ExamUser::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'mobile' => $validated['mobile'] ?? null,
                'password' => Hash::make($validated['password']),
                'is_active' => true,
            ]);

            ExamUserLibraryAccess::create([
                'exam_user_id' => $examUser->id,
                'library_id' => $libraryId,
                'status' => 'active',
                'access_type' => 'free',
                'starts_at' => now(),
                'ends_at' => null,
            ]);
        });

        return redirect()
            ->route('external-exam-students.index')
            ->with(
                'success',
                'External examination student registered successfully. Login credentials can now be given to the student.'
            );
    }

    /**
     * Show external examination student details.
     */
    public function show(ExamUser $examUser)
    {
        $libraryId = auth()->user()->library_id;

        abort_unless(
            $libraryId &&
            $examUser->hasLibraryAccess($libraryId),
            404
        );

        $examUser->load([
            'selectedCategories',
            'libraryAccess' => function ($query) use ($libraryId) {
                $query->where('library_id', $libraryId);
            },
        ]);

        return view(
            'external-exam-students.show',
            compact('examUser')
        );
    }

    /**
     * Show edit form.
     */
    public function edit(ExamUser $examUser)
    {
        $libraryId = auth()->user()->library_id;

        abort_unless(
            $libraryId &&
            $examUser->hasLibraryAccess($libraryId),
            404
        );

        return view(
            'external-exam-students.edit',
            compact('examUser')
        );
    }

    /**
     * Update external examination student details.
     */
    public function update(Request $request, ExamUser $examUser)
    {
        $libraryId = auth()->user()->library_id;

        abort_unless(
            $libraryId &&
            $examUser->hasLibraryAccess($libraryId),
            404
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('exam_users', 'email')
                    ->ignore($examUser->id),
            ],

            'mobile' => [
                'nullable',
                'string',
                'max:20',
            ],

            'password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],
        ]);

        $examUser->name = $validated['name'];
        $examUser->email = $validated['email'];
        $examUser->mobile = $validated['mobile'] ?? null;
        $examUser->is_active = $validated['is_active'];

        if (!empty($validated['password'])) {
            $examUser->password = Hash::make($validated['password']);
        }

        $examUser->save();

        return redirect()
            ->route('external-exam-students.show', $examUser)
            ->with(
                'success',
                'External examination student updated successfully.'
            );
    }

    /**
     * Revoke examination access for this library.
     */
    public function revokeAccess(ExamUser $examUser)
    {
        $libraryId = auth()->user()->library_id;

        abort_unless(
            $libraryId &&
            $examUser->hasLibraryAccess($libraryId),
            404
        );

        ExamUserLibraryAccess::query()
            ->where('exam_user_id', $examUser->id)
            ->where('library_id', $libraryId)
            ->update([
                'status' => 'revoked',
                'ends_at' => now(),
            ]);

        return redirect()
            ->route('external-exam-students.index')
            ->with(
                'success',
                'External examination access revoked successfully.'
            );
    }

    /**
     * Restore examination access for this library.
     */
    public function restoreAccess(ExamUser $examUser)
    {
        $libraryId = auth()->user()->library_id;

        abort_unless($libraryId, 403);

        $access = ExamUserLibraryAccess::query()
            ->where('exam_user_id', $examUser->id)
            ->where('library_id', $libraryId)
            ->first();

        abort_unless($access, 404);

        $access->update([
            'status' => 'active',
            'starts_at' => now(),
            'ends_at' => null,
        ]);

        return redirect()
            ->route('external-exam-students.index')
            ->with(
                'success',
                'External examination access restored successfully.'
            );
    }
}