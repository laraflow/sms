<?php

namespace Fintech\Bell\Drivers;

use Fintech\Bell\Messages\PushMessage;

abstract class PushDriver
{
    public function validate(PushMessage $message): void
    {
        if ($message->getReceiver() == null || strlen($message->getReceiver()) == 0) {
            throw new \InvalidArgumentException('Message recipient could not be empty.');
        }

        if ($message->getContent() == null || strlen($message->getContent()) == 0) {
            throw new \InvalidArgumentException('Message content could not be empty.');
        }
    }

    abstract public function send(PushMessage $message): void;
}
