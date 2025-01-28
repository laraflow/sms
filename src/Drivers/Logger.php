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
        return new Response(new class ($message) {
            public function __construct(public SmsMessage $message)
            {

            }
            public function getStatusCode(): string
            {
                return '200';
            }
            public function getBody(): string
            {
                return json_encode([
                    'to' => $this->message->getReceiver(),
                    'from' => $this->message->getSender(),
                    'content' => $this->message->getContent(),
                ]);
            }
        });
    }
}
