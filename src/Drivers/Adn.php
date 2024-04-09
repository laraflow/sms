<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @reference https://portal.adnsms.com/client/api/documentation
 */
class Adn extends SmsDriver
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
            'url' => 'https://portal.adnsms.com/api/v1/secure/send-sms',
            'request_type' => 'SINGLE_SMS',
            'message_type' => 'UNICODE'
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
            'api_secret' => 'required|string'
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
            'api_key' => $this->config['api_key'],
            'api_secret' => $this->config['api_secret'],
            'request_type' => $this->config['request_type'],
            'message_type' => $this->config['message_type'],
            'mobile' => $message->getReceiver(),
            'message_body' => $message->getContent(),
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeaders(['Content-Type' => 'application/json','Accept' => 'application/json'])
            ->post($this->config['url'], $this->payload);

    }
}
