<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Display payment list.
     */
    public function index()
    {
        $search = request('search');

        $payments = Payment::with([
                'student',
                'membership.plan',
            ])
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where('receipt_no', 'like', "%{$search}%")
                        ->orWhere('payment_mode', 'like', "%{$search}%")
                        ->orWhereHas('student', function ($student) use ($search) {

                            $student->where('student_code', 'like', "%{$search}%")
                                ->orWhere('first_name', 'like', "%{$search}%")
                                ->orWhere('last_name', 'like', "%{$search}%")
                                ->orWhere('mobile', 'like', "%{$search}%");

                        });

                });

            })
            ->latest('payment_date')
            ->paginate(10)
            ->withQueryString();

        /*
         * Only active payment records are included.
         * Soft-deleted payments are automatically excluded by Eloquent.
         */
        $todayCollection = Payment::whereDate(
            'payment_date',
            today()
        )->sum('amount');

        $totalCollection = Payment::sum('amount');

        $todayPayments = Payment::whereDate(
            'payment_date',
            today()
        )->count();

        return view('payments.index', compact(
            'payments',
            'todayCollection',
            'totalCollection',
            'todayPayments'
        ));
    }

    /**
     * Show fee collection form.
     */
    public function create()
    {
        $memberships = Membership::with([
                'student',
                'plan',
                'payments',
            ])
            ->where('status', 'Active')
            ->whereHas('student')
            ->whereHas('plan')
            ->whereDoesntHave('payments')
            ->latest()
            ->get();

        return view('payments.create', compact(
            'memberships'
        ));
    }

    /**
     * Store payment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'membership_id' => [
                'required',
                'exists:memberships,id',
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
        | Get Membership
        |--------------------------------------------------------------------------
        */

        $membership = Membership::with([
            'student',
            'plan',
        ])->findOrFail(
            $validated['membership_id']
        );

        /*
        |--------------------------------------------------------------------------
        | Student must still exist
        |--------------------------------------------------------------------------
        */

        if (! $membership->student) {

            return back()
                ->withErrors([
                    'membership_id' =>
                        'The student associated with this membership no longer exists.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Membership must be Active
        |--------------------------------------------------------------------------
        */

        if ($membership->status !== 'Active') {

            return back()
                ->withErrors([
                    'membership_id' =>
                        'Only active memberships can receive payment.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Calculate Amount
        |--------------------------------------------------------------------------
        */

        $planAmount = (float) $membership->final_amount;

        $discount = (float) ($validated['discount'] ?? 0);

        if ($discount > $planAmount) {

            return back()
                ->withErrors([
                    'discount' =>
                        'Discount cannot be greater than the membership amount.',
                ])
                ->withInput();
        }

        $finalAmount = max(
            $planAmount - $discount,
            0
        );

        /*
        |--------------------------------------------------------------------------
        | Verify Submitted Amount
        |--------------------------------------------------------------------------
        */

        $submittedAmount = (float) $validated['amount'];

        if (abs($submittedAmount - $finalAmount) > 0.01) {

            return back()
                ->withErrors([
                    'amount' =>
                        'Payment amount does not match the calculated payable amount.',
                ])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | Generate Receipt Number
        |--------------------------------------------------------------------------
        */

        $receiptNo = $this->generateReceiptNumber();

        /*
        |--------------------------------------------------------------------------
        | Create Payment
        |--------------------------------------------------------------------------
        */

        Payment::create([

            'student_id' => $membership->student_id,

            'membership_id' => $membership->id,

            'receipt_no' => $receiptNo,

            'amount' => $finalAmount,

            'payment_mode' => $validated['payment_mode'],

            'payment_date' => $validated['payment_date'],

            'transaction_id' =>
                $validated['transaction_id'] ?? null,

            'remarks' =>
                $validated['remarks'] ?? null,

            'created_by' => auth()->id(),

        ]);

        /*
        |--------------------------------------------------------------------------
        | Update Membership
        |--------------------------------------------------------------------------
        */

        $membership->update([

            'discount' => $discount,

            'final_amount' => $finalAmount,

            'updated_by' => auth()->id(),

        ]);

        return redirect()
            ->route('payments.index')
            ->with(
                'success',
                "Payment received successfully. Receipt No: {$receiptNo}"
            );
    }

    /**
     * Show payment receipt.
     */
    public function receipt(Payment $payment)
    {
        $payment->load([
            'student',
            'membership.plan',
        ]);

        return view('payments.receipt', compact('payment'));
    }

    /**
     * Generate unique receipt number.
     */
    private function generateReceiptNumber(): string
    {
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

        return $receiptNo;
    }
}