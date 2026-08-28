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
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;

        $search = request('search');


        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        $services = Service::where(
                'library_id',
                $libraryId
            )
            ->when($search, function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    $q->where(
                        'name',
                        'like',
                        "%{$search}%"
                    )
                    ->orWhere(
                        'code',
                        'like',
                        "%{$search}%"
                    );

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return view(
            'services.index',
            compact('services')
        );
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
        /*
        |--------------------------------------------------------------------------
        | Current Library
        |--------------------------------------------------------------------------
        */

        $libraryId = auth()->user()->library_id;


        /*
        |--------------------------------------------------------------------------
        | Validate Request
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'is_active' => [
                'required',
                'boolean',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | Generate Service Code
        |--------------------------------------------------------------------------
        */

        $code = strtoupper(
            Str::slug(
                $validated['name'],
                '_'
            )
        );


        $baseCode = $code;
        $counter = 1;


        /*
        |--------------------------------------------------------------------------
        | Unique Code Inside Current Library
        |--------------------------------------------------------------------------
        */

        while (
            Service::where(
                'library_id',
                $libraryId
            )
            ->where(
                'code',
                $code
            )
            ->exists()
        ) {

            $code =
                $baseCode .
                '_' .
                $counter;

            $counter++;
        }


        /*
        |--------------------------------------------------------------------------
        | Create Service
        |--------------------------------------------------------------------------
        */

        Service::create([

            'library_id' =>
                $libraryId,

            'name' =>
                $validated['name'],

            'code' =>
                $code,

            'description' =>
                $validated['description'] ?? null,

            'is_active' =>
                $validated['is_active'],

            'created_by' =>
                auth()->id(),

        ]);


        return redirect()
            ->route('services.index')
            ->with(
                'success',
                'Service created successfully.'
            );
    }
}