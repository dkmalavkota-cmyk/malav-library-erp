<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Students List
     */
    public function index()
    {
        $search = request('search');
        $status = request('status');

            $students = Student::when($search, function ($query) use ($search) {

    $query->where(function ($q) use ($search) {

        $q->where('student_code', 'like', "%{$search}%")
          ->orWhere('first_name', 'like', "%{$search}%")
          ->orWhere('last_name', 'like', "%{$search}%")
          ->orWhere('mobile', 'like', "%{$search}%");

    });

})
->when($status, function ($query) use ($status) {

    $query->where('status', $status);

})
->latest()
->paginate(10)
->withQueryString();



   

        $totalStudents = Student::count();
        $activeStudents = Student::where('status', 'Active')->count();
        $todayJoinings = Student::whereDate('joining_date', today())->count();

        return view('students.index', compact(
            'students',
            'totalStudents',
            'activeStudents',
            'todayJoinings'
        ));
    }

    /**
 * Student ID Cards
 */
public function idCards()
{
    $search = request('search');

    $students = Student::when($search, function ($query) use ($search) {

        $query->where(function ($q) use ($search) {

            $q->where('student_code', 'like', "%{$search}%")
                ->orWhere('first_name', 'like', "%{$search}%")
                ->orWhere('last_name', 'like', "%{$search}%")
                ->orWhere('mobile', 'like', "%{$search}%");

        });

    })
    ->with([
        'seatAssignments' => function ($query) {

            $query->with([
                'seat.room',
                'membership.plan',
            ])
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->latest('assigned_date');

        },
    ])
    ->where('status', 'Active')
    ->latest()
    ->paginate(12)
    ->withQueryString();

    return view('students.id-cards', compact('students'));
}

    /**
     * Add Student
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Save Student
     */
        public function store(StoreStudentRequest $request)
{

    $data = $request->validated();

    if ($request->hasFile('photo')) {



            $data['photo'] = $request->file('photo')->store('students', 'public');
        }

        Student::create($data);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student added successfully.');
    }

    /**
     * View Student
     */
   /**
 * View Student
 */
public function show(Student $student)
{
    $student->load([
        'memberships' => function ($query) {
            $query->with([
                'plan',
            ])
            ->latest('start_date');
        },

        'seatAssignments' => function ($query) {
            $query->with([
                'seat.room',
                'membership.plan',
            ])
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->latest('assigned_date');
        },

        'payments' => function ($query) {
            $query->with([
                'membership.plan',
            ])
            ->latest('payment_date');
        },
    ]);

    $membership = $student->memberships->first();

    $assignment = $student->seatAssignments->first();

    $payment = $student->payments->first();

    return view('students.show', compact(
        'student',
        'membership',
        'assignment',
        'payment'
    ));
}

/**
 * Print Student ID Card
 */
public function idCard(Student $student)
{
    $student->load([
        'seatAssignments' => function ($query) {
            $query->with([
                'seat.room',
                'membership.plan',
            ])
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->latest('assigned_date');
        },
    ]);

    $assignment = $student->seatAssignments->first();

    return view('students.id-card', compact(
        'student',
        'assignment'
    ));
}

    /**
     * Edit Student
     */
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    /**
     * Update Student
     */
    public function update(Request $request, Student $student)
    {
        $data = $request->validate([

            'first_name' => 'required|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'father_name' => 'nullable|string|max:150',

            'mobile' => [
                'required',
                'max:20',
                Rule::unique('students')->ignore($student->id),
            ],

            'whatsapp' => 'nullable|max:20',

            'email' => [
                'nullable',
                'email',
                Rule::unique('students')->ignore($student->id),
            ],

            'gender' => 'required|in:Male,Female,Other',

            'dob' => 'nullable|date',

            'college' => 'nullable|string|max:150',
            'course' => 'nullable|string|max:150',
            'preparing_for' => 'nullable|string|max:150',

            'joining_date' => 'required|date',

            'status' => 'required|in:Active,Inactive,Suspended',

            'remarks' => 'nullable|string',

            'photo' => 'nullable|image|max:2048',

        ]);

        if ($request->hasFile('photo')) {

            $data['photo'] = $request->file('photo')->store('students', 'public');

        }

        $student->update($data);

        return redirect()
            ->route('students.index')
            ->with('success', 'Student updated successfully.');
    }

    /**
     * Delete Student
     */
    public function destroy(Student $student)
    {
        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->delete();

        return redirect()
            ->route('students.index')
            ->with('success', 'Student deleted successfully.');
    }
}