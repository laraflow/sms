<?php

namespace Laraflow\Sms\Drivers;

use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

class Logger extends SmsDriver
{
    /**
     * this function allow programmer to append more config
     * that may or may be needed in the configuration file
     *
     * @return string[]
     */
    protected function mergeConfig(): array
    {
        return [];
    }


    /**
     * Return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [];
    }

    /**
     * Execute the sms sending request to api provider
     *
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        return [];

    }
}
