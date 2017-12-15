
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
        'client_id'     => '330008387465431',
        'client_secret' => 'b72439a9a10ee2131b75045c6ce1dab6',
        'redirect'      => 'http://128.199.68.187/guest/login/facebook/callback'
    ],

    'google'=> [
        'client_id'     => '1056119533380-2irg7838pgl894hosrm5fgfg1c8egrug.apps.googleusercontent.com',
        'client_secret' => 'RL7D6ZwLF0rqYYucz772HV2_',
        'redirect'      => 'https://panel.nexus.com.mm/guest/login/google/callback'
    ],

];

