<?php

namespace Laraflow\Sms\Drivers\Sms;

use Laraflow\Sms\Drivers\SmsDriver;
use Laraflow\Sms\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://developers.telnyx.com/openapi/messaging/tag/Messages/#tag/Messages/operation/createMessage
 */
class Telnyx extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.telnyx.{$mode}", [
            'url' => null,
            'username' => null,
            'password' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'to' => $message->getReceiver(),
            'text' => $message->getContent(),
            'type' => 'SMS',
        ];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->contentType('application/json')
            ->withToken($this->config['password'])
            ->post($this->config['url'], $payload)->json();

        logger('SMS Response', [$response]);
    }
}
