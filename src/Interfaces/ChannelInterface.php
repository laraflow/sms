<?php

namespace Fintech\Bell\Interfaces;

use Illuminate\Notifications\Notification;

interface ChannelInterface
{
    public function send(object $notifiable, Notification $notification): void;
}
