
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
        'client_id'     => '729919953870709',
        'client_secret' => '88f13f1eafc9eef03afdbaf978a37405',
        'redirect'      => 'https://panel.nexus.com.mm/guest/login/facebook/callback'
    ],

    'google'=> [
        'client_id'     => '1056119533380-2irg7838pgl894hosrm5fgfg1c8egrug.apps.googleusercontent.com',
        'client_secret' => 'RL7D6ZwLF0rqYYucz772HV2_',
        'redirect'      => 'https://panel.nexus.com.mm/guest/login/google/callback'
    ],

];

