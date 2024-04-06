<?php

namespace Laraflow\Sms;

use BadMethodCallException;
use Laraflow\Sms\Exceptions\SmsException;
use Laraflow\Sms\Interfaces\ChannelInterface;

class SmsChannel implements ChannelInterface
{
    private $driver;

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

        $mode = config("sms.mode", 'sandbox');

        $config = config("sms.vendors.{$active}.{$mode}", []);

        $this->driver = \App::make($driver, $config);
    }

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, \Illuminate\Notifications\Notification $notification): void
    {
        if (!method_exists($notification, 'toSms')) {
            throw new BadMethodCallException(get_class($notification) . " notification is missing the toSms(object $notifiable): SmsMessage method.");
        }

        try {
            $message = $notification->toSms($notifiable);

            $this->driver->send($message);

        } catch (\Exception $exception) {

            \Log::error($exception);
        }
    }
}
