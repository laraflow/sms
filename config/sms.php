<?php

use Laraflow\Sms\Providers;

return [
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
    'mode' => env('SMS_ACCOUNT_MODE', 'sandbox'),

    /*
    |--------------------------------------------------------------------------
    | SMS Sender Name
    |--------------------------------------------------------------------------
    | this configuration is used to tell system what value will be used
    | if sms vendor support sms name masking.
    */
    'from' => env('SMS_FROM_NAME', env('APP_NAME', 'Laravel')),

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
     | Response Log Viewer
     |--------------------------------------------------------------------------
     | this configuration is for debugging purpose. if enabled then program will log
     | sms vendor response in debug category.
     */
    'log_viewer' => [
        'enabled' => env('SMS_LOG_VIEWER', env('APP_DEBUG', false)),
        'uri' => 'sms-logs',
        'middleware' => null,
    ],

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
    'providers' => [
        //Global
        Providers::AFRICAS_TALKING => [
            'driver' => \Laraflow\Sms\Drivers\AfricasTalking::class,
            'live' => [
                'url' => 'https://api.africastalking.com/version1/messaging',
                'api_key' => env('SMS_AFRICA_TALKING_API_KEY'),
                'username' => env('SMS_AFRICA_TALKING_USERNAME'),
            ],
            'sandbox' => [
                'url' => 'https://api.sandbox.africastalking.com/version1/messaging',
                'api_key' => env('SMS_AFRICA_TALKING_API_KEY'),
                'username' => env('SMS_AFRICA_TALKING_USERNAME'),
            ],
        ],
        Providers::CLICK_A_TELL => [
            'driver' => \Laraflow\Sms\Drivers\ClickATell::class,
            'live' => [
                'api_key' => env('SMS_CLICKATELL_API_KEY'),
            ],
            'sandbox' => [
                'api_key' => env('SMS_CLICKATELL_API_KEY'),
            ],
        ],
        Providers::CLICK_SEND => [
            'driver' => \Laraflow\Sms\Drivers\ClickSend::class,
            'live' => [
                'username' => env('SMS_CLICKSEND_USERNAME'),
                'password' => env('SMS_CLICKSEND_PASSWORD'),
            ],
            'sandbox' => [
                'username' => env('SMS_CLICKSEND_USERNAME'),
                'password' => env('SMS_CLICKSEND_PASSWORD'),
            ],
        ],
        Providers::INFOBIP => [
            'driver' => \Laraflow\Sms\Drivers\Infobip::class,
            'live' => [
                'token' => env('SMS_INFOBIP_API_TOKEN'),
            ],
            'sandbox' => [
                'token' => env('SMS_INFOBIP_API_TOKEN'),
            ],
        ],
        Providers::MESSAGE_BIRD => [
            'driver' => \Laraflow\Sms\Drivers\MessageBird::class,
            'live' => [
                'access_key' => env('SMS_MESSAGE_BIRD_ACCESS_KEY'),
            ],
            'sandbox' => [
                'access_key' => env('SMS_MESSAGE_BIRD_ACCESS_KEY'),
            ],
        ],
        Providers::SMS_BROADCAST => [
            'driver' => \Laraflow\Sms\Drivers\SmsBroadcast::class,
            'live' => [
                'username' => env('SMS_SMSBROADCAST_USERNAME'),
                'password' => env('SMS_SMSBROADCAST_PASSWORD'),
            ],
            'sandbox' => [
                'username' => env('SMS_SMSBROADCAST_USERNAME'),
                'password' => env('SMS_SMSBROADCAST_PASSWORD'),
            ],
        ],
        Providers::TELNYX => [
            'driver' => \Laraflow\Sms\Drivers\Telnyx::class,
            'live' => [
                'token' => env('SMS_TELNYX_API_TOKEN'),
            ],
            'sandbox' => [
                'token' => env('SMS_TELNYX_API_TOKEN'),
            ],
        ],
        Providers::TWILIO => [
            'driver' => \Laraflow\Sms\Drivers\Twilio::class,
            'live' => [
                'url' => env('SMS_TWILIO_URL'),
                'username' => env('SMS_TWILIO_USERNAME'),
                'password' => env('SMS_TWILIO_PASSWORD'),
            ],
            'sandbox' => [
                'url' => env('SMS_TWILIO_URL'),
                'username' => env('SMS_TWILIO_USERNAME'),
                'password' => env('SMS_TWILIO_PASSWORD'),
            ],
        ],
        Providers::SMS_API => [
            'driver' => \Laraflow\Sms\Drivers\SmsApi::class,
            'live' => [
                'api_token' => env('SMS_SMSAPI_API_TOKEN', ''),
            ],
            'sandbox' => [
                'api_token' => env('SMS_SMSAPI_API_TOKEN', ''),
            ],
        ],
        //Bangladesh
        Providers::ADN => [
            'driver' => \Laraflow\Sms\Drivers\Adn::class,
            'live' => [
                'api_key' => env('SMS_ADN_API_KEY', ''),
                'api_secret' => env('SMS_ADN_API_SECRET', '')
            ],
            'sandbox' => [
                'api_key' => env('SMS_ADN_API_KEY', ''),
                'api_secret' => env('SMS_ADN_API_SECRET', '')
            ]
        ],
        Providers::AJURA_TECH => [
            'driver' => \Laraflow\Sms\Drivers\AjuraTech::class,
            'live' => [
                'api_key' => env('SMS_AJURATECH_API_KEY', ''),
                'secret_key' => env('SMS_AJURATECH_SECRET_KEY', ''),
            ],
            'sandbox' => [
                'api_key' => env('SMS_AJURATECH_API_KEY', ''),
                'secret_key' => env('SMS_AJURATECH_SECRET_KEY', ''),
            ],
        ],
        Providers::ALPHA => [
            'driver' => \Laraflow\Sms\Drivers\Alpha::class,
            'live' => [
                'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
            ],
            'sandbox' => [
                'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
            ],
        ],
        Providers::BANGLALINK => [
            'driver' => \Laraflow\Sms\Drivers\Banglalink::class,
            'live' => [
                'userID' => env('SMS_BANGLALINK_USERID', ''),
                'passwd' => env('SMS_BANGLALINK_PASSWD', ''),
                'sender' => env('SMS_BANGLALINK_SENDER', ''),
            ],
            'sandbox' => [
                'userID' => env('SMS_BANGLALINK_USERID', ''),
                'passwd' => env('SMS_BANGLALINK_PASSWD', ''),
                'sender' => env('SMS_BANGLALINK_SENDER', ''),
            ],
        ],
        Providers::BD_BULK_SMS => [
            'driver' => \Laraflow\Sms\Drivers\BDBulkSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'token' => env('SMS_BD_BULK_SMS_TOKEN', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'token' => env('SMS_BD_BULK_SMS_TOKEN', ''),
            ],

        ],
        Providers::BOOM_CAST => [
            'driver' => \Laraflow\Sms\Drivers\BoomCast::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => env('SMS_BOOM_CAST_USERNAME', ''),
                'password' => env('SMS_BOOM_CAST_PASSWORD', ''),
                'masking' => env('SMS_BOOM_CAST_MASKING', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => env('SMS_BOOM_CAST_USERNAME', ''),
                'password' => env('SMS_BOOM_CAST_PASSWORD', ''),
                'masking' => env('SMS_BOOM_CAST_MASKING', ''),
            ],

        ],
        Providers::BRILLIANT => [
            'driver' => \Laraflow\Sms\Drivers\Brilliant::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'SenderId' => env('SMS_BRILLIANT_SENDER_ID', ''),
                'ApiKey' => env('SMS_BRILLIANT_API_KEY', ''),
                'ClientId' => env('SMS_BRILLIANT_CLIENT_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'SenderId' => env('SMS_BRILLIANT_SENDER_ID', ''),
                'ApiKey' => env('SMS_BRILLIANT_API_KEY', ''),
                'ClientId' => env('SMS_BRILLIANT_CLIENT_ID', ''),
            ],
        ],
        Providers::BULK_SMS_BD => [
            'driver' => \Laraflow\Sms\Drivers\BulkSmsBD::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_BULK_SMS_BD_API_KEY', ''),
                'senderid' => env('SMS_BULK_SMS_BD_SENDERID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_BULK_SMS_BD_API_KEY', ''),
                'senderid' => env('SMS_BULK_SMS_BD_SENDERID', ''),
            ],

        ],
        Providers::CUSTOM_GATEWAY => [
            'driver' => \Laraflow\Sms\Drivers\CustomGateway::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
            ],
        ],
        Providers::DIANA_HOST => [
            'driver' => \Laraflow\Sms\Drivers\DianaHost::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'senderid' => env('SMS_DIANA_HOST_SENDER_ID', ''),
                'api_key' => env('SMS_DIANA_HOST_API_KEY', ''),
                'type' => env('SMS_DIANA_HOST_TYPE', '')
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'senderid' => env('SMS_DIANA_HOST_SENDER_ID', ''),
                'api_key' => env('SMS_DIANA_HOST_API_KEY', ''),
                'type' => env('SMS_DIANA_HOST_TYPE', '')
            ],
        ],
        Providers::DIANA_SMS => [
            'driver' => \Laraflow\Sms\Drivers\DianaSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'SenderId' => env('SMS_DIANA_SMS_SENDER_ID', ''),
                'ApiKey' => env('SMS_DIANA_SMS_API_KEY', ''),
                'ClientId' => env('SMS_DIANA_SMS_CLIENT_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'SenderId' => env('SMS_DIANA_SMS_SENDER_ID', ''),
                'ApiKey' => env('SMS_DIANA_SMS_API_KEY', ''),
                'ClientId' => env('SMS_DIANA_SMS_CLIENT_ID', ''),
            ],
        ],
        Providers::DNS_BD => [
            'driver' => \Laraflow\Sms\Drivers\DnsBd::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
            ],
        ],
        Providers::ELIT_BUZZ => [
            'driver' => \Laraflow\Sms\Drivers\ElitBuzz::class,
            'live' => [
                'url' => env('SMS_ELITBUZZ_URL', ''),
                'senderid' => env('SMS_ELITBUZZ_SENDER_ID', ''),
                'api_key' => env('SMS_ELITBUZZ_API_KEY', ''),
            ],
            'sandbox' => [
                'url' => env('SMS_ELITBUZZ_URL', ''),
                'senderid' => env('SMS_ELITBUZZ_SENDER_ID', ''),
                'api_key' => env('SMS_ELITBUZZ_API_KEY', ''),
            ],
        ],
        Providers::ESMS => [
            'driver' => \Laraflow\Sms\Drivers\Esms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_ESMS_SENDER_ID', ''),
                'api_token' => env('SMS_ESMS_API_TOKEN', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_ESMS_SENDER_ID', ''),
                'api_token' => env('SMS_ESMS_API_TOKEN', ''),
            ],
        ],
        Providers::GRAMEENPHONE => [
            'driver' => \Laraflow\Sms\Drivers\Grameenphone::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => env('SMS_GRAMEENPHONE_USERNAME', ''),
                'password' => env('SMS_GRAMEENPHONE_PASSWORD', ''),
                'messagetype' => env('SMS_GRAMEENPHONE_MESSAGETYPE', 1),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'username' => env('SMS_GRAMEENPHONE_USERNAME', ''),
                'password' => env('SMS_GRAMEENPHONE_PASSWORD', ''),
                'messagetype' => env('SMS_GRAMEENPHONE_MESSAGETYPE', 1),
            ],
        ],
        Providers::GREEN_WEB => [
            'driver' => \Laraflow\Sms\Drivers\GreenWeb::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'token' => env('SMS_GREEN_WEB_TOKEN', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'token' => env('SMS_GREEN_WEB_TOKEN', ''),
            ],
        ],
        Providers::LPEEK => [
            'driver' => \Laraflow\Sms\Drivers\Lpeek::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'acode' => env('SMS_LPEEK_ACODE', ''),
                'apiKey' => env('SMS_LPEEK_APIKEY', ''),
                'requestID' => env('SMS_LPEEK_REQUESTID', ''),
                'masking' => env('SMS_LPEEK_MASKING', ''),
                'is_unicode' => env('SMS_LPEEK_IS_UNICODE', '0'),
                'transactionType' => env('SMS_LPEEK_TRANSACTIONTYPE', 'T'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'acode' => env('SMS_LPEEK_ACODE', ''),
                'apiKey' => env('SMS_LPEEK_APIKEY', ''),
                'requestID' => env('SMS_LPEEK_REQUESTID', ''),
                'masking' => env('SMS_LPEEK_MASKING', ''),
                'is_unicode' => env('SMS_LPEEK_IS_UNICODE', '0'),
                'transactionType' => env('SMS_LPEEK_TRANSACTIONTYPE', 'T'),
            ],
        ],
        Providers::MDL => [
            'driver' => \Laraflow\Sms\Drivers\Mdl::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'senderid' => env('SMS_MDL_SENDER_ID', ''),
                'api_key' => env('SMS_MDL_API_KEY', ''),
                'type' => env('SMS_MDL_TYPE', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'senderid' => env('SMS_MDL_SENDER_ID', ''),
                'api_key' => env('SMS_MDL_API_KEY', ''),
                'type' => env('SMS_MDL_TYPE', ''),
            ],
        ],
        Providers::METRONET => [
            'driver' => \Laraflow\Sms\Drivers\Metronet::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_METRONET_API_KEY', ''),
                'mask' => env('SMS_METRONET_MASK', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_METRONET_API_KEY', ''),
                'mask' => env('SMS_METRONET_MASK', ''),
            ],
        ],
        Providers::MIM_SMS => [
            'driver' => \Laraflow\Sms\Drivers\MimSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'senderid' => env('SMS_MIM_SMS_SENDER_ID', ''),
                'api_key' => env('SMS_MIM_SMS_API_KEY', ''),
                'type' => env('SMS_MIM_SMS_TYPE', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'senderid' => env('SMS_MIM_SMS_SENDER_ID', ''),
                'api_key' => env('SMS_MIM_SMS_API_KEY', ''),
                'type' => env('SMS_MIM_SMS_TYPE', ''),
            ],
        ],
        Providers::MOBI_REACH => [
            'driver' => \Laraflow\Sms\Drivers\Mobireach::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'Username' => env('SMS_MOBIREACH_USERNAME', ''),
                'Password' => env('SMS_MOBIREACH_PASSWORD', ''),
                'From' => env('SMS_MOBIREACH_FROM', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'Username' => env('SMS_MOBIREACH_USERNAME', ''),
                'Password' => env('SMS_MOBIREACH_PASSWORD', ''),
                'From' => env('SMS_MOBIREACH_FROM', ''),
            ],
        ],
        Providers::MOBI_SHASRA => [
            'driver' => \Laraflow\Sms\Drivers\Mobishasra::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user' => env('SMS_MOBISHASTRA_USERNAME', ''),
                'pwd' => env('SMS_MOBISHASTRA_PASSWORD', ''),
                'senderid' => env('SMS_MOBISHASTRA_SENDER_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user' => env('SMS_MOBISHASTRA_USERNAME', ''),
                'pwd' => env('SMS_MOBISHASTRA_PASSWORD', ''),
                'senderid' => env('SMS_MOBISHASTRA_SENDER_ID', ''),
            ],
        ],
        Providers::MUTHOFUN => [
            'driver' => \Laraflow\Sms\Drivers\Muthofun::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_MUTHOFUN_API_KEY'),
                'sender_id' => env('SMS_MUTHOFUN_SENDER_ID'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_MUTHOFUN_API_KEY'),
                'sender_id' => env('SMS_MUTHOFUN_SENDER_ID'),
            ],

        ],
        Providers::NOVOCOMBD => [
            'driver' => \Laraflow\Sms\Drivers\NovocomBd::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'SenderId' => env('SMS_NOVOCOMBD_SENDER_ID', ''),
                'ApiKey' => env('SMS_NOVOCOMBD_API_KEY', ''),
                'ClientId' => env('SMS_NOVOCOMBD_CLIENT_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'SenderId' => env('SMS_NOVOCOMBD_SENDER_ID', ''),
                'ApiKey' => env('SMS_NOVOCOMBD_API_KEY', ''),
                'ClientId' => env('SMS_NOVOCOMBD_CLIENT_ID', ''),
            ],
        ],
        Providers::ONNOROKOM => [
            'driver' => \Laraflow\Sms\Drivers\Onnorokom::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'userName' => env('SMS_ONNOROKOM_USERNAME', ''),
                'userPassword' => env('SMS_ONNOROKOM_PASSWORD', ''),
                'type' => env('SMS_ONNOROKOM_TYPE', ''),
                'maskName' => env('SMS_ONNOROKOM_MASK', ''),
                'campaignName' => env('SMS_ONNOROKOM_CAMPAIGN_NAME', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'userName' => env('SMS_ONNOROKOM_USERNAME', ''),
                'userPassword' => env('SMS_ONNOROKOM_PASSWORD', ''),
                'type' => env('SMS_ONNOROKOM_TYPE', ''),
                'maskName' => env('SMS_ONNOROKOM_MASK', ''),
                'campaignName' => env('SMS_ONNOROKOM_CAMPAIGN_NAME', ''),
            ],
        ],
        Providers::QUICK_SMS => [
            'driver' => \Laraflow\Sms\Drivers\QuickSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_QUICKSMS_API_KEY'),
                'senderid' => env('SMS_QUICKSMS_SENDER_ID'),
                'type' => env('SMS_QUICKSMS_SENDER_ID'),
                'scheduledDateTime' => env('SMS_QUICKSMS_SCHEDULED_DATE_TIME'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_QUICKSMS_API_KEY'),
                'senderid' => env('SMS_QUICKSMS_SENDER_ID'),
                'type' => env('SMS_QUICKSMS_SENDER_ID'),
                'scheduledDateTime' => env('SMS_QUICKSMS_SCHEDULED_DATE_TIME'),
            ],
        ],
        Providers::REDMO_IT_SMS => [
            'driver' => \Laraflow\Sms\Drivers\RedmoItSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_REDMOIT_SENDER_ID', ''),
                'api_token' => env('SMS_REDMOIT_API_TOKEN', ''),
                'type' => env('SMS_REDMOIT_TYPE', 'string'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_REDMOIT_SENDER_ID', ''),
                'api_token' => env('SMS_REDMOIT_API_TOKEN', ''),
                'type' => env('SMS_REDMOIT_TYPE', 'string'),
            ],

        ],
        Providers::SMART_LAB_SMS => [
            'driver' => \Laraflow\Sms\Drivers\SmartLabSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user' => env('SMS_SMARTLAB_USER', ''),
                'password' => env('SMS_SMARTLAB_PASSWORD', ''),
                'sender' => env('SMS_SMARTLAB_SENDER', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user' => env('SMS_SMARTLAB_USER', ''),
                'password' => env('SMS_SMARTLAB_PASSWORD', ''),
                'sender' => env('SMS_SMARTLAB_SENDER', ''),
            ],

        ],
        Providers::SMS4_BD => [
            'driver' => \Laraflow\Sms\Drivers\Sms4BD::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'publickey' => env('SMS_SMS4BD_PUBLIC_KEY', ''),
                'privatekey' => env('SMS_SMS4BD_PRIVATE_KEY', ''),
                'type' => env('SMS_SMS4BD_TYPE', ''),
                'sender' => env('SMS_SMS4BD_SENDER', ''),
                'delay' => env('SMS_SMS4BD_DELAY', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'publickey' => env('SMS_SMS4BD_PUBLIC_KEY', ''),
                'privatekey' => env('SMS_SMS4BD_PRIVATE_KEY', ''),
                'type' => env('SMS_SMS4BD_TYPE', ''),
                'sender' => env('SMS_SMS4BD_SENDER', ''),
                'delay' => env('SMS_SMS4BD_DELAY', ''),
            ],

        ],
        Providers::SMS_NET24 => [
            'driver' => \Laraflow\Sms\Drivers\SmsNet24::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user_id' => env('SMS_SMSNET24_USER_ID', ''),
                'user_password' => env('SMS_SMSNET24_USER_PASSWORD', ''),
                'route_id' => env('SMS_SMSNET24_ROUTE_ID', ''),
                'sms_type_id' => env('SMS_SMSNET24_SMS_TYPE_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user_id' => env('SMS_SMSNET24_USER_ID', ''),
                'user_password' => env('SMS_SMSNET24_USER_PASSWORD', ''),
                'route_id' => env('SMS_SMSNET24_ROUTE_ID', ''),
                'sms_type_id' => env('SMS_SMSNET24_SMS_TYPE_ID', ''),
            ],
        ],
        Providers::SMS_NOC => [
            'driver' => \Laraflow\Sms\Drivers\SMSNoc::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMSNOC_SENDER_ID', ''),
                'bearer_token' => env('SMSNOC_BEARER_TOKEN', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMSNOC_SENDER_ID', ''),
                'bearer_token' => env('SMSNOC_BEARER_TOKEN', ''),
            ],
        ],
        Providers::SMSINBD => [
            'driver' => \Laraflow\Sms\Drivers\SmsinBD::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_token' => env('SMSINBD_API_TOKEN', ''),
                'senderid' => env('SMSINBD_SENDERID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_token' => env('SMSINBD_API_TOKEN', ''),
                'senderid' => env('SMSINBD_SENDERID', ''),
            ],
        ],
        Providers::SMSNETBD => [
            'driver' => \Laraflow\Sms\Drivers\SmsNetBD::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_NET_BD_API_KEY'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_NET_BD_API_KEY'),
            ],
        ],
        Providers::SMSQ => [
            'driver' => \Laraflow\Sms\Drivers\SmsQ::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_SMSQ_SENDER_ID', ''),
                'api_key' => env('SMS_SMSQ_API_KEY', ''),
                'client_id' => env('SMS_SMSQ_CLIENT_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_SMSQ_SENDER_ID', ''),
                'api_key' => env('SMS_SMSQ_API_KEY', ''),
                'client_id' => env('SMS_SMSQ_CLIENT_ID', ''),
            ],
        ],
        Providers::SSL => [
            'driver' => \Laraflow\Sms\Drivers\Ssl::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_token' => env('SMS_SSL_API_TOKEN', ''),
                'sid' => env('SMS_SSL_SID', ''),
                'csms_id' => env('SMS_SSL_CSMS_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_token' => env('SMS_SSL_API_TOKEN', ''),
                'sid' => env('SMS_SSL_SID', ''),
                'csms_id' => env('SMS_SSL_CSMS_ID', ''),
            ],
        ],
        Providers::TENSE => [
            'driver' => \Laraflow\Sms\Drivers\Tense::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user' => env('SMS_TENSE_USER', ''),
                'password' => env('SMS_TENSE_PASSWORD', ''),
                'campaign' => env('SMS_TENSE_CAMPAIGN', ''),
                'masking' => env('SMS_TENSE_MASKING', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'user' => env('SMS_TENSE_USER', ''),
                'password' => env('SMS_TENSE_PASSWORD', ''),
                'campaign' => env('SMS_TENSE_CAMPAIGN', ''),
                'masking' => env('SMS_TENSE_MASKING', ''),
            ],
        ],
        Providers::TRUBO_SMS => [
            'driver' => \Laraflow\Sms\Drivers\TruboSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_TRUBOSMS_SENDER_ID', ''),
                'api_token' => env('SMS_TRUBOSMS_API_TOKEN', ''),
                'type' => env('SMS_TRUBOSMS_TYPE', 'string'),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_TRUBOSMS_SENDER_ID', ''),
                'api_token' => env('SMS_TRUBOSMS_API_TOKEN', ''),
                'type' => env('SMS_TRUBOSMS_TYPE', 'string'),
            ],
        ],
        Providers::TWENTYFOURSMSBD => [
            'driver' => \Laraflow\Sms\Drivers\TwentyFourSmsBD::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'apiKey' => env('SMS_TWENTYFOURSMSBD_APIKEY', ''),
                'sender_id' => env('SMS_TWENTYFOURSMSBD_SENDER_ID', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'apiKey' => env('SMS_TWENTYFOURSMSBD_APIKEY', ''),
                'sender_id' => env('SMS_TWENTYFOURSMSBD_SENDER_ID', ''),
            ],
        ],
        Providers::VIATECH => [
            'driver' => \Laraflow\Sms\Drivers\Viatech::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_VIATECH_API_KEY', ''),
                'mask' => env('SMS_VIATECH_MASK', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'api_key' => env('SMS_VIATECH_API_KEY', ''),
                'mask' => env('SMS_VIATECH_MASK', ''),
            ],
        ],
        Providers::TWENTY4BULKSMS => [
            'driver' => \Laraflow\Sms\Drivers\Twenty4BulkSms::class,
            'live' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_TWENTYFOUR_BULKSMS_SENDER_ID', ''),
                'user_email' => env('SMS_TWENTYFOUR_BULKSMS_USER_EMAIL', ''),
                'api_key' => env('SMS_TWENTYFOUR_BULKSMS_APP_KEY', ''),
            ],
            'sandbox' => [
                'url' => 'https://api.twilio.com/2010-04-01/Accounts/$TWILIO_ACCOUNT_SID$/Messages.json',
                'sender_id' => env('SMS_TWENTYFOUR_BULKSMS_SENDER_ID', ''),
                'user_email' => env('SMS_TWENTYFOUR_BULKSMS_USER_EMAIL', ''),
                'api_key' => env('SMS_TWENTYFOUR_BULKSMS_APP_KEY', ''),
            ],
        ],
    ],
];
