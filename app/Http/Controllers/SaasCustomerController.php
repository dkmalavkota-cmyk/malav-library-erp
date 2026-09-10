<?php

namespace App\Http\Controllers;

use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SaasCustomerController extends Controller
{
    /**
     * Display SaaS customers.
     */
    public function index(Request $request): View
    {
        $search = $request->string('search')->trim()->toString();

        $customers = Library::query()
            ->with([
                'users' => fn ($query) => $query
                    ->select([
                        'id',
                        'library_id',
                        'name',
                        'email',
                    ])
                    ->orderBy('id'),
                'subscriptions' => fn ($query) => $query
                    ->latest('ends_at'),
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($libraryQuery) use ($search) {
                    $libraryQuery
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%');
                });
            })
            ->orderByDesc('id')
            ->paginate(20)
            ->withQueryString();

        return view('saas.customers.index', [
            'customers' => $customers,
            'search' => $search,
        ]);
    }
}