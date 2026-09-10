<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SubscriptionExpiredController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();

        $subscription = $user?->library
            ?->subscriptions()
            ->with('plan')
            ->latest('ends_at')
            ->first();

        return view('subscription.expired', [
            'subscription' => $subscription,
            'library' => $user?->library,
        ]);
    }
}