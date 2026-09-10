<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\SaasPayment;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class SaasPaymentController extends Controller
{
    /**
     * Display SaaS payment history for Super Admin.
     */
    public function index(Request $request): View
    {
        $status = $request->string('status')->trim()->toString();
        $method = $request->string('method')->trim()->toString();
        $search = $request->string('search')->trim()->toString();

        $payments = SaasPayment::query()
            ->with([
                'library:id,name,code,status',
                'subscription:id,library_id,plan_name',
            ])
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($method !== '', function ($query) use ($method) {
                $query->where('payment_method', $method);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($paymentQuery) use ($search) {
                    $paymentQuery
                        ->where('transaction_id', 'like', '%' . $search . '%')
                        ->orWhereHas('library', function ($libraryQuery) use ($search) {
                            $libraryQuery
                                ->where('name', 'like', '%' . $search . '%')
                                ->orWhere('code', 'like', '%' . $search . '%');
                        });
                });
            })
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        $summary = [
            'total' => SaasPayment::query()->count(),

            'paid' => SaasPayment::query()
                ->where('status', 'paid')
                ->count(),

            'pending' => SaasPayment::query()
                ->where('status', 'pending')
                ->count(),

            'failed' => SaasPayment::query()
                ->where('status', 'failed')
                ->count(),

            'refunded' => SaasPayment::query()
                ->where('status', 'refunded')
                ->count(),

            'revenue' => SaasPayment::query()
                ->where('status', 'paid')
                ->sum('amount'),

            'pending_amount' => SaasPayment::query()
                ->where('status', 'pending')
                ->sum('amount'),
        ];

        $statuses = [
            'paid',
            'pending',
            'failed',
            'refunded',
        ];

        $methods = SaasPayment::query()
            ->whereNotNull('payment_method')
            ->where('payment_method', '!=', '')
            ->distinct()
            ->orderBy('payment_method')
            ->pluck('payment_method');

        return view('saas.payments.index', [
            'payments' => $payments,
            'summary' => $summary,
            'statuses' => $statuses,
            'methods' => $methods,
            'currentStatus' => $status,
            'currentMethod' => $method,
            'search' => $search,
        ]);
    }

    /**
     * Show the manual SaaS payment form.
     */
    public function create(): View
    {
        $libraries = Library::query()
            ->where('status', 'active')
            ->with([
                'subscriptions' => function ($query) {
                    $query
                        ->with('plan:id,name,monthly_price,yearly_price')
                        ->latest('ends_at');
                },
            ])
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'code',
            ]);

        return view('saas.payments.create', [
            'libraries' => $libraries,
        ]);
    }

    /**
     * Store a manually recorded SaaS payment.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'subscription_id' => [
                'required',
                'integer',
                'exists:subscriptions,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
                'max:9999999999.99',
            ],
            'currency' => [
                'required',
                'string',
                'max:10',
            ],
            'payment_method' => [
                'required',
                'string',
                'max:50',
            ],
            'transaction_id' => [
                'nullable',
                'string',
                'max:150',
            ],
            'status' => [
                'required',
                'in:paid,pending,failed,refunded',
            ],
            'paid_at' => [
                'nullable',
                'date',
            ],
            'notes' => [
                'nullable',
                'string',
                'max:5000',
            ],
        ]);

        $subscription = Subscription::query()
            ->with('plan')
            ->findOrFail($validated['subscription_id']);

        if (
            !empty($validated['transaction_id']) &&
            SaasPayment::query()
                ->where('transaction_id', $validated['transaction_id'])
                ->exists()
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'transaction_id' => 'This transaction/reference ID has already been recorded.',
                ]);
        }

        $paidAt = null;

        if ($validated['status'] === 'paid') {
            $paidAt = !empty($validated['paid_at'])
                ? Carbon::parse($validated['paid_at'])
                : now();
        }

        SaasPayment::create([
            'library_id' => $subscription->library_id,
            'subscription_id' => $subscription->id,
            'amount' => $validated['amount'],
            'currency' => strtoupper($validated['currency']),
            'payment_method' => $validated['payment_method'],
            'transaction_id' => $validated['transaction_id'] ?? null,
            'status' => $validated['status'],
            'paid_at' => $paidAt,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('saas.payments.index')
            ->with('success', 'Payment recorded successfully.');
    }
}