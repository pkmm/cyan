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
        'model' => App\Model\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'verifycode' => [
        'host' => env('VERIFY_CODE_SERVER'),
        'host_check' => env('VERIFY_CODE_SERVER_CHECK')
    ],

    'mini_program' => [
        'app_id' => env('MINIPROGRAM_APP_ID'),
        'secret' => env('MINIPROGRAM_SECRET'),
        'random_str' => env('MINI_PROGRAM_REQUEST_RANDOM_STR')
    ],
    'notify' => [
        'wx_pusher' => [
            'id' => env('WXPUSER_ID'),
            'server' => env('WXPUSER_SERVER')
        ],
        'fang_tang' => [
            'sckey' => env('SCKEY')
        ]
    ]
];
