<?php

namespace App\Http\Controllers;

use App\Models\MembershipPlan;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MembershipPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request('search');
        $status = request('status');

        $plans = MembershipPlan::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_active', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPlans = MembershipPlan::count();

        $activePlans = MembershipPlan::where('is_active', true)->count();

        $inactivePlans = MembershipPlan::where('is_active', false)->count();

        return view('membership-plans.index', compact(
            'plans',
            'totalPlans',
            'activePlans',
            'inactivePlans'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('membership-plans.create', compact('services'));
    }


    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'duration_months' => ['required', 'integer', 'min:1'],
            'shift' => ['required', 'in:Morning,Evening,Full Day'],
            'price' => ['required', 'numeric', 'min:0'],
            'badge_color' => ['required'],
            'description' => ['nullable'],
            'is_active' => ['required', 'boolean'],

            'services' => ['nullable', 'array'],
            'services.*' => ['integer', 'exists:services,id'],
        ]);


        $membershipPlan = MembershipPlan::create([
            'name' => $validated['name'],

            'code' => strtoupper(
                Str::slug($validated['name'], '_')
                . '_' .
                $validated['duration_months'] . 'M_' .
                Str::slug($validated['shift'], '_')
            ),

            'duration_months' => $validated['duration_months'],
            'shift' => $validated['shift'],
            'price' => $validated['price'],
            'badge_color' => $validated['badge_color'],
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'],
            'created_by' => auth()->id(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Attach Services
        |--------------------------------------------------------------------------
        */

        $membershipPlan->services()->sync(
            $validated['services'] ?? []
        );


        return redirect()
            ->route('membership-plans.index')
            ->with('success', 'Membership Plan created successfully.');
    }


    /**
     * Show the specified resource.
     */
    public function show(MembershipPlan $membershipPlan)
    {
        $membershipPlan->load('services');

        return view('membership-plans.show', compact('membershipPlan'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MembershipPlan $membershipPlan)
    {
        $services = Service::where('is_active', true)
            ->orderBy('name')
            ->get();

        $membershipPlan->load('services');

        return view('membership-plans.edit', compact(
            'membershipPlan',
            'services'
        ));
    }


    /**
     * Update the specified resource.
     */
    public function update(Request $request, MembershipPlan $membershipPlan)
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'duration_months' => ['required', 'integer', 'min:1'],
            'shift' => ['required', 'in:Morning,Evening,Full Day'],
            'price' => ['required', 'numeric', 'min:0'],
            'badge_color' => ['required'],
            'description' => ['nullable'],
            'is_active' => ['required', 'boolean'],

            'services' => ['nullable', 'array'],
            'services.*' => ['integer', 'exists:services,id'],
        ]);


        $membershipPlan->update([
            'name' => $validated['name'],

            'code' => strtoupper(
                Str::slug($validated['name'], '_')
                . '_' .
                $validated['duration_months'] . 'M_' .
                Str::slug($validated['shift'], '_')
            ),

            'duration_months' => $validated['duration_months'],
            'shift' => $validated['shift'],
            'price' => $validated['price'],
            'badge_color' => $validated['badge_color'],
            'description' => $validated['description'] ?? null,
            'is_active' => $validated['is_active'],
            'updated_by' => auth()->id(),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update Services
        |--------------------------------------------------------------------------
        */

        $membershipPlan->services()->sync(
            $validated['services'] ?? []
        );


        return redirect()
            ->route('membership-plans.index')
            ->with('success', 'Membership Plan updated successfully.');
    }


    /**
     * Remove the specified resource.
     */
    public function destroy(MembershipPlan $membershipPlan)
    {
        $membershipPlan->delete();

        return redirect()
            ->route('membership-plans.index')
            ->with('success', 'Membership Plan deleted successfully.');
    }
}