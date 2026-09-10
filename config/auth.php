<?php

use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    */

    'guards' => [

        // Main ERP Admin / Employee login
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // Existing Library Student Exam Portal login
        'student_exam' => [
            'driver' => 'session',
            'provider' => 'student_exam_accounts',
        ],

        // External / Public Exam Student login
        'exam_user' => [
            'driver' => 'session',
            'provider' => 'exam_users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    */

    'providers' => [

        // Main ERP users
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', User::class),
        ],

        // Existing Library Student Exam Accounts
        'student_exam_accounts' => [
            'driver' => 'eloquent',
            'model' => \App\Models\StudentExamAccount::class,
        ],

        // External / Public Exam Users
        'exam_users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\ExamUser::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [

        'users' => [
            'provider' => 'users',
            'table' => env(
                'AUTH_PASSWORD_RESET_TOKEN_TABLE',
                'password_reset_tokens'
            ),
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    */

    'password_timeout' => env(
        'AUTH_PASSWORD_TIMEOUT',
        10800
    ),

];