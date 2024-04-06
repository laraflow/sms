<?php

namespace Laraflow\Sms;

class SmsMessage
{
    public string $receiver;

    public string $content;

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function to($receiver)
    {
        $this->receiver = (string) $receiver;

        return $this;
    }

    public function message($content)
    {
        $this->content = (string) $content;

        return $this;
    }
}
