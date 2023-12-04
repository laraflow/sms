<?php

namespace Fintech\Bell\Drivers\Sms;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://www.twilio.com/docs/messaging/api/message-resource
 */
class Twilio extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.twilio.{$mode}", [
            'url' => null,
            'username' => null,
            'password' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'To' => $message->getReceiver(),
            'Body' => $message->getContent(),
        ];

        $url = str_replace('$TWILIO_ACCOUNT_SID$', $this->config['username'], $this->config['url']);

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->withBasicAuth($this->config['username'], $this->config['password'])
            ->post($url, $payload)->json();

        logger('SMS Response', [$response]);
    }
}
