<?php

// config for Fintech/Bell
return [

    /*
    |--------------------------------------------------------------------------
    | Enable Module APIs
    |--------------------------------------------------------------------------
    | this setting enable the api will be available or not
    */
    'enabled' => env('PACKAGE_BELL_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Bell Group Root Prefix
    |--------------------------------------------------------------------------
    |
    | This value will be added to all your routes from this package
    | Example: APP_URL/{root_prefix}/api/bell/action
    |
    | Note: while adding prefix add closing ending slash '/'
    */

    'root_prefix' => 'test/',

    /*
    |--------------------------------------------------------------------------
    | Notification Channels Vendor Configuration
    |--------------------------------------------------------------------------
    |
    | This value will be added to all your routes from this package
    | Example: APP_URL/{root_prefix}/api/bell/action
    |
    | Note: while adding prefix add closing ending slash '/'
    */
    'sms' => [
        'mode' => 'sandbox',
        'default' => 'clicksend',
        'clicksend' => [
            'driver' => \Fintech\Bell\Drivers\Sms\ClickSend::class,
            'live' => [
                'url' => 'https://rest.clicksend.com/v3/sms/send',
                'username' => null,
                'password' => null,
                'from' => null,
            ],
            'sandbox' => [
                'url' => 'https://rest.clicksend.com/v3/sms/send',
                'username' => 'masud@clavisint.com',
//                                'password' => 'Masudalam@13119214',
                'password' => 'D08ECA95-5C9B-B77B-D6B9-47AF3CED3F5E',
                'from' => null,
            ],
        ],
        'messagebird' => [
            'driver' => \Fintech\Bell\Drivers\Sms\MessageBird::class,
            'live' => [
                'url' => 'https://rest.messagebird.com/messages',
                'originator' => null,
                'access_key' => null,
                'from' => null,
            ],
            'sandbox' => [
                'url' => 'https://rest.messagebird.com/messages',
                'originator' => null,
                'access_key' => null,
                'from' => null,
            ],
        ],
        'twilio' => [
            'driver' => \Fintech\Bell\Drivers\Sms\Twilio::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => null,
                'password' => null,
                'from' => null,
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => null,
                'password' => null,
                'from' => null,
            ],
        ],
    ],
    'push' => [
        'mode' => 'sandbox',
        'default' => 'clicksend',
        'live' => [

        ],
        'sandbox' => [

        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Trigger Model
    |--------------------------------------------------------------------------
    |
    | This value will be used to across system where model is needed
    */
    'trigger_model' => \Fintech\Bell\Models\Trigger::class,

    //** Model Config Point Do not Remove **//
    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | This value will be used across systems where a repository instance is needed
    */

    'repositories' => [
        \Fintech\Bell\Interfaces\TriggerRepository::class => \Fintech\Bell\Repositories\Eloquent\TriggerRepository::class,

        //** Repository Binding Config Point Do not Remove **//
    ],

];
