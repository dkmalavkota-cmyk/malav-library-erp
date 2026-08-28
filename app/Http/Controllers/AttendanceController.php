<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;
use App\Models\Student;
use App\Models\SeatAssignment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Attendance Dashboard
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;

        $today = today();

        /*
        |--------------------------------------------------------------------------
        | Attendance Filters
        |--------------------------------------------------------------------------
        */

        $search = trim(request('search', ''));

        $attendanceDate = request(
            'date',
            $today->format('Y-m-d')
        );

        $filterShift = request('shift');

        $filterStatus = request('status');


        /*
        |--------------------------------------------------------------------------
        | Attendance Records
        |--------------------------------------------------------------------------
        */

        $todayAttendance = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->with([
                'student',
                'seat',
            ])

            ->when($attendanceDate, function ($query) use ($attendanceDate) {

                $query->whereDate(
                    'attendance_date',
                    $attendanceDate
                );

            })

            ->when($search, function ($query) use ($search) {

                $query->whereHas(
                    'student',
                    function ($student) use ($search) {

                        $student->where(function ($q) use ($search) {

                            $q->where(
                                'student_code',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'first_name',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'last_name',
                                'like',
                                "%{$search}%"
                            )

                            ->orWhere(
                                'mobile',
                                'like',
                                "%{$search}%"
                            );

                        });

                    }
                );

            })

            ->when($filterShift, function ($query) use ($filterShift) {

                $query->where(
                    'shift',
                    $filterShift
                );

            })

            ->when($filterStatus, function ($query) use ($filterStatus) {

                if ($filterStatus === 'Checked In') {

                    $query->whereNotNull('check_in')
                        ->whereNull('check_out');

                } elseif ($filterStatus === 'Checked Out') {

                    $query->whereNotNull('check_out');

                } elseif ($filterStatus === 'Present') {

                    $query->where(
                        'status',
                        'Present'
                    );

                }

            })

            ->latest('check_in')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Today's Statistics
        |--------------------------------------------------------------------------
        */

        $presentToday = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'attendance_date',
                $today
            )
            ->count();


        $checkedIn = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'attendance_date',
                $today
            )
            ->whereNotNull('check_in')
            ->whereNull('check_out')
            ->count();


        $checkedOut = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'attendance_date',
                $today
            )
            ->whereNotNull('check_out')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Active Students
        |--------------------------------------------------------------------------
        */

        $totalActiveStudents = Student::where(
                'library_id',
                $libraryId
            )
            ->where(
                'status',
                'Active'
            )
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Currently Inside Library
        |--------------------------------------------------------------------------
        */

        $currentlyInside = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->whereDate(
                'attendance_date',
                $today
            )
            ->whereNotNull('check_in')
            ->whereNull('check_out')
            ->count();


        return view(
            'attendance.index',
            compact(
                'todayAttendance',
                'presentToday',
                'checkedIn',
                'checkedOut',
                'totalActiveStudents',
                'currentlyInside'
            )
        );
    }


    /**
     * Show attendance check-in page.
     */
    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        $students = Student::where(
                'library_id',
                $libraryId
            )
            ->with([
                'seatAssignments' => function ($query) use ($libraryId) {

                    $query->where(
                        'library_id',
                        $libraryId
                    )
                    ->with([
                        'seat.room',
                        'membership.plan',
                    ])
                    ->where('status', 'Active')
                    ->whereNull('released_date')
                    ->latest('assigned_date');

                },
            ])
            ->where('status', 'Active')
            ->whereHas(
                'seatAssignments',
                function ($query) use ($libraryId) {

                    $query->where(
                        'library_id',
                        $libraryId
                    )
                    ->where('status', 'Active')
                    ->whereNull('released_date');

                }
            )
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        $studentsData = $students->map(function ($student) {

            $assignment =
                $student->seatAssignments->first();


            return [
                'id' =>
                    $student->id,

                'name' =>
                    $student->full_name,

                'code' =>
                    $student->student_code,

                'mobile' =>
                    $student->mobile,

                'photo' =>
                    $student->photo,

                'membership' =>
                    $assignment?->membership?->plan?->name,

                'expiry' =>
                    $assignment?->membership?->end_date?->format('d M Y'),

                'shift' =>
                    $assignment?->membership?->plan?->shift,

                'seat' =>
                    $assignment?->seat?->seat_number,

                'room' =>
                    $assignment?->seat?->room?->name,
            ];

        })->values();


        return view(
            'attendance.create',
            compact('studentsData')
        );
    }


    /**
     * Attendance Kiosk
     */
    public function kiosk()
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        $students = Student::where(
                'library_id',
                $libraryId
            )
            ->with([
                'seatAssignments' => function ($query) use ($libraryId) {

                    $query->where(
                        'library_id',
                        $libraryId
                    )
                    ->with([
                        'seat.room',
                        'membership.plan',
                    ])
                    ->where('status', 'Active')
                    ->whereNull('released_date')
                    ->latest('assigned_date');

                },
            ])
            ->where('status', 'Active')
            ->whereHas(
                'seatAssignments',
                function ($query) use ($libraryId) {

                    $query->where(
                        'library_id',
                        $libraryId
                    )
                    ->where('status', 'Active')
                    ->whereNull('released_date');

                }
            )
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        $studentsData = $students->map(function ($student) {

            $assignment =
                $student->seatAssignments->first();


            return [
                'id' =>
                    $student->id,

                'name' =>
                    $student->full_name,

                'code' =>
                    $student->student_code,

                'photo' =>
                    $student->photo,

                'membership' =>
                    $assignment?->membership?->plan?->name,

                'shift' =>
                    $assignment?->membership?->plan?->shift,

                'seat' =>
                    $assignment?->seat?->seat_number,

                'room' =>
                    $assignment?->seat?->room?->name,
            ];

        })->values();


        return view(
            'attendance.kiosk',
            compact('studentsData')
        );
    }


    /**
     * Process student check-in.
     */
    public function checkIn(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        $validated = $request->validate([
'student_id' => [
    'required',
    'integer',
],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Find Student
        |--------------------------------------------------------------------------
        */

        $student = Student::where(
                'library_id',
                $libraryId
            )
            ->findOrFail(
                $validated['student_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Find Active Seat Assignment
        |--------------------------------------------------------------------------
        */

        $assignment = SeatAssignment::where(
                'library_id',
                $libraryId
            )
            ->with([
                'seat',
                'membership.plan',
            ])
            ->where(
                'student_id',
                $student->id
            )
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->latest('assigned_date')
            ->first();


        if (!$assignment) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student does not have an active seat assignment.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Get Shift
        |--------------------------------------------------------------------------
        */

        $shift =
            $assignment->membership?->plan?->shift;


        if (!$shift) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Student membership shift could not be determined.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Prevent Duplicate Check-In
        |--------------------------------------------------------------------------
        */

        $existingAttendance = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->where(
                'student_id',
                $student->id
            )
            ->whereDate(
                'attendance_date',
                today()
            )
            ->where('shift', $shift)
            ->whereNotNull('check_in')
            ->whereNull('check_out')
            ->first();


        if ($existingAttendance) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student is already checked in for this shift.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Attendance
        |--------------------------------------------------------------------------
        */

        AttendanceLog::create([

            'library_id' =>
                $libraryId,

            'student_id' =>
                $student->id,

            'seat_id' =>
                $assignment->seat_id,

            'shift' =>
                $shift,

            'attendance_date' =>
                today(),

            'check_in' =>
                now(),

            'status' =>
                'Present',
        ]);


        return redirect()
            ->route('attendance.index')
            ->with(
                'success',
                $student->full_name .
                    ' checked in successfully.'
            );
    }


    /**
     * Check student out.
     */
    public function checkOut(
        AttendanceLog $attendanceLog
    ) {

        /*
        |--------------------------------------------------------------------------
        | Current Library Protection
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $attendanceLog->library_id ===
                auth()->user()->library_id,
            404
        );


        if ($attendanceLog->check_out) {

            return back()->withErrors([
                'attendance' =>
                    'This student is already checked out.',
            ]);
        }


        $attendanceLog->update([

            'check_out' =>
                now(),

        ]);


        return back()->with(
            'success',
            'Student checked out successfully.'
        );
    }


    /**
     * Process QR scan from Attendance Kiosk.
     */
    public function kioskScan(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        $validated = $request->validate([

            'code' => [
                'required',
                'string',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Find Student
        |--------------------------------------------------------------------------
        */

        $student = Student::where(
                'library_id',
                $libraryId
            )
            ->with([
                'seatAssignments' => function ($query) use ($libraryId) {

                    $query->where(
                        'library_id',
                        $libraryId
                    )
                    ->with([
                        'seat.room',
                        'membership.plan',
                    ])
                    ->where('status', 'Active')
                    ->whereNull('released_date')
                    ->latest('assigned_date');

                },
            ])
            ->where(
                'student_code',
                $validated['code']
            )
            ->where('status', 'Active')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Invalid QR
        |--------------------------------------------------------------------------
        */

        if (!$student) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Invalid QR code. Student not found or inactive.',

            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Active Seat Assignment
        |--------------------------------------------------------------------------
        */

        $assignment =
            $student->seatAssignments->first();


        if (!$assignment) {

            return response()->json([

                'success' => false,

                'message' =>
                    'This student does not have an active seat assignment.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Membership / Shift
        |--------------------------------------------------------------------------
        */

        $membership =
            $assignment->membership;

        $plan =
            $membership?->plan;


        if (!$membership || !$plan) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Student membership could not be verified.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Membership Status
        |--------------------------------------------------------------------------
        */

        if ($membership->status !== 'Active') {

            return response()->json([

                'success' => false,

                'message' =>
                    'Student membership is not active.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Membership Expiry
        |--------------------------------------------------------------------------
        */

        if (
            $membership->end_date &&
            $membership->end_date->lt(today())
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Student membership has expired.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Shift
        |--------------------------------------------------------------------------
        */

        $shift =
            $plan->shift;


        if (!$shift) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Student shift could not be determined.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | Existing Attendance Today
        |--------------------------------------------------------------------------
        */

        $attendance = AttendanceLog::where(
                'library_id',
                $libraryId
            )
            ->where(
                'student_id',
                $student->id
            )
            ->whereDate(
                'attendance_date',
                today()
            )
            ->where(
                'shift',
                $shift
            )
            ->latest('check_in')
            ->first();


        /*
        |--------------------------------------------------------------------------
        | Already Checked Out Today
        |--------------------------------------------------------------------------
        */

        if (
            $attendance &&
            $attendance->check_in &&
            $attendance->check_out
        ) {

            return response()->json([

                'success' => false,

                'message' =>
                    'Attendance already completed for today.',

            ], 422);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK-OUT
        |--------------------------------------------------------------------------
        */

        if (
            $attendance &&
            $attendance->check_in &&
            !$attendance->check_out
        ) {

            $attendance->update([

                'check_out' =>
                    now(),

            ]);


            return response()->json([

                'success' => true,

                'action' => 'checkout',

                'message' =>
                    'Goodbye ' .
                    $student->full_name .
                    '!',

                'student' => [

                    'name' =>
                        $student->full_name,

                    'code' =>
                        $student->student_code,

                    'photo' =>
                        $student->photo,

                    'seat' =>
                        $assignment->seat?->seat_number,

                    'room' =>
                        $assignment->seat?->room?->name,

                    'shift' =>
                        $shift,

                ],

                'time' =>
                    now()->format('h:i A'),

            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CHECK-IN
        |--------------------------------------------------------------------------
        */

        $attendance = AttendanceLog::create([

            'library_id' =>
                $libraryId,

            'student_id' =>
                $student->id,

            'seat_id' =>
                $assignment->seat_id,

            'shift' =>
                $shift,

            'attendance_date' =>
                today(),

            'check_in' =>
                now(),

            'status' =>
                'Present',

        ]);


        return response()->json([

            'success' => true,

            'action' => 'checkin',

            'message' =>
                'Welcome ' .
                $student->full_name .
                '!',

            'student' => [

                'name' =>
                    $student->full_name,

                'code' =>
                    $student->student_code,

                'photo' =>
                    $student->photo,

                'seat' =>
                    $assignment->seat?->seat_number,

                'room' =>
                    $assignment->seat?->room?->name,

                'shift' =>
                    $shift,

            ],

            'time' =>
                now()->format('h:i A'),

        ]);
    }


    /**
     * Student Attendance History.
     */
    public function studentHistory(
        Student $student
    ) {

        /*
        |--------------------------------------------------------------------------
        | Current Library Protection
        |--------------------------------------------------------------------------
        */

        abort_unless(
            $student->library_id ===
                auth()->user()->library_id,
            404
        );


        $attendance = AttendanceLog::where(
                'library_id',
                auth()->user()->library_id
            )
            ->with([
                'seat.room',
            ])
            ->where(
                'student_id',
                $student->id
            )
            ->latest('attendance_date')
            ->latest('check_in')
            ->get();


        return view(
            'attendance.student-history',
            compact(
                'student',
                'attendance'
            )
        );
    }
}