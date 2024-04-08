<?php

namespace Laraflow\Sms;

class Sms
{
    private SmsMessage $message;

    /**
     * @param $to
     * @param $message
     * @param $from
     * @param $driver
     * @throws \ErrorException
     */
    private function __construct($to = null, $message = null, $from = null, $driver = null)
    {
        throw new \ErrorException("This feature is under early stage of development");
        $this->message = new SmsMessage();
    }

    public static function make($to = null, $message = null, $from = null, $driver = null): self
    {
        return new self($to, $message, $from, $driver);
    }

    public function from(string $from = null): self
    {
        $this->from = $from;

        return $this;
    }

    public function to(string $to = null): self
    {
        $this->to = $to;

        return $this;
    }

    public function message(string $message = null): self
    {
        $this->message = $message;

        return $this;
    }

    public function vendor(string $driver = null): self
    {
        $this->driver = $driver;

        return $this;
    }

    public function send()
    {

    }
}
