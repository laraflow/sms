<?php

use Laraflow\Sms\Providers;

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
                'apiKey' => env('SMS_AFRICA_TALKING_API_KEY'),
                'username' => env('SMS_AFRICA_TALKING_USERNAME'),

            ],
            'sandbox' => [
                'url' => 'https://api.sandbox.africastalking.com/version1/messaging',
                'apiKey' => env('SMS_AFRICA_TALKING_API_KEY'),
                'username' => env('SMS_AFRICA_TALKING_USERNAME'),

            ],
        ],
        Providers::CLICK_A_TELL => [
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
        Providers::CLICK_SEND => [
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
        Providers::INFOBIP => [
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
        Providers::MESSAGE_BIRD => [
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
        Providers::SMS_BROADCAST => [
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
        Providers::TELNYX => [
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
        Providers::TWILIO => [
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
        //Bangladesh
        Providers::ADN => [
            'senderid' => env('SMS_ADN_SENDER_ID', ''),
            'api_key' => env('SMS_ADN_API_KEY', ''),
            'api_secret' => env('SMS_ADN_API_SECRET', ''),
            'request_type' => env('SMS_ADN_API_REQUEST_TYPE', ''),
            'message_type' => env('SMS_ADN_API_MESSAGE_TYPE', ''),
        ],
        Providers::AJURA_TECH => [
            'apikey' => env('SMS_AjuraTechReveSms_API_KEY', ''),
            'secretkey' => env('SMS_AjuraTechReveSms_API_SECRET_KEY', ''),
            'callerID' => env('SMS_AjuraTechReveSms_CALLER_ID', ''),
        ],
        Providers::ALPHA => [
            'api_key' => env('SMS_ALPHA_SMS_API_KEY'),
        ],
        Providers::BANGLALINK => [
            'userID' => env('SMS_BANGLALINK_USERID', ''),
            'passwd' => env('SMS_BANGLALINK_PASSWD', ''),
            'sender' => env('SMS_BANGLALINK_SENDER', ''),
        ],
        Providers::BD_BULK_SMS => [
            'token' => env('SMS_BD_BULK_SMS_TOKEN', ''),
        ],
        Providers::BOOM_CAST => [
            'url' => env('SMS_BOOM_CAST_URL', ''),
            'username' => env('SMS_BOOM_CAST_USERNAME', ''),
            'password' => env('SMS_BOOM_CAST_PASSWORD', ''),
            'masking' => env('SMS_BOOM_CAST_MASKING', ''),
        ],
        Providers::BRILLIANT => [
            'SenderId' => env('SMS_BRILLIANT_SENDER_ID', ''),
            'ApiKey' => env('SMS_BRILLIANT_API_KEY', ''),
            'ClientId' => env('SMS_BRILLIANT_CLIENT_ID', ''),
        ],
        Providers::BULK_SMS_BD => [
            'api_key' => env('SMS_BULK_SMS_BD_API_KEY', ''),
            'senderid' => env('SMS_BULK_SMS_BD_SENDERID', ''),
        ],
        Providers::CUSTOM_GATEWAY => [

        ],
        Providers::DIANA_HOST => [
            'senderid' => env('SMS_DIANA_HOST_SENDER_ID', ''),
            'api_key' => env('SMS_DIANA_HOST_API_KEY', ''),
            'type' => env('SMS_DIANA_HOST_TYPE', ''),
        ],
        Providers::DIANA_SMS => [
            'SenderId' => env('SMS_DIANA_SMS_SENDER_ID', ''),
            'ApiKey' => env('SMS_DIANA_SMS_API_KEY', ''),
            'ClientId' => env('SMS_DIANA_SMS_CLIENT_ID', ''),
        ],
        Providers::DNS_BD => [],
        Providers::ELIT_BUZZ => [
            'url' => env('SMS_ELITBUZZ_URL', ''),
            'senderid' => env('SMS_ELITBUZZ_SENDER_ID', ''),
            'api_key' => env('SMS_ELITBUZZ_API_KEY', ''),
        ],
        Providers::ESMS => [
            'sender_id' => env('SMS_ESMS_SENDER_ID', ''),
            'api_token' => env('SMS_ESMS_API_TOKEN', ''),
        ],
        Providers::GRAMEENPHONE => [
            'username' => env('SMS_GRAMEENPHONE_USERNAME', ''),
            'password' => env('SMS_GRAMEENPHONE_PASSWORD', ''),
            'messagetype' => env('SMS_GRAMEENPHONE_MESSAGETYPE', 1),
        ],
        Providers::GREEN_WEB => [
            'token' => env('SMS_GREEN_WEB_TOKEN', ''),
        ],
        Providers::LPEEK => [
            'acode' => env('SMS_LPEEK_ACODE', ''),
            'apiKey' => env('SMS_LPEEK_APIKEY', ''),
            'requestID' => env('SMS_LPEEK_REQUESTID', ''),
            'masking' => env('SMS_LPEEK_MASKING', ''),
            'is_unicode' => env('SMS_LPEEK_IS_UNICODE', '0'),
            'transactionType' => env('SMS_LPEEK_TRANSACTIONTYPE', 'T'),
        ],
        Providers::MDL => [
            'senderid' => env('SMS_MDL_SENDER_ID', ''),
            'api_key' => env('SMS_MDL_API_KEY', ''),
            'type' => env('SMS_MDL_TYPE', ''),
        ],
        Providers::METRONET => [
            'api_key' => env('SMS_METRONET_API_KEY', ''),
            'mask' => env('SMS_METRONET_MASK', ''),
        ],
        Providers::MIM_SMS => [
            'senderid' => env('SMS_MIM_SMS_SENDER_ID', ''),
            'api_key' => env('SMS_MIM_SMS_API_KEY', ''),
            'type' => env('SMS_MIM_SMS_TYPE', ''),
        ],
        Providers::MOBI_REACH => [
            'Username' => env('SMS_MOBIREACH_USERNAME', ''),
            'Password' => env('SMS_MOBIREACH_PASSWORD', ''),
            'From' => env('SMS_MOBIREACH_FROM', ''),
        ],
        Providers::MOBI_SHASRA => [
            'user' => env('SMS_MOBISHASTRA_USERNAME', ''),
            'pwd' => env('SMS_MOBISHASTRA_PASSWORD', ''),
            'senderid' => env('SMS_MOBISHASTRA_SENDER_ID', ''),
        ],
        Providers::MUTHOFUN => [
            'api_key' => env('SMS_MUTHOFUN_API_KEY'),
            'sender_id' => env('SMS_MUTHOFUN_SENDER_ID'),
        ],
        Providers::NOVOCOMBD => [
            'SenderId' => env('SMS_NOVOCOMBD_SENDER_ID', ''),
            'ApiKey' => env('SMS_NOVOCOMBD_API_KEY', ''),
            'ClientId' => env('SMS_NOVOCOMBD_CLIENT_ID', ''),
        ],
        Providers::ONNOROKOM => [
            'userName' => env('SMS_ONNOROKOM_USERNAME', ''),
            'userPassword' => env('SMS_ONNOROKOM_PASSWORD', ''),
            'type' => env('SMS_ONNOROKOM_TYPE', ''),
            'maskName' => env('SMS_ONNOROKOM_MASK', ''),
            'campaignName' => env('SMS_ONNOROKOM_CAMPAIGN_NAME', ''),
        ],
        Providers::QUICK_SMS => [
            'api_key' => env('SMS_QUICKSMS_API_KEY'),
            'senderid' => env('SMS_QUICKSMS_SENDER_ID'),
            'type' => env('SMS_QUICKSMS_SENDER_ID'),
            'scheduledDateTime' => env('SMS_QUICKSMS_SCHEDULED_DATE_TIME'),
        ],
        Providers::REDMO_IT_SMS => [
            'sender_id' => env('SMS_REDMOIT_SENDER_ID', ''),
            'api_token' => env('SMS_REDMOIT_API_TOKEN', ''),
            'type' => env('SMS_REDMOIT_TYPE', 'string'),
        ],
        Providers::SMART_LAB_SMS => [
            'user' => env('SMS_SMARTLAB_USER', ''),
            'password' => env('SMS_SMARTLAB_PASSWORD', ''),
            'sender' => env('SMS_SMARTLAB_SENDER', ''),
        ],
        Providers::SMS4_BD => [
            'publickey' => env('SMS_SMS4BD_PUBLIC_KEY', ''),
            'privatekey' => env('SMS_SMS4BD_PRIVATE_KEY', ''),
            'type' => env('SMS_SMS4BD_TYPE', ''),
            'sender' => env('SMS_SMS4BD_SENDER', ''),
            'delay' => env('SMS_SMS4BD_DELAY', ''),
        ],
        Providers::SMS_NET24 => [
            'user_id' => env('SMS_SMSNET24_USER_ID', ''),
            'user_password' => env('SMS_SMSNET24_USER_PASSWORD', ''),
            'route_id' => env('SMS_SMSNET24_ROUTE_ID', ''),
            'sms_type_id' => env('SMS_SMSNET24_SMS_TYPE_ID', ''),
        ],
        Providers::SMS_NOC => [
            'sender_id' => env('SMSNOC_SENDER_ID', ''),
            'bearer_token' => env('SMSNOC_BEARER_TOKEN', ''),

        ],
        Providers::SMSINBD => [
            'api_token' => env('SMSINBD_API_TOKEN', ''),
            'senderid' => env('SMSINBD_SENDERID', ''),
        ],
        Providers::SMSNETBD => [
            'api_key' => env('SMS_NET_BD_API_KEY'),
        ],
        Providers::SMSQ => [
            'sender_id' => env('SMS_SMSQ_SENDER_ID', ''),
            'api_key' => env('SMS_SMSQ_API_KEY', ''),
            'client_id' => env('SMS_SMSQ_CLIENT_ID', ''),
        ],
        Providers::SSL => [
            'api_token' => env('SMS_SSL_API_TOKEN', ''),
            'sid' => env('SMS_SSL_SID', ''),
            'csms_id' => env('SMS_SSL_CSMS_ID', ''),
        ],
        Providers::TENSE => [
            'user' => env('SMS_TENSE_USER', ''),
            'password' => env('SMS_TENSE_PASSWORD', ''),
            'campaign' => env('SMS_TENSE_CAMPAIGN', ''),
            'masking' => env('SMS_TENSE_MASKING', ''),
        ],
        Providers::TRUBO_SMS => [
            'sender_id' => env('SMS_TRUBOSMS_SENDER_ID', ''),
            'api_token' => env('SMS_TRUBOSMS_API_TOKEN', ''),
            'type' => env('SMS_TRUBOSMS_TYPE', 'string'),
        ],
        Providers::TWENTYFOURSMSBD => [
            'apiKey' => env('SMS_TWENTYFOURSMSBD_APIKEY', ''),
            'sender_id' => env('SMS_TWENTYFOURSMSBD_SENDER_ID', ''),
        ],
        Providers::VIATECH => [
            'api_key' => env('SMS_VIATECH_API_KEY', ''),
            'mask' => env('SMS_VIATECH_MASK', ''),
        ],
        Providers::TWENTY4BULKSMS => [
            'sender_id' => env('SMS_TWENTYFOUR_BULKSMS_SENDER_ID', ''),
            'user_email' => env('SMS_TWENTYFOUR_BULKSMS_USER_EMAIL', ''),
            'api_key' => env('SMS_TWENTYFOUR_BULKSMS_APP_KEY', ''),
        ],
    ],
];
