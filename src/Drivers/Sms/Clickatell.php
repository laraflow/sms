<?php

namespace Fintech\Bell\Drivers\Sms;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://docs.clickatell.com/channels/sms-channels/sms-api-reference/#tag/SMS-API/operation/sendMessageHTTP
 */
class Clickatell extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.clickatell.{$mode}", [
            'url' => 'https://platform.clickatell.com/messages/http/send',
            'apiKey' => null,
            'from' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'apiKey' => $this->config['apiKey'],
            'to' => $message->getReceiver(),
            'from' => $this->config['from'],
            'content' => $message->getContent(),
        ];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->get($this->config['url'], $payload)->json();

        logger('Clickatell Response', [$response]);
    }
}
