<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @reference
 */
class AjuraTech extends SmsDriver
{
    /**
     * this function allow programmer to append more config
     * that may or may be needed in the configuration file
     *
     * @return string[]
     */
    protected function mergeConfig(): array
    {
        return [
            'url' => 'https://smpp.ajuratech.com:7790/sendtext?json',
        ];
    }

    /**
     * Return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'apiKey' => 'required|string',
            'username' => 'required|string',
        ];
    }

    /**
     * Execute the sms sending request to api provider
     *
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        $this->payload = [
            'username' => $this->config['username'],
            'to' => $message->getReceiver(),
            'from' => $message->getSender(),
            'message' => $message->getContent(),
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('apiKey', $this->config['apiKey'])
            ->get($this->config['url'], $this->payload);

    }
}
