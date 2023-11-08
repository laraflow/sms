<?php

namespace Fintech\Bell\Drivers;

use Fintech\Bell\Messages\SmsMessage;

abstract class SmsDriver
{
    public function validate(SmsMessage $message): void
    {
        if ($message->getReceiver() == null || strlen($message->getReceiver()) == 0) {
            throw new \InvalidArgumentException('Message recipient could not be empty.');
        }

        if ($message->getContent() == null || strlen($message->getContent()) == 0) {
            throw new \InvalidArgumentException('Message content could not be empty.');
        }
    }

    abstract public function send(SmsMessage $message): void;
}
