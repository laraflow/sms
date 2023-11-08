<?php

namespace Fintech\Bell\Channels;

use Fintech\Bell\Interfaces\ChannelInterface;
use Illuminate\Notifications\Notification;

class PushChannel implements ChannelInterface
{
    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        // Send notification to the $notifiable instance...
    }
}
