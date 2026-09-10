<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| SaaS Subscription Scheduler
|--------------------------------------------------------------------------
|
| Automatically mark expired trial and active subscriptions as expired.
|
*/

Schedule::command('subscriptions:expire')
    ->dailyAt('01:00')
    ->withoutOverlapping();