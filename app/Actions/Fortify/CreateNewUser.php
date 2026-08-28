<?php

namespace App\Actions\Fortify;

use App\Concerns\PasswordValidationRules;
use App\Concerns\ProfileValidationRules;
use App\Models\Library;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules, ProfileValidationRules;

    /**
     * Validate and create a newly registered user
     *
     * with their own library.
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
            | Create User
            |--------------------------------------------------------------------------
            */

            return User::create([
                'library_id' => $library->id,
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
            ]);
        });
    }
}