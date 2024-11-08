<?php

return [

    'defaults' => [
        'guard' => 'sebak_web',  // Set this as the default guard
        'passwords' => 'sebak_id',
    ],

    'guards' => [

        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'sebak_api' => [
            'driver' => 'sanctum',  // or 'passport' if you're using Laravel Passport
            'provider' => 'sebak_users',
            'hash' => false,
        ],

        'sebak_web' => [
            'driver' => 'session',
            'provider' => 'sebak_users',
        ],

        // Optional: Add a 'sebak' guard for consistency if needed
        'sebak' => [
            'driver' => 'session',
            'provider' => 'sebak_users',
        ],

    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'sebak_users' => [
            'driver' => 'eloquent',
            'model' => App\Models\Sebaklogin::class,  // Ensure this model exists
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],

        'sebak_id' => [
            'provider' => 'sebak_users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];
