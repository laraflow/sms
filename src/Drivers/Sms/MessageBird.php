<?php

namespace Fintech\Bell\Drivers\Sms;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://developers.messagebird.com/api/sms-messaging/#send-outbound-sms
 */
class MessageBird extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.messagebird.{$mode}", [
            'url' => null,
            'originator' => null,
            'access_key' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'recipients' => $message->getReceiver(),
            'originator' => $this->config['originator'],
            'type' => 'sms',
            'mclass' => 1,
            'body' => $message->getContent()
        ];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->withToken($this->config['access_key'], 'AccessKey')
            ->post($this->config['url'], $payload)->json();

        logger('SMS Response', [$response]);
    }
}
