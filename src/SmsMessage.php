<?php

namespace Laraflow\Sms;

class SmsMessage
{
    private ?string $receiver;

    private ?string $sender;

    private ?string $content;

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getSender()
    {
        if ($this->sender == null) {

            $this->sender = config('sms.from', config('app.name'));
        }

        return $this->sender;
    }

    public function to($receiver): self
    {
        $this->receiver = (string) $receiver;

        return $this;
    }

    public function message($content): self
    {
        $this->content = (string) $content;

        return $this;
    }

    public function from($from = null): self
    {
        $this->sender = ($from != null) ? $from : config('sms.from', config('app.name'));

        return $this;
    }
}
