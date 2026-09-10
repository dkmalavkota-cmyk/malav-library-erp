<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Library;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user
     * with their own library and initial 5-day free trial subscription.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            ...$this->profileRules(),

            'library_name' => [
                'required',
                'string',
                'max:255',
            ],

            'password' => $this->passwordRules(),
        ])->validate();

        return DB::transaction(function () use ($input) {

            /*
            |--------------------------------------------------------------------------
            | Find Free Trial Plan
            |--------------------------------------------------------------------------
            */

            $trialPlan = Plan::where('name', 'Free Trial')
                ->where('is_active', true)
                ->firstOrFail();

            /*
            |--------------------------------------------------------------------------
            | Generate Unique Library Code
            |--------------------------------------------------------------------------
            */

            $baseCode = strtoupper(
                substr(
                    preg_replace(
                        '/[^A-Za-z0-9]/',
                        '',
                        $input['library_name']
                    ),
                    0,
                    6
                )
            );

            $baseCode = $baseCode ?: 'LIB';

            $code = $baseCode;
            $counter = 1;

            while (Library::where('code', $code)->exists()) {
                $code = $baseCode . $counter;
                $counter++;
            }

            /*
            |--------------------------------------------------------------------------
            | Create Library
            |--------------------------------------------------------------------------
            */

            $library = Library::create([
                'name' => $input['library_name'],
                'code' => $code,
                'country' => 'India',
                'opening_time' => '06:00:00',
                'closing_time' => '22:00:00',
                'sunday_open' => true,
                'currency' => 'INR',
                'student_prefix' => $baseCode,
                'status' => 'active',
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Owner User
            |--------------------------------------------------------------------------
            */

            $user = User::create([
                'library_id' => $library->id,
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Create Initial 5-Day Free Trial Subscription
            |--------------------------------------------------------------------------
            |
            | Every new library gets the Free Trial plan.
            | The existing plan_name field is retained for backward compatibility.
            |
            */

            Subscription::create([
                'library_id' => $library->id,
                'plan_id' => $trialPlan->id,
                'plan_name' => $trialPlan->name,
                'starts_at' => now()->toDateString(),
                'ends_at' => now()->addDays(5)->toDateString(),
                'status' => 'trial',
                'amount' => 0,
                'notes' => 'Initial 5-day free trial created during library registration.',
            ]);

            return $user;
        });
    }
}