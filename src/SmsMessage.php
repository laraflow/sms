<?php

namespace Laraflow\Sms;

use Laraflow\Sms\Exceptions\DriverNotFoundException;

class SmsMessage
{
    private ?string $receiver;

    private ?string $sender;

    private ?string $content;

    private ?string $driver;

    public function getReceiver(): ?string
    {
        return $this->receiver;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function getSender(): ?string
    {
        if ($this->sender == null) {

            $this->sender = config('sms.from', config('app.name'));
        }

        return $this->sender;
    }

    public function getDriver(): ?string
    {
        if ($this->driver == null) {

            $this->driver = config('sms.default');
        }

        return $this->driver;
    }

    public function to($receiver): self
    {
        $this->receiver = (string)$receiver;

        return $this;
    }

    public function message($content): self
    {
        $this->content = (string)$content;

        return $this;
    }

    public function from($from = null): self
    {
        $this->sender = ($from != null) ? $from : config('sms.from', config('app.name'));

        return $this;
    }

    public function vendor($name = null): self
    {
        $this->driver = ($name != null) ? $name : config('sms.default');

        if (config("sms.vendors.{$this->driver}.driver") == null) {
            throw new DriverNotFoundException("No driver configuration found by `{$this->driver}` name.");
        }

        return $this;
    }
}
