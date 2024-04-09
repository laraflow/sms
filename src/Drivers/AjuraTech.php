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
            'api_key' => 'required|string',
            'secret_key' => 'required|string',
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
            'apikey' => $this->config['api_key'],
            'secretkey' => $this->config['secret_key'],
            'toUser' => $message->getReceiver(),
            'callerID' => $message->getSender(),
            'messageContent' => $message->getContent(),
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->get($this->config['url'], $this->payload);

    }
}
