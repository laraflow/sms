<?php

namespace Fintech\Bell\Channels;

use Fintech\Bell\Facades\Bell;
use Fintech\Bell\Interfaces\ChannelInterface;
use Illuminate\Notifications\Notification;

class SmsChannel implements ChannelInterface
{
    private $driver;

    public function __construct()
    {
        $this->driver = Bell::sms();
    }

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toSms')) {
            throw new \BadMethodCallException(get_class($notification) ."notification is missing the toSms(object $notifiable): SmsMessage method.");
        }

        $message = $notification->toSms($notifiable);

        $this->driver->send($message);

    }
}
