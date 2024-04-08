<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @reference https://developers.africastalking.com/docs/sms/overview
 */
class AfricasTalking extends SmsDriver
{
    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'api_key' => 'required|string',
            'username' => 'required|string',
        ];
    }

    /**
     * execute the sms sending request to api provider
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
            ->withToken($this->config['api_key'], 'apiKey')
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->get($this->config['url'], $this->payload);

    }
}
