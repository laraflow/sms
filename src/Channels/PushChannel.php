<?php

namespace Fintech\Bell\Channels;

use Fintech\Bell\Facades\Bell;
use Fintech\Bell\Interfaces\ChannelInterface;
use Illuminate\Notifications\Notification;

class PushChannel implements ChannelInterface
{
    private $driver;

    public function __construct()
    {
        $this->driver = Bell::push();
    }

    /**
     * Send the given notification.
     */
    public function send(object $notifiable, Notification $notification): void
    {
        // Send notification to the $notifiable instance...
    }
}
