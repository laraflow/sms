<?php

namespace Laraflow\Sms;

use Laraflow\Sms\Exceptions\DriverNotFoundException;

class SmsMessage
{
    private ?string $receiver;

    private ?string $sender;

    private ?string $content;

    private ?string $driver;

    public function __construct(array $options = [])
    {
        $this->receiver = $options['to'] ?? null;
        $this->sender = $options['from'] ?? config('sms.from', config('app.name'));
        $this->content = $options['message'] ?? null;
        $this->driver = $options['vendor'] ?? config('sms.default');
    }

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
        return $this->sender;
    }

    public function getDriver(): ?string
    {
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

        if (config("sms.providers.{$this->driver}.driver") == null) {
            throw new DriverNotFoundException("No driver configuration found by `{$this->driver}` name.");
        }

        return $this;
    }

    public function send()
    {

    }
}
