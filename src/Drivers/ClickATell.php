<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Abstracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://docs.clickatell.com/channels/sms-channels/sms-api-reference/#tag/SMS-API/operation/sendMessageHTTP
 */
class ClickATell extends SmsDriver
{
    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'apiKey' => 'required|string',
        ];
    }

    public function send(SmsMessage $message): Response
    {
        $payload = [
            'apiKey' => $this->config['apiKey'],
            'to' => $message->getReceiver(),
            'from' => $message->getSender(),
            'content' => $message->getContent(),
        ];

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->get($this->config['url'], $payload);
    }
}
