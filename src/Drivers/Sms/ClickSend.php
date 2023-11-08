<?php

namespace Fintech\Bell\Drivers\Sms;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

class ClickSend extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.clicksend.{$mode}", [
            'url' => null,
            'username' => null,
            'password' => null
        ]);
    }

    /**
     * @param SmsMessage $message
     * @return void
     */
    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = ['messages' => [[
            'source' => 'php',
            'body' => $message->getContent(),
            'to' => $message->getReceiver(),
        ]]];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->contentType('application/json')
            ->withBasicAuth($this->config['username'], $this->config['password'])
            ->post($this->config['url'], $payload)->json();

        logger("SMS Response", [$response]);
    }
}
