<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://developers.telnyx.com/openapi/messaging/tag/Messages/#tag/Messages/operation/createMessage
 */
class Telnyx extends SmsDriver
{
    protected function mergeConfig(): array
    {
        return [
            'type' => 'SMS',
        ];
    }

    public function send(SmsMessage $message): Response
    {
        $this->payload = [
            'to' => $message->getReceiver(),
            'text' => $message->getContent(),
            'from' => $message->getSender(),
            'type' => $this->config['type'],
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->contentType('application/json')
            ->withToken($this->config['token'])
            ->post($this->config['url'], $this->payload);
    }

    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'token' => 'required|string',
        ];
    }
}
