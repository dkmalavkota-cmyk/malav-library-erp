<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Student;
use App\Models\Membership;
use App\Models\SeatAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class SeatAssignmentController extends Controller
{
    /**
     * Display seat management.
     */
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | Rooms + Seats + Active Assignments
        |--------------------------------------------------------------------------
        */

        $rooms = Room::with([
            'seats' => function ($query) {
                $query->orderBy('table_no')
                    ->orderBy('seat_number');
            },

            'seats.activeAssignments.student',
            'seats.activeAssignments.membership.plan',

        ])->get();


        /*
        |--------------------------------------------------------------------------
        | Total Seats
        |--------------------------------------------------------------------------
        */

        $totalSeats = Seat::count();


        /*
        |--------------------------------------------------------------------------
        | All Seats Collection
        |--------------------------------------------------------------------------
        */

        $allSeats = $rooms->flatMap(function ($room) {
            return $room->seats;
        });


        /*
        |--------------------------------------------------------------------------
        | Fully Available Seats
        |--------------------------------------------------------------------------
        */

        $availableSeats = $allSeats->filter(function ($seat) {

            return $seat->activeAssignments->isEmpty();

        })->count();


        /*
        |--------------------------------------------------------------------------
        | Fully Occupied Seats
        |--------------------------------------------------------------------------
        */

        $occupiedSeats = $allSeats->filter(function ($seat) {

            $shifts = $seat->activeAssignments
                ->map(function ($assignment) {

                    return $assignment->membership?->plan?->shift;

                })
                ->filter()
                ->unique()
                ->values();


            return $shifts->contains('Full Day')
                || (
                    $shifts->contains('Morning')
                    && $shifts->contains('Evening')
                );

        })->count();


        /*
        |--------------------------------------------------------------------------
        | Morning Assignments
        |--------------------------------------------------------------------------
        */

        $morningSeats = SeatAssignment::where('status', 'Active')
            ->whereNull('released_date')
            ->whereHas('membership.plan', function ($q) {

                $q->where('shift', 'Morning');

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Evening Assignments
        |--------------------------------------------------------------------------
        */

        $eveningSeats = SeatAssignment::where('status', 'Active')
            ->whereNull('released_date')
            ->whereHas('membership.plan', function ($q) {

                $q->where('shift', 'Evening');

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Full Day Assignments
        |--------------------------------------------------------------------------
        */

        $fullDaySeats = SeatAssignment::where('status', 'Active')
            ->whereNull('released_date')
            ->whereHas('membership.plan', function ($q) {

                $q->where('shift', 'Full Day');

            })
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        |
        | Only active students without an active seat assignment.
        |
        */

        $students = Student::where('status', 'Active')
            ->whereDoesntHave('seatAssignments', function ($query) {

                $query->where('status', 'Active')
                    ->whereNull('released_date');

            })
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Active Memberships
        |--------------------------------------------------------------------------
        */

        $memberships = Membership::with('plan')
            ->where('status', 'Active')
            ->whereDate('end_date', '>=', today())
            ->whereHas('plan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('seat-assignments.index', compact(
            'rooms',
            'students',
            'memberships',
            'availableSeats',
            'occupiedSeats',
            'totalSeats',
            'morningSeats',
            'eveningSeats',
            'fullDaySeats'
        ));
    }


    /**
     * Show assign seat form.
     */
    public function create(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Selected Student
        |--------------------------------------------------------------------------
        */

        $selectedStudent = null;

        if ($request->filled('student_id')) {

            $selectedStudent = Student::where('id', $request->student_id)
                ->where('status', 'Active')
                ->firstOrFail();


            /*
            |--------------------------------------------------------------------------
            | Student Already Has Active Seat?
            |--------------------------------------------------------------------------
            */

            $alreadyAssigned = SeatAssignment::where(
                    'student_id',
                    $selectedStudent->id
                )
                ->where('status', 'Active')
                ->whereNull('released_date')
                ->exists();


            if ($alreadyAssigned) {

                return redirect()
                    ->route('students.show', $selectedStudent)
                    ->withErrors([
                        'seat' =>
                            'This student already has an active seat assigned.',
                    ]);
            }


            /*
            |--------------------------------------------------------------------------
            | Only This Student's Active Memberships
            |--------------------------------------------------------------------------
            */

            $memberships = Membership::with('plan')
                ->where('student_id', $selectedStudent->id)
                ->where('status', 'Active')
                ->whereDate('end_date', '>=', today())
                ->whereHas('plan')
                ->get();


            /*
            |--------------------------------------------------------------------------
            | Seats
            |--------------------------------------------------------------------------
            */

            $seats = Seat::with([
                'room',
                'activeAssignments.membership.plan',
            ])
                ->orderBy('room_id')
                ->orderBy('table_no')
                ->orderBy('seat_number')
                ->get();


            return view('seat-assignments.create', [
                'students' => collect([$selectedStudent]),
                'memberships' => $memberships,
                'seats' => $seats,
                'selectedStudent' => $selectedStudent,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Normal Assign Seat Page
        |--------------------------------------------------------------------------
        */

        $students = Student::where('status', 'Active')
            ->whereDoesntHave('seatAssignments', function ($query) {

                $query->where('status', 'Active')
                    ->whereNull('released_date');

            })
            ->orderBy('first_name')
            ->orderBy('last_name')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Active Memberships
        |--------------------------------------------------------------------------
        */

        $memberships = Membership::with('plan')
            ->where('status', 'Active')
            ->whereDate('end_date', '>=', today())
            ->whereHas('plan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Seats
        |--------------------------------------------------------------------------
        */

        $seats = Seat::with([
            'room',
            'activeAssignments.membership.plan',
        ])
            ->orderBy('room_id')
            ->orderBy('table_no')
            ->orderBy('seat_number')
            ->get();


        return view('seat-assignments.create', compact(
            'students',
            'memberships',
            'seats'
        ));
    }


    /**
     * Store new seat assignment.
     */
    public function store(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'student_id' => [
                'required',
                'exists:students,id',
            ],

            'membership_id' => [
                'required',
                'exists:memberships,id',
            ],

            'seat_id' => [
                'required',
                'exists:seats,id',
            ],

            'assigned_date' => [
                'required',
                'date',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Get Student
        |--------------------------------------------------------------------------
        */

        $student = Student::findOrFail(
            $validated['student_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Student Must Be Active
        |--------------------------------------------------------------------------
        */

        if ($student->status !== 'Active') {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'Only active students can be assigned a seat.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Get Membership
        |--------------------------------------------------------------------------
        */

        $membership = Membership::with('plan')
            ->findOrFail(
                $validated['membership_id']
            );


        /*
        |--------------------------------------------------------------------------
        | Membership Must Belong To Student
        |--------------------------------------------------------------------------
        */

        if (
            (int) $membership->student_id !==
            (int) $validated['student_id']
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'membership_id' =>
                        'The selected membership does not belong to this student.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Membership Must Have Plan
        |--------------------------------------------------------------------------
        */

        if (!$membership->plan) {

            return back()
                ->withInput()
                ->withErrors([
                    'membership_id' =>
                        'This membership does not have a valid membership plan.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Membership Must Be Active
        |--------------------------------------------------------------------------
        */

        if ($membership->status !== 'Active') {

            return back()
                ->withInput()
                ->withErrors([
                    'membership_id' =>
                        'Only active memberships can be assigned a seat.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Membership Must Not Be Expired
        |--------------------------------------------------------------------------
        */

        if (
            $membership->end_date &&
            $membership->end_date->lt(today())
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'membership_id' =>
                        'This membership has expired and cannot be assigned a seat.',
                ]);
        }


        $shift = $membership->plan->shift;


        /*
        |--------------------------------------------------------------------------
        | Student Already Has Active Seat?
        |--------------------------------------------------------------------------
        */

        $studentAssigned = SeatAssignment::where(
                'student_id',
                $validated['student_id']
            )
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->exists();


        if ($studentAssigned) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This student already has an active seat assigned.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Get Seat
        |--------------------------------------------------------------------------
        */

        $seat = Seat::with([
            'activeAssignments.membership.plan',
        ])->findOrFail(
            $validated['seat_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Maintenance Seat Protection
        |--------------------------------------------------------------------------
        */

        if (strtolower($seat->status) === 'maintenance') {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'This seat is currently under maintenance and cannot be assigned.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Current Seat Assignments
        |--------------------------------------------------------------------------
        */

        $currentAssignments = SeatAssignment::where(
                'seat_id',
                $validated['seat_id']
            )
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->with('membership.plan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Check Existing Shifts
        |--------------------------------------------------------------------------
        */

        $hasMorning = $currentAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Morning';

        });


        $hasEvening = $currentAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Evening';

        });


        $hasFullDay = $currentAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Full Day';

        });


        /*
        |--------------------------------------------------------------------------
        | Morning Validation
        |--------------------------------------------------------------------------
        */

        if (
            $shift === 'Morning' &&
            ($hasMorning || $hasFullDay)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'Morning shift is already occupied on this seat.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Evening Validation
        |--------------------------------------------------------------------------
        */

        if (
            $shift === 'Evening' &&
            ($hasEvening || $hasFullDay)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'Evening shift is already occupied on this seat.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Full Day Validation
        |--------------------------------------------------------------------------
        */

        if (
            $shift === 'Full Day' &&
            ($hasMorning || $hasEvening || $hasFullDay)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'This seat already has an active shift and cannot be assigned as Full Day.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Create Assignment + Update Seat
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $validated,
            $seat
        ) {

            /*
            |--------------------------------------------------------------------------
            | Create Assignment
            |--------------------------------------------------------------------------
            */

            SeatAssignment::create([

                'student_id' => $validated['student_id'],

                'membership_id' => $validated['membership_id'],

                'seat_id' => $validated['seat_id'],

                'assigned_date' => $validated['assigned_date'],

                'remarks' => $validated['remarks'] ?? null,

                'status' => 'Active',

                'created_by' => auth()->id(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | Recalculate Physical Seat Status
            |--------------------------------------------------------------------------
            */

            $this->recalculateSeatStatus(
                $seat->id
            );
        });


        /*
        |--------------------------------------------------------------------------
        | Redirect
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('seat-assignments.index')
            ->with(
                'success',
                'Seat assigned successfully.'
            );
    }


    /**
     * Release an active seat assignment.
     */
    public function release(SeatAssignment $seatAssignment)
    {
        /*
        |--------------------------------------------------------------------------
        | Only Active Assignments Can Be Released
        |--------------------------------------------------------------------------
        */

        if ($seatAssignment->status !== 'Active') {

            return back()->withErrors([
                'seat' =>
                    'This seat assignment is already released.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Release + Recalculate
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($seatAssignment) {

            $seatId = $seatAssignment->seat_id;


            $seatAssignment->update([

                'status' => 'Released',

                'released_date' => today(),

                'updated_by' => auth()->id(),

            ]);


            $this->recalculateSeatStatus(
                $seatId
            );
        });


        return redirect()
            ->route('seat-assignments.index')
            ->with(
                'success',
                'Seat released successfully.'
            );
    }


    /**
     * Show change seat form.
     */
    public function change(SeatAssignment $seatAssignment)
    {
        /*
        |--------------------------------------------------------------------------
        | Only Active Assignments Can Be Changed
        |--------------------------------------------------------------------------
        */

        if ($seatAssignment->status !== 'Active') {

            return back()->withErrors([
                'seat' =>
                    'Only active seat assignments can be changed.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Current Assignment
        |--------------------------------------------------------------------------
        */

        $seatAssignment->load([
            'student',
            'membership.plan',
            'seat.room',
        ]);


        $seats = Seat::with([
            'room',
            'activeAssignments.membership.plan',
            'activeAssignments.student',
        ])
            ->orderBy('room_id')
            ->orderBy('table_no')
            ->orderBy('seat_number')
            ->get();


        return view(
            'seat-assignments.change',
            compact(
                'seatAssignment',
                'seats'
            )
        );
    }


    /**
     * Update seat assignment after changing seat.
     */
    public function updateChange(
        Request $request,
        SeatAssignment $seatAssignment
    ) {

        $validated = $request->validate([

            'seat_id' => [
                'required',
                'exists:seats,id',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Current Assignment Must Be Active
        |--------------------------------------------------------------------------
        */

        if ($seatAssignment->status !== 'Active') {

            return back()->withErrors([
                'seat' =>
                    'This seat assignment is no longer active.',
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | New Seat Cannot Be Same Seat
        |--------------------------------------------------------------------------
        */

        if (
            (int) $validated['seat_id'] ===
            (int) $seatAssignment->seat_id
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'Please select a different seat.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Load Assignment + Membership
        |--------------------------------------------------------------------------
        */

        $seatAssignment->load([
            'membership.plan',
            'student',
            'seat',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Membership Must Still Be Valid
        |--------------------------------------------------------------------------
        */

        if (!$seatAssignment->membership) {

            return back()
                ->withErrors([
                    'seat_id' =>
                        'The membership associated with this assignment could not be found.',
                ]);
        }


        if (
            $seatAssignment->membership->status !== 'Active'
        ) {

            return back()
                ->withErrors([
                    'seat_id' =>
                        'The membership is no longer active.',
                ]);
        }


        if (
            $seatAssignment->membership->end_date &&
            $seatAssignment->membership->end_date->lt(today())
        ) {

            return back()
                ->withErrors([
                    'seat_id' =>
                        'The membership has expired.',
                ]);
        }


        $shift =
            $seatAssignment->membership?->plan?->shift;


        if (!$shift) {

            return back()
                ->withErrors([
                    'seat_id' =>
                        'Membership shift could not be determined.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | New Seat
        |--------------------------------------------------------------------------
        */

        $newSeat = Seat::with([
            'activeAssignments.membership.plan',
        ])->findOrFail(
            $validated['seat_id']
        );


        /*
        |--------------------------------------------------------------------------
        | Maintenance Protection
        |--------------------------------------------------------------------------
        */

        if (
            strtolower($newSeat->status) === 'maintenance'
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'This seat is currently under maintenance and cannot be assigned.',
                ]);
        }


        $currentAssignments =
            $newSeat->activeAssignments
                ->filter(function ($assignment) {

                    return $assignment->status === 'Active'
                        && is_null($assignment->released_date);

                });


        /*
        |--------------------------------------------------------------------------
        | Existing Shift Checks
        |--------------------------------------------------------------------------
        */

        $hasMorning = $currentAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Morning';

        });


        $hasEvening = $currentAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Evening';

        });


        $hasFullDay = $currentAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Full Day';

        });


        /*
        |--------------------------------------------------------------------------
        | Validate Shift Compatibility
        |--------------------------------------------------------------------------
        */

        if ($hasFullDay) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'This seat is already occupied for Full Day.',
                ]);
        }


        if (
            $shift === 'Morning' &&
            $hasMorning
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'Morning shift is already occupied on this seat.',
                ]);
        }


        if (
            $shift === 'Evening' &&
            $hasEvening
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'Evening shift is already occupied on this seat.',
                ]);
        }


        if (
            $shift === 'Full Day' &&
            ($hasMorning || $hasEvening)
        ) {

            return back()
                ->withInput()
                ->withErrors([
                    'seat_id' =>
                        'This seat already has another shift assigned.',
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Perform Change
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use (
            $seatAssignment,
            $validated,
            $newSeat
        ) {

            $oldSeatId =
                $seatAssignment->seat_id;


            /*
            |--------------------------------------------------------------------------
            | Release Old Assignment
            |--------------------------------------------------------------------------
            */

            $seatAssignment->update([

                'status' => 'Released',

                'released_date' => today(),

                'updated_by' => auth()->id(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | Create New Assignment
            |--------------------------------------------------------------------------
            */

            SeatAssignment::create([

                'student_id' =>
                    $seatAssignment->student_id,

                'membership_id' =>
                    $seatAssignment->membership_id,

                'seat_id' =>
                    $newSeat->id,

                'assigned_date' =>
                    today(),

                'status' =>
                    'Active',

                'remarks' =>
                    $validated['remarks'] ?? null,

                'created_by' =>
                    auth()->id(),

            ]);


            /*
            |--------------------------------------------------------------------------
            | Recalculate Both Seats
            |--------------------------------------------------------------------------
            */

            $this->recalculateSeatStatus(
                $oldSeatId
            );

            $this->recalculateSeatStatus(
                $newSeat->id
            );
        });


        return redirect()
            ->route('seat-assignments.index')
            ->with(
                'success',
                'Seat changed successfully.'
            );
    }


    /**
     * Recalculate physical seat status.
     */
    public function recalculateSeatStatus(
        int $seatId
    ): void {

        $activeAssignments = SeatAssignment::where(
                'seat_id',
                $seatId
            )
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->with('membership.plan')
            ->get();


        $hasMorning = $activeAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Morning';

        });


        $hasEvening = $activeAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Evening';

        });


        $hasFullDay = $activeAssignments->contains(function ($assignment) {

            return $assignment->membership?->plan?->shift === 'Full Day';

        });


        $seatStatus = 'available';


        if (
            $hasFullDay ||
            ($hasMorning && $hasEvening)
        ) {

            $seatStatus = 'occupied';

        }


        Seat::where(
            'id',
            $seatId
        )->update([

            'status' => $seatStatus,

            'updated_by' => auth()->id(),

        ]);
    }
}