<?php

namespace Laraflow\Sms\Interfaces;

use Illuminate\Notifications\Notification;

interface ChannelInterface
{
    public function send(object $notifiable, Notification $notification): void;
}
