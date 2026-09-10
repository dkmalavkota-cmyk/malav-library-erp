<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SaasPlanController extends Controller
{
    /**
     * Display all SaaS plans.
     */
    public function index()
    {
        $plans = Plan::query()
            ->withCount('subscriptions')
            ->orderByRaw("CASE
                WHEN name = 'Free Trial' THEN 1
                WHEN name = 'Starter' THEN 2
                WHEN name = 'Professional' THEN 3
                WHEN name = 'Premium' THEN 4
                ELSE 5
            END")
            ->orderBy('name')
            ->get();

        return view('saas.plans.index', compact('plans'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('saas.plans.create');
    }

    /**
     * Store a new plan.
     */
    public function store(Request $request)
    {
        $validated = $this->validatePlan($request);

        Plan::create($validated);

        return redirect()
            ->route('saas.plans.index')
            ->with('success', 'Plan created successfully.');
    }

    /**
     * Show edit form.
     */
    public function edit(Plan $plan)
    {
        return view('saas.plans.edit', compact('plan'));
    }

    /**
     * Update an existing plan.
     */
    public function update(Request $request, Plan $plan)
    {
        $validated = $this->validatePlan($request, $plan);

        $plan->update($validated);

        return redirect()
            ->route('saas.plans.index')
            ->with('success', 'Plan updated successfully.');
    }

    /**
     * Toggle plan active/inactive status.
     */
    public function toggle(Plan $plan)
    {
        $plan->update([
            'is_active' => !$plan->is_active,
        ]);

        return redirect()
            ->route('saas.plans.index')
            ->with(
                'success',
                $plan->is_active
                    ? 'Plan activated successfully.'
                    : 'Plan deactivated successfully.'
            );
    }

    /**
     * Validate plan data.
     */
    private function validatePlan(Request $request, ?Plan $plan = null): array
    {
        $nameRule = Rule::unique('plans', 'name');

        if ($plan) {
            $nameRule->ignore($plan->id);
        }

        return $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                $nameRule,
            ],

            'monthly_price' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'yearly_price' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'student_limit' => [
                'nullable',
                'integer',
                'min:1',
                'max:4294967295',
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],

            // Core Library ERP
            'student_management_access' => ['nullable', 'boolean'],
            'membership_access' => ['nullable', 'boolean'],
            'seat_management_access' => ['nullable', 'boolean'],
            'attendance_access' => ['nullable', 'boolean'],
            'payment_access' => ['nullable', 'boolean'],
            'expense_access' => ['nullable', 'boolean'],
            'id_card_access' => ['nullable', 'boolean'],
            'reports_access' => ['nullable', 'boolean'],

            // Online Examination
            'exam_access' => ['nullable', 'boolean'],
            'question_bank_access' => ['nullable', 'boolean'],
            'current_affairs_access' => ['nullable', 'boolean'],
            'major_test_access' => ['nullable', 'boolean'],
            'assigned_test_access' => ['nullable', 'boolean'],
            'public_exam_access' => ['nullable', 'boolean'],
            'advanced_reports_access' => ['nullable', 'boolean'],

            // Public Pricing Visibility
            'is_active' => ['nullable', 'boolean'],
            'is_public' => ['nullable', 'boolean'],
        ]);
    }
}