<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Abstracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @reference https://developers.africastalking.com/docs/sms/overview
 */
class AfricasTalking extends SmsDriver
{
    /**
     * this function return validation rules for
     * that sms driver to operate.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'apiKey' => 'required|string',
            'username' => 'required|string'
        ];
    }

    /**
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        $payload = [
            'username' => $this->config['username'],
            'to' => $message->getReceiver(),
            'from' => $message->getSender(),
            'message' => $message->getContent(),
        ];

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('apiKey', $this->config['apiKey'])
            ->get($this->config['url'], $payload);

    }

}
