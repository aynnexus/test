
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook'=> [        
        'client_id'     => '1974724386150653',
        'client_secret' => '86cf30b512c4bd2f497e9b3815fec90a',
        'redirect'      => 'http://174.138.16.149/guest/login/facebook/callback'
    ],

    'google'=> [
        'client_id'     => '275452552098-dv498tql34isvfer4e0354q640l8rsds.apps.googleusercontent.com',
        'client_secret' => 'KlW8aj5V9zp5iU0dqwxn9yK6',
        'redirect'      => 'https://panel.nexus.com.mm/guest/login/google/callback'
    ],

];

