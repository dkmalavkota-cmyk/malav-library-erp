<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\View\View;

class PublicPricingController extends Controller
{
    /**
     * Display public SaaS pricing.
     */
    public function index(): View
    {
        $plans = Plan::query()
            ->where('is_active', true)
            ->where('is_public', true)
            ->orderByRaw("CASE
                WHEN name = 'Free Trial' THEN 1
                WHEN name = 'Starter' THEN 2
                WHEN name = 'Professional' THEN 3
                WHEN name = 'Premium' THEN 4
                ELSE 5
            END")
            ->orderBy('name')
            ->get();

        return view('pricing', [
            'plans' => $plans,
        ]);
    }
}