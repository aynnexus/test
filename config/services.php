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
        'client_id'     => '536103743445462',
        'client_secret' => '957cc685f07c6c342e8a831e99954000',
        'redirect'      => 'http://192.168.43.181/guest/login/facebook/callback'
    ],

    'google'=> [
        'client_id'     => '275452552098-ah3t42nibns1pentoi3qjsurt1qgot4k.apps.googleusercontent.com',
        'client_secret' => 'YvNQG99ljK-y0GCk3Iy-PbYV',
        'redirect'      => 'http://13.228.141.122/guest/login/google/callback'
    ],

];
