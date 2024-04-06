<?php

namespace Laraflow\Sms;

use BadMethodCallException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Laraflow\Sms\Abstracts\SmsDriver;
use Laraflow\Sms\Exceptions\SmsException;

class SmsChannel
{
    /**
     * @var SmsDriver
     */
    private mixed $driver;

    /**
     * @throws SmsException
     */
    public function __construct()
    {
        $active = config('sms.default');

        if ($active == null) {
            throw new SmsException('No SMS driver configured as default');
        }

        $driver = config("sms.vendors.{$active}.driver");

        $mode = config('sms.mode', 'sandbox');

        $config = config("sms.vendors.{$active}.{$mode}", []);

        $this->driver = \Illuminate\Support\Facades\App::make($driver);

        $this->driver->setConfig($config);

        $this->driver->mode = $mode;
    }

    /**
     * Send the given notification.
     *
     * @throws ValidationException
     * @throws \Exception
     */
    public function send(object $notifiable, \Illuminate\Notifications\Notification $notification): void
    {
        $this->driver->validateConfig();

        if (! method_exists($notification, 'toSms')) {
            throw new BadMethodCallException(get_class($notification)." notification is missing the toSms(object $notifiable): SmsMessage method.");
        }

        try {

            $message = $notification->toSms($notifiable);

            $this->driver->validate($message);

            $response = $this->driver->send($message);

            if (config('sms.log', false)) {
                Log::debug('SMS Vendor Response: ', ['status_code' => $response->status(), 'response' => $response->body()]);
            }

        } catch (\Exception $exception) {
            (App::isProduction())
                ? Log::error($exception)
                : throw new \Exception($exception->getMessage(), 0, $exception);
        }
    }
}
