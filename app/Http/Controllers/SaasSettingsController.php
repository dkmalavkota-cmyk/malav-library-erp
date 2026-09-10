<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class SaasSettingsController extends Controller
{
    /**
     * Display SaaS platform settings.
     */
    public function index(): View
    {
        return view('saas.settings.index');
    }
}