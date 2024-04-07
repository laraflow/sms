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
```

# Configuration

Please follow this steps and you are live with in a mere seconds.

## General Configuration

1. On notification classes add SMS channel on the like this.
    ```php
        public function via(object $notifiable): array
        {
            return ['sms', '...other channel'];
        }
    ```
2. On the `.env` file please add this configuration.
    ```shell
    SMS_LOG=false
    SMS_DRIVER="twilio"
    SMS_ACCOUNT_MODE="sandbox"
    SMS_FROM_NAME="${APP_NAME}"
    ```

## Driver Configuration

Depending on driver option you choose, add these API credentials after existing general configuration variables.

| Driver           | Credentials                                                             | 
|------------------|-------------------------------------------------------------------------|
| `africastalking` | `SMS_AFRICA_TALKING_API_KEY=null`<br>`SMS_AFRICA_TALKING_USERNAME=null` |
| `clickatell`     | `SMS_CLICKATELL_API_KEY=null`                                           |
| `clicksend`      | `SMS_CLICKSEND_USERNAME=null`<br>`SMS_CLICKSEND_PASSWORD=null`          |
| `infobip`        | `SMS_INFOBIP_API_TOKEN=null`                                            |
| `messagebird`    | `SMS_MESSAGE_BIRD_ACCESS_KEY=null`                                      |
| `smsbroadcast`   | `SMS_SMSBROADCAST_USERNAME=null`<br>`SMS_SMSBROADCAST_PASSWORD=null`    |
| `telnyx`         | `SMS_TELNYX_API_TOKEN=null`                                             |
| `twilio`         | `SMS_TWILIO_USERNAME=null`<br>`SMS_TWILIO_PASSWORD=null`                |


### Auditory

This document was last updated at <strong><i>{docsify-updated}</i></strong>.
