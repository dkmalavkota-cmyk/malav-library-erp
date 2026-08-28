<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\MembershipPlan;
use App\Models\Student;
use App\Models\SeatAssignment;
use App\Models\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MembershipController extends Controller
{
    /**
     * Display all memberships.
     */
    public function index()
    {
        $libraryId = auth()->user()->library_id;

        /*
        |--------------------------------------------------------------------------
        | Automatically Expire Memberships
        |--------------------------------------------------------------------------
        */

        Membership::where('library_id', $libraryId)
            ->where('status', 'Active')
            ->whereDate('end_date', '<', today())
            ->update([
                'status' => 'Expired',
                'updated_by' => auth()->id(),
            ]);

        $search = request('search');
        $status = request('status');

        $memberships = Membership::where('library_id', $libraryId)
            ->with([
                'student',
                'plan',
            ])
            ->whereHas('student')
            ->whereHas('plan')

            ->when($search, function ($query) use ($search) {

                $query->whereHas('student', function ($student) use ($search) {

                    $student->where(function ($q) use ($search) {

                        $q->where('student_code', 'like', "%{$search}%")
                            ->orWhere('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%")
                            ->orWhere('mobile', 'like', "%{$search}%");

                    });

                });

            })

            ->when($status, function ($query) use ($status) {

                $query->where('status', $status);

            })

            ->latest()
            ->paginate(10)
            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | Membership Statistics
        |--------------------------------------------------------------------------
        */

        $totalMemberships = Membership::where(
            'library_id',
            $libraryId
        )->count();

        $activeMemberships = Membership::where(
            'library_id',
            $libraryId
        )
            ->where('status', 'Active')
            ->count();

        $expiredMemberships = Membership::where(
            'library_id',
            $libraryId
        )
            ->where('status', 'Expired')
            ->count();

        $todayMemberships = Membership::where(
            'library_id',
            $libraryId
        )
            ->whereDate('created_at', today())
            ->count();

        /*
        |--------------------------------------------------------------------------
        | Send Data To View
        |--------------------------------------------------------------------------
        */

        return view('memberships.index', compact(
            'memberships',
            'totalMemberships',
            'activeMemberships',
            'expiredMemberships',
            'todayMemberships'
        ));
    }

    /**
     * Show create membership form.
     */
    public function create()
    {
        $libraryId = auth()->user()->library_id;

        $students = Student::where('library_id', $libraryId)
            ->whereDoesntHave('memberships', function ($query) {
                $query->where('status', 'Active');
            })
            ->orderBy('first_name')
            ->get();

        $plans = MembershipPlan::where(
            'library_id',
            $libraryId
        )
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('memberships.create', compact(
            'students',
            'plans'
        ));
    }

    /**
     * Store membership.
     */
    public function store(Request $request)
    {
        $libraryId = auth()->user()->library_id;

        $validated = $request->validate([
            'student_id' => [
    'required',
    \Illuminate\Validation\Rule::exists('students', 'id')
        ->where(fn ($query) => $query->where('library_id', $libraryId)),
],

'membership_plan_id' => [
    'required',
    \Illuminate\Validation\Rule::exists('membership_plans', 'id')
        ->where(fn ($query) => $query->where('library_id', $libraryId)),
],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
           'final_amount' => ['nullable', 'numeric', 'min:0'],
            
        ]);

        /*
        |--------------------------------------------------------------------------
        | Make Sure Student & Plan Belong To Current Library
        |--------------------------------------------------------------------------
        */

        $student = Student::where('library_id', $libraryId)
            ->findOrFail($validated['student_id']);

        $plan = MembershipPlan::where('library_id', $libraryId)
            ->findOrFail($validated['membership_plan_id']);
            if (
    Membership::where('library_id', $libraryId)
        ->where('student_id', $student->id)
        ->where('status', 'Active')
        ->exists()
) {
    return back()
        ->withErrors([
            'student_id' => 'This student already has an active membership.',
        ])
        ->withInput();
}

        Membership::create([
            'library_id' => $libraryId,
            'student_id' => $student->id,
            'membership_plan_id' => $plan->id,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],

           'amount' => $plan->price,
            'discount' => 0,
           'final_amount' => $plan->price,

           'status' => 'Active',
            'remarks' => null,
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('memberships.index')
            ->with(
                'success',
                'Membership created successfully.'
            );
    }

    /**
     * Show membership renewal form.
     */
    public function renew(Membership $membership)
    {
        abort_unless(
            $membership->library_id === auth()->user()->library_id,
            404
        );

        if ($membership->status !== 'Expired') {

            return redirect()
                ->route('memberships.index')
                ->with(
                    'error',
                    'Only expired memberships can be renewed.'
                );
        }

        $membership->load([
            'student',
            'plan',
        ]);

        return view(
            'memberships.renew',
            compact('membership')
        );
    }

    /**
     * Store membership renewal with payment and seat carry-forward.
     */
    public function renewStore(
        Request $request,
        Membership $membership
    ) {
        $libraryId = auth()->user()->library_id;

        abort_unless(
            $membership->library_id === $libraryId,
            404
        );

        /*
        |--------------------------------------------------------------------------
        | Only Expired Membership Can Be Renewed
        |--------------------------------------------------------------------------
        */

        if ($membership->status !== 'Expired') {

            return redirect()
                ->route('memberships.index')
                ->with(
                    'error',
                    'Only expired memberships can be renewed.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Load Membership
        |--------------------------------------------------------------------------
        */

        $membership->load([
            'student',
            'plan',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'start_date' => [
                'required',
                'date',
            ],

           'amount' => [
    'nullable',
    'numeric',
    'min:0',
],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'payment_mode' => [
                'required',
                'in:Cash,UPI,Card,Bank Transfer',
            ],

            'payment_date' => [
                'required',
                'date',
            ],

            'transaction_id' => [
                'nullable',
                'string',
                'max:255',
            ],

            'remarks' => [
                'nullable',
                'string',
            ],

        ]);

        /*
        |--------------------------------------------------------------------------
        | Calculate Amount
        |--------------------------------------------------------------------------
        */

       $amount = (float) $membership->plan->price;

        $discount = (float) (
            $validated['discount'] ?? 0
        );

        /*
        |--------------------------------------------------------------------------
        | Validate Discount
        |--------------------------------------------------------------------------
        */

        if ($discount > $amount) {

            return back()
                ->withErrors([
                    'discount' =>
                        'Discount cannot be greater than the membership amount.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Final Payable Amount
        |--------------------------------------------------------------------------
        */

        $finalAmount = max(
            $amount - $discount,
            0
        );

        /*
        |--------------------------------------------------------------------------
        | Calculate New Membership Dates
        |--------------------------------------------------------------------------
        */

        $startDate = Carbon::parse(
            $validated['start_date']
        );

        $durationMonths = (int) (
            $membership->plan?->duration_months ?? 1
        );

        $endDate = $startDate
            ->copy()
            ->addMonths($durationMonths)
            ->subDay();

        /*
        |--------------------------------------------------------------------------
        | Find Existing Active Seat
        |--------------------------------------------------------------------------
        */

        $oldSeatAssignment = SeatAssignment::where(
            'library_id',
            $libraryId
        )
            ->where(
                'membership_id',
                $membership->id
            )
            ->where('status', 'Active')
            ->whereNull('released_date')
            ->latest('assigned_date')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Create Membership + Payment + Seat Together
        |--------------------------------------------------------------------------
        */

        $payment = DB::transaction(function () use (
            $libraryId,
            $membership,
            $validated,
            $startDate,
            $endDate,
            $amount,
            $discount,
            $finalAmount,
            $oldSeatAssignment
        ) {

            /*
            |--------------------------------------------------------------------------
            | Create New Membership
            |--------------------------------------------------------------------------
            */

            $newMembership = Membership::create([

                'library_id' =>
                    $libraryId,

                'student_id' =>
                    $membership->student_id,

                'membership_plan_id' =>
                    $membership->membership_plan_id,

                'start_date' =>
                    $startDate->format('Y-m-d'),

                'end_date' =>
                    $endDate->format('Y-m-d'),

                'amount' =>
                    $amount,

                'discount' =>
                    $discount,

                'final_amount' =>
                    $finalAmount,

                'status' =>
                    'Active',

                'remarks' =>
                    $validated['remarks'] ?? null,

                'created_by' =>
                    auth()->id(),

            ]);

            /*
            |--------------------------------------------------------------------------
            | Carry Forward Existing Seat
            |--------------------------------------------------------------------------
            */

            if ($oldSeatAssignment) {

                $oldSeatAssignment->update([

                    'status' => 'Released',

                    'released_date' => today(),

                    'updated_by' => auth()->id(),

                ]);

                SeatAssignment::create([

                    'library_id' =>
                        $libraryId,

                    'student_id' =>
                        $membership->student_id,

                    'membership_id' =>
                        $newMembership->id,

                    'seat_id' =>
                        $oldSeatAssignment->seat_id,

                    'assigned_date' =>
                        $startDate->format('Y-m-d'),

                    'status' =>
                        'Active',

                    'remarks' =>
                        'Seat carried forward during membership renewal.',

                    'created_by' =>
                        auth()->id(),

                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Generate Receipt Number
            |--------------------------------------------------------------------------
            */

            do {

                $receiptNo =
                    'ML-' .
                    now()->format('Ym') .
                    '-' .
                    strtoupper(Str::random(6));

            } while (
                Payment::where(
                    'library_id',
                    $libraryId
                )
                    ->where(
                        'receipt_no',
                        $receiptNo
                    )
                    ->exists()
            );

            /*
            |--------------------------------------------------------------------------
            | Create Payment
            |--------------------------------------------------------------------------
            */

            $payment = Payment::create([

                'library_id' =>
                    $libraryId,

                'student_id' =>
                    $membership->student_id,

                'membership_id' =>
                    $newMembership->id,

                'receipt_no' =>
                    $receiptNo,

                'amount' =>
                    $finalAmount,

                'payment_mode' =>
                    $validated['payment_mode'],

                'payment_date' =>
                    $validated['payment_date'],

                'transaction_id' =>
                    $validated['transaction_id'] ?? null,

                'remarks' =>
                    $validated['remarks'] ?? null,

                'created_by' =>
                    auth()->id(),

            ]);

            return $payment;
        });

        /*
        |--------------------------------------------------------------------------
        | Recalculate Carried Forward Seat
        |--------------------------------------------------------------------------
        */

        if ($oldSeatAssignment) {

            app(
                \App\Http\Controllers\SeatAssignmentController::class
            )->recalculateSeatStatus(
                $oldSeatAssignment->seat_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Success
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                "Membership renewed, seat carried forward and payment received successfully. Receipt No: {$payment->receipt_no}"
            );
    }
}