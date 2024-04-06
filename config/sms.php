<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Response Logger
    |--------------------------------------------------------------------------
    | this configuration is for debugging purpose. if enabled then program will log
    | sms vendor response in debug category.
    */
    'log' => (bool)env('SMS_LOG', env('APP_DEBUG', false)),

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
    | Vendor Configuration
    |--------------------------------------------------------------------------
    |
    | This value will be added to all your routes from this package
    | Example: APP_URL/{root_prefix}/api/bell/action
    |
    | Note: while adding prefix add closing ending slash '/'
    */
    'vendors' => [
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
        'telnyx' => [
            'driver' => \Fintech\Bell\Drivers\Sms\Telnyx::class,
            'live' => [
                'url' => 'https://api.telnyx.com/v2/messages',
                'username' => null,
                'password' => null,
                'from' => null,
            ],
            'sandbox' => [
                'url' => 'https://api.telnyx.com/v2/messages',
                'username' => null,
                'password' => null,
                'from' => null,
            ],
        ],
        'smsbroadcast' => [
            'driver' => \Fintech\Bell\Drivers\Sms\SmsBroadcast::class,
            'live' => [
                'url' => 'https://api.smsbroadcast.com.au/api-adv.php',
                'username' => null,
                'password' => null,
                'from' => null,
                'ref' => null,
                'maxsplit' => null,
                'delay' => null,
            ],
            'sandbox' => [
                'url' => 'https://api.smsbroadcast.com.au/api-adv.php',
                'username' => null,
                'password' => null,
                'from' => null,
                'ref' => null,
                'maxsplit' => null,
                'delay' => null,
            ],
        ],
        'africastalking' => [
            'driver' => \Fintech\Bell\Drivers\Sms\AfricasTalking::class,
            'live' => [
                'url' => 'https://api.africastalking.com/version1/messaging',
                'apiKey' => null,
                'username' => null,
                'from' => null,
            ],
            'sandbox' => [
                'url' => 'https://api.sandbox.africastalking.com/version1/messaging',
                'apiKey' => null,
                'username' => null,
                'from' => null,
            ],
        ],
        'infobip' => [
            'driver' => \Fintech\Bell\Drivers\Sms\Infobip::class,
            'live' => [
                'url' => 'https://mmk314.api.infobip.com/sms/2/text/advanced',
                'token' => 'fb74be5a5535c425732e225f3f2697ec-9b4b774d-580b-4ece-8384-0ef883464536',
                'from' => 'ServiceSMS',
            ],
            'sandbox' => [
                'url' => 'https://mmk314.api.infobip.com/sms/2/text/advanced',
                'token' => 'fb74be5a5535c425732e225f3f2697ec-9b4b774d-580b-4ece-8384-0ef883464536',
                'from' => 'ServiceSMS',
            ],
        ],
        'clickatell' => [
            'driver' => \Fintech\Bell\Drivers\Sms\Clickatell::class,
            'live' => [
                'url' => 'https://platform.clickatell.com/messages/http/send',
                'apiKey' => '',
                'from' => '',
            ],
            'sandbox' => [
                'url' => 'https://platform.clickatell.com/messages/http/send',
                'apiKey' => '',
                'from' => '',
            ],
        ],
    ],
];
