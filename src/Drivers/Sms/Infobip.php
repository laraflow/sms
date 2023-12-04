<?php

namespace Fintech\Bell\Drivers\Sms;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://www.infobip.com/docs/api/channels/sms/sms-messaging/outbound-sms/send-sms-message
 */
class Infobip extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.infobip.{$mode}", [
            'url' => null,
            'username' => null,
            'password' => null,
            'from' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'messages' => [[
                'destinations' => [['to' => $message->getReceiver()]],
                'from' => $this->config['from'],
                'text' => $message->getContent(),
            ]],
        ];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->withBasicAuth($this->config['username'], $this->config['password'])
            ->post($this->config['url'], $payload)->json();

        logger('SMS Response', [$response]);
    }
}
