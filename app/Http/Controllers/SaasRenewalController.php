<?php

namespace App\Http\Controllers;

use App\Models\Library;
use App\Models\SaasPayment;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class SaasRenewalController extends Controller
{
    /**
     * Display subscription renewals and upcoming expiries
     * for the Super Admin SaaS panel.
     */
    public function index(Request $request): View
    {
        $filter = $request->string('filter')->trim()->toString();
        $search = $request->string('search')->trim()->toString();

        $today = now()->startOfDay();
        $expiringUntil = now()->addDays(30)->endOfDay();

        $subscriptions = Subscription::query()
            ->with([
                'library:id,name,code,status',
                'plan:id,name,monthly_price,yearly_price',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->whereHas('library', function ($libraryQuery) use ($search) {
                    $libraryQuery
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%');
                });
            })
            ->when($filter === 'active', function ($query) use ($today) {
                $query
                    ->whereIn('status', ['trial', 'active'])
                    ->whereDate('ends_at', '>=', $today);
            })
            ->when($filter === 'expiring', function ($query) use ($today, $expiringUntil) {
                $query
                    ->whereIn('status', ['trial', 'active'])
                    ->whereBetween('ends_at', [
                        $today->toDateString(),
                        $expiringUntil->toDateString(),
                    ]);
            })
            ->when($filter === 'expired', function ($query) use ($today) {
                $query->where(function ($subscriptionQuery) use ($today) {
                    $subscriptionQuery
                        ->where('status', 'expired')
                        ->orWhereDate('ends_at', '<', $today);
                });
            })
            ->when($filter === 'cancelled', function ($query) {
                $query->where('status', 'cancelled');
            })
            ->orderBy('ends_at')
            ->paginate(20)
            ->withQueryString();

        $summary = [
            'total' => Subscription::query()->count(),

            'active' => Subscription::query()
                ->whereIn('status', ['trial', 'active'])
                ->whereDate('ends_at', '>=', $today)
                ->count(),

            'expiring' => Subscription::query()
                ->whereIn('status', ['trial', 'active'])
                ->whereBetween('ends_at', [
                    $today->toDateString(),
                    $expiringUntil->toDateString(),
                ])
                ->count(),

            'expired' => Subscription::query()
                ->where(function ($query) use ($today) {
                    $query
                        ->where('status', 'expired')
                        ->orWhereDate('ends_at', '<', $today);
                })
                ->count(),

            'cancelled' => Subscription::query()
                ->where('status', 'cancelled')
                ->count(),
        ];

        $filters = [
            'active',
            'expiring',
            'expired',
            'cancelled',
        ];

        return view('saas.renewals.index', [
            'subscriptions' => $subscriptions,
            'summary' => $summary,
            'filters' => $filters,
            'currentFilter' => $filter,
            'search' => $search,
        ]);
    }

    /**
     * Renew an existing subscription.
     *
     * Active subscription:
     * Continue from the existing expiry date.
     *
     * Expired subscription:
     * Restart from today.
     */
    public function renew(Subscription $subscription): RedirectResponse
    {
        $subscription->load('plan');

        $plan = $subscription->plan;

        if (!$plan) {
            return back()->with('error', 'Subscription plan not found.');
        }

        if (!$plan->is_active) {
            return back()->with(
                'error',
                'This plan is currently inactive and cannot be renewed.'
            );
        }

        /*
         * Free Trial should never be renewed as a paid subscription.
         * Trial access is only for new registrations.
         */
        if ($plan->name === 'Free Trial') {
            return back()->with(
                'error',
                'Free Trial cannot be renewed. Please move the customer to a paid plan.'
            );
        }

        $today = now()->startOfDay();

        $existingEndDate = $subscription->ends_at
            ? Carbon::parse($subscription->ends_at)->startOfDay()
            : null;

        /*
         * If the current subscription is still active,
         * renewal starts immediately after the current expiry.
         *
         * Example:
         * Current expiry: 10 Sep
         * New subscription starts: 11 Sep
         */
        if (
            $existingEndDate &&
            $existingEndDate->gte($today) &&
            in_array($subscription->status, ['trial', 'active'], true)
        ) {
            $startDate = $existingEndDate->copy()->addDay();
        } else {
            /*
             * Expired/cancelled subscriptions restart from today.
             */
            $startDate = $today->copy();
        }

        if ($subscription->billing_cycle === 'yearly') {
            $endDate = $startDate->copy()->addYear()->subDay();
            $amount = $plan->yearly_price;
        } else {
            $endDate = $startDate->copy()->addMonth()->subDay();
            $amount = $plan->monthly_price;
        }

        $subscription->update([
            'starts_at' => $startDate,
            'ends_at' => $endDate,
            'status' => 'active',
            'plan_name' => $plan->name,
            'amount' => $amount,
        ]);

        /*
         * Manual renewal payment record.
         *
         * Later, when Razorpay/Stripe/etc. is integrated,
         * this will be replaced/extended by the real gateway
         * payment + webhook flow.
         */
        SaasPayment::create([
            'library_id' => $subscription->library_id,
            'subscription_id' => $subscription->id,
            'amount' => $amount,
            'currency' => 'INR',
            'payment_method' => 'Manual',
            'transaction_id' => 'RNW-' . now()->format('YmdHis') . '-' . $subscription->id,
            'status' => 'paid',
            'paid_at' => now(),
            'notes' => ucfirst($subscription->billing_cycle)
                . ' subscription renewed manually by Super Admin.',
        ]);

        return back()->with(
            'success',
            'Subscription renewed successfully.'
        );
    }
}