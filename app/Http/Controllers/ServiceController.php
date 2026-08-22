<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display all services.
     */
    public function index()
    {
        $search = request('search');

        $services = Service::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('services.index', compact('services'));
    }

    /**
     * Show create service form.
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store new service.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ]);

        $code = strtoupper(Str::slug($validated['name'], '_'));

        $baseCode = $code;
        $counter = 1;

        while (Service::where('code', $code)->exists()) {
            $code = $baseCode . '_' . $counter;
            $counter++;
        }

        Service::create([
    'name' => $validated['name'],
    'code' => $code,
    'description' => $validated['description'] ?? null,
    'is_active' => $validated['is_active'],
]);
        return redirect()
            ->route('services.index')
            ->with('success', 'Service created successfully.');
    }
}