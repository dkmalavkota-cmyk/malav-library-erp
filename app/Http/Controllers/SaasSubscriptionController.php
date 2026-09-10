<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class SaasSubscriptionController extends Controller
{
    /**
     * Display all SaaS subscriptions for Super Admin.
     */
    public function index(Request $request): View
    {
        $status = $request->string('status')->trim()->toString();
        $search = $request->string('search')->trim()->toString();

        $subscriptions = Subscription::query()
            ->with([
                'library:id,name,code,status',
                'plan:id,name,monthly_price,yearly_price,student_limit',
            ])
            ->when($status !== '', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('library', function ($libraryQuery) use ($search) {
                    $libraryQuery
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%');
                });
            })
            ->latest('ends_at')
            ->paginate(20)
            ->withQueryString();

        $summary = [
            'total' => Subscription::query()->count(),
            'trial' => Subscription::query()->where('status', 'trial')->count(),
            'active' => Subscription::query()->where('status', 'active')->count(),
            'expired' => Subscription::query()->where('status', 'expired')->count(),
            'cancelled' => Subscription::query()->where('status', 'cancelled')->count(),
            'total_value' => Subscription::query()->sum('amount'),
        ];

        $statuses = [
            'trial',
            'active',
            'expired',
            'cancelled',
        ];

        return view('saas.subscriptions.index', [
            'subscriptions' => $subscriptions,
            'summary' => $summary,
            'statuses' => $statuses,
            'currentStatus' => $status,
            'search' => $search,
        ]);
    }

    /**
     * Show the create subscription form.
     */
    public function create(): View
    {
        $libraries = Library::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        $plans = Plan::query()
            ->where('is_active', true)
            ->orderByRaw("CASE
                WHEN name = 'Free Trial' THEN 1
                WHEN name = 'Starter' THEN 2
                WHEN name = 'Professional' THEN 3
                WHEN name = 'Premium' THEN 4
                ELSE 5
            END")
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'monthly_price',
                'yearly_price',
                'student_limit',
            ]);

        return view('saas.subscriptions.create', [
            'libraries' => $libraries,
            'plans' => $plans,
        ]);
    }

    /**
     * Store a new SaaS subscription.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'library_id' => ['required', 'integer', 'exists:libraries,id'],
            'plan_id' => ['required', 'integer', 'exists:plans,id'],
            'billing_cycle' => ['required', 'in:monthly,yearly'],
            'starts_at' => ['required', 'date'],
            'status' => ['required', 'in:active,trial'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $library = Library::query()
            ->where('status', 'active')
            ->findOrFail($validated['library_id']);

        $plan = Plan::query()
            ->where('is_active', true)
            ->findOrFail($validated['plan_id']);

        $startsAt = Carbon::parse($validated['starts_at'])->startOfDay();

        $endsAt = $validated['billing_cycle'] === 'yearly'
            ? $startsAt->copy()->addYear()
            : $startsAt->copy()->addMonth();

        $amount = $validated['billing_cycle'] === 'yearly'
            ? $plan->yearly_price
            : $plan->monthly_price;

        Subscription::create([
            'library_id' => $library->id,
            'plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'billing_cycle' => $validated['billing_cycle'],
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => $validated['status'],
            'amount' => $amount,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('saas.subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Show the edit subscription form.
     */
    public function edit(Subscription $subscription): View
    {
        $subscription->load('plan');

        $libraries = Library::query()
            ->where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name', 'code']);

        $plans = Plan::query()
            ->where(function ($query) use ($subscription) {
                $query
                    ->where('is_active', true)
                    ->orWhere('id', $subscription->plan_id);
            })
            ->orderByRaw("CASE
                WHEN name = 'Free Trial' THEN 1
                WHEN name = 'Starter' THEN 2
                WHEN name = 'Professional' THEN 3
                WHEN name = 'Premium' THEN 4
                ELSE 5
            END")
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'monthly_price',
                'yearly_price',
                'student_limit',
            ]);

        return view('saas.subscriptions.edit', [
            'subscription' => $subscription,
            'libraries' => $libraries,
            'plans' => $plans,
        ]);
    }

    /**
     * Update an existing SaaS subscription.
     */
    public function update(
        Request $request,
        Subscription $subscription
    ): RedirectResponse {
        $validated = $request->validate([
            'library_id' => ['required', 'integer', 'exists:libraries,id'],
            'plan_id' => ['required', 'integer', 'exists:plans,id'],
            'billing_cycle' => ['required', 'in:monthly,yearly'],
            'starts_at' => ['required', 'date'],
            'status' => ['required', 'in:active,trial,expired,cancelled'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $library = Library::query()
            ->where('status', 'active')
            ->findOrFail($validated['library_id']);

        $plan = Plan::query()->findOrFail($validated['plan_id']);

        $startsAt = Carbon::parse($validated['starts_at'])->startOfDay();

        $endsAt = $validated['billing_cycle'] === 'yearly'
            ? $startsAt->copy()->addYear()
            : $startsAt->copy()->addMonth();

        $amount = $validated['billing_cycle'] === 'yearly'
            ? $plan->yearly_price
            : $plan->monthly_price;

        $subscription->update([
            'library_id' => $library->id,
            'plan_id' => $plan->id,
            'plan_name' => $plan->name,
            'billing_cycle' => $validated['billing_cycle'],
            'starts_at' => $startsAt,
            'ends_at' => $endsAt,
            'status' => $validated['status'],
            'amount' => $amount,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()
            ->route('saas.subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }
}