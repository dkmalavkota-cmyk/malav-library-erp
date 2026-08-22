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

/*
|--------------------------------------------------------------------------
| Automatically Expire Memberships
|--------------------------------------------------------------------------
*/

Membership::where('status', 'Active')
    ->whereDate('end_date', '<', today())
    ->update([
        'status' => 'Expired',
        'updated_by' => auth()->id(),
    ]);
    $search = request('search');
    $status = request('status');

    $memberships = Membership::with([
            'student',
            'plan',
        ])
        // Only memberships having a valid student and plan
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

    $totalMemberships = Membership::count();

    $activeMemberships = Membership::where('status', 'Active')->count();

    $expiredMemberships = Membership::where('status', 'Expired')->count();

    $todayMemberships = Membership::whereDate(
        'created_at',
        today()
    )->count();


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
    $students = Student::whereDoesntHave('memberships', function ($query) {
        $query->where('status', 'Active');
    })
    ->orderBy('first_name')
    ->get();

    $plans = MembershipPlan::where('is_active', true)
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
    $validated = $request->validate([
        'student_id' => ['required', 'exists:students,id'],
        'membership_plan_id' => ['required', 'exists:membership_plans,id'],
        'start_date' => ['required', 'date'],
        'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        'final_amount' => ['required', 'numeric', 'min:0'],
        'status' => ['required'],
    ]);

    Membership::create([
        'student_id' => $validated['student_id'],
        'membership_plan_id' => $validated['membership_plan_id'],
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],

        // Required database fields
        'amount' => $validated['final_amount'],
        'discount' => 0,
        'final_amount' => $validated['final_amount'],

        'status' => $validated['status'],
        'remarks' => null,
        'created_by' => auth()->id(),
    ]);

    return redirect()
        ->route('memberships.index')
        ->with('success', 'Membership created successfully.');
}

/**
 * Show membership renewal form.
 */
public function renew(Membership $membership)
{
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

    return view('memberships.renew', compact(
        'membership'
    ));
}
/**
 * Store membership renewal with payment and seat carry-forward.
 */
public function renewStore(Request $request, Membership $membership)
{
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
            'required',
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

    $amount = (float) $validated['amount'];

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

    /*
    | Release old membership seat assignment
    */

    $oldSeatAssignment->update([

        'status' => 'Released',

        'released_date' => today(),

        'updated_by' => auth()->id(),

    ]);


    /*
    | Create new seat assignment
    */

    SeatAssignment::create([

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
                'receipt_no',
                $receiptNo
            )->exists()
        );


        /*
        |--------------------------------------------------------------------------
        | Create Payment
        |--------------------------------------------------------------------------
        */

        $payment = Payment::create([

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

    app(\App\Http\Controllers\SeatAssignmentController::class)
        ->recalculateSeatStatus(
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