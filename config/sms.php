<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Logger
    |--------------------------------------------------------------------------
    | this configuration is for debugging purpose. if enabled then program will log
    | sms vendor response in debug category.
    */
    'log' => (bool) env('SMS_LOG', env('APP_DEBUG', false)),

    /*
    |--------------------------------------------------------------------------
    | Default Vendor
    |--------------------------------------------------------------------------
    | this configuration is used to tell system which vendor
    | should be used when sending the sms.
    | Note: if set null package will use laravel default log driver.
    */
    'default' => env('SMS_DRIVER', null),

    /*
    |--------------------------------------------------------------------------
    | Vendor Account Mode
    |--------------------------------------------------------------------------
    | this configuration is used to tell system which vendor account
    | mode should be used when sending the sms. Available options are
    | "sandbox" or "live".
    */
    'mode' => env('SMS_ACCOUNT_MODE', null),

    /*
    |--------------------------------------------------------------------------
    | SMS Sender Name
    |--------------------------------------------------------------------------
    | this configuration is used to tell system what value will be used
    | if sms vendor support sms name masking
    | "sandbox" or "live".
    */
    'from' => env('SMS_FROM_NAME', env('APP_NAME', 'Laravel')),

    /*
    |--------------------------------------------------------------------------
    | Vendor Configuration
    |--------------------------------------------------------------------------
    |
    | This value will be added to all your routes from this package
    | Example: APP_URL/{root_prefix}/api/bell/action
    |
    | Note: while adding prefix add closing ending slash '/'
    */
    'vendors' => [
        'africastalking' => [
            'driver' => \Laraflow\Sms\Drivers\AfricasTalking::class,
            'live' => [
                'url' => 'https://api.africastalking.com/version1/messaging',
                'apiKey' => env('SMS_AFRICA_TALKING_API_KEY'),
                'username' => env('SMS_AFRICA_TALKING_USERNAME'),

            ],
            'sandbox' => [
                'url' => 'https://api.sandbox.africastalking.com/version1/messaging',
                'apiKey' => env('SMS_AFRICA_TALKING_API_KEY'),
                'username' => env('SMS_AFRICA_TALKING_USERNAME'),

            ],
        ],
        'clickatell' => [
            'driver' => \Laraflow\Sms\Drivers\ClickATell::class,
            'live' => [
                'url' => 'https://platform.clickatell.com/messages/http/send',
                'apiKey' => env('SMS_CLICKATELL_API_KEY'),
            ],
            'sandbox' => [
                'url' => 'https://platform.clickatell.com/messages/http/send',
                'apiKey' => env('SMS_CLICKATELL_API_KEY'),
            ],
        ],
        'clicksend' => [
            'driver' => \Laraflow\Sms\Drivers\ClickSend::class,
            'live' => [
                'url' => 'https://rest.clicksend.com/v3/sms/send',
                'username' => env('SMS_CLICKSEND_USERNAME'),
                'password' => env('SMS_CLICKSEND_PASSWORD'),

            ],
            'sandbox' => [
                'url' => 'https://rest.clicksend.com/v3/sms/send',
                'username' => env('SMS_CLICKSEND_USERNAME'),
                'password' => env('SMS_CLICKSEND_PASSWORD'),
            ],
        ],
        'infobip' => [
            'driver' => \Laraflow\Sms\Drivers\Infobip::class,
            'live' => [
                'url' => 'https://mmk314.api.infobip.com/sms/2/text/advanced',
                'token' => env('SMS_INFOBIP_API_TOKEN'),
            ],
            'sandbox' => [
                'url' => 'https://mmk314.api.infobip.com/sms/2/text/advanced',
                'token' => env('SMS_INFOBIP_API_TOKEN'),
            ],
        ],
        'messagebird' => [
            'driver' => \Laraflow\Sms\Drivers\MessageBird::class,
            'live' => [
                'url' => 'https://rest.messagebird.com/messages',
                'access_key' => env('SMS_MESSAGE_BIRD_ACCESS_KEY'),
            ],
            'sandbox' => [
                'url' => 'https://rest.messagebird.com/messages',
                'access_key' => env('SMS_MESSAGE_BIRD_ACCESS_KEY'),
            ],
        ],
        'smsbroadcast' => [
            'driver' => \Laraflow\Sms\Drivers\SmsBroadcast::class,
            'live' => [
                'url' => 'https://api.smsbroadcast.com.au/api-adv.php',
                'username' => env('SMS_SMSBROADCAST_USERNAME'),
                'password' => env('SMS_SMSBROADCAST_PASSWORD'),
            ],
            'sandbox' => [
                'url' => 'https://api.smsbroadcast.com.au/api-adv.php',
                'username' => env('SMS_SMSBROADCAST_USERNAME'),
                'password' => env('SMS_SMSBROADCAST_PASSWORD'),
            ],
        ],
        'telnyx' => [
            'driver' => \Laraflow\Sms\Drivers\Telnyx::class,
            'live' => [
                'url' => 'https://api.telnyx.com/v2/messages',
                'token' => env('SMS_TELNYX_API_TOKEN'),
            ],
            'sandbox' => [
                'url' => 'https://api.telnyx.com/v2/messages',
                'token' => env('SMS_TELNYX_API_TOKEN'),
            ],
        ],
        'twilio' => [
            'driver' => \Laraflow\Sms\Drivers\Twilio::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => env('SMS_TWILIO_USERNAME'),
                'password' => env('SMS_TWILIO_PASSWORD'),

            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => env('SMS_TWILIO_USERNAME'),
                'password' => env('SMS_TWILIO_PASSWORD'),

            ],
        ],
    ],
];
