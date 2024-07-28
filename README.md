# Introduction

[![Latest Version on Packagist](https://img.shields.io/packagist/v/laraflow/sms.svg?style=flat-square)](https://packagist.org/packages/laraflow/sms)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/laraflow/sms/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/laraflow/sms/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/laraflow/sms/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/laraflow/sms/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/laraflow/sms.svg?style=flat-square)](https://packagist.org/packages/laraflow/sms)

**Laraflow/SMS** is a fast and lightweight sms channel collection for laravel application. This package allow users to integrate different **SMS** gateway api without any hassle.

# Installation

You can install the package via composer:

```bash
composer require laraflow/sms
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sms-config"
```

This is the contents of the published config file:

```php

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

        // ...
    ],
];

```


**Note: Complete list of all the sms vendors are given in [driver configuration](#/CONFIGURATION?id=driver-configuration) section.**


### Auditory

This document was last updated at <strong><i>{docsify-updated}</i></strong>.
