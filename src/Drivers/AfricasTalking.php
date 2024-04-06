<?php

namespace Laraflow\Sms\Drivers\Sms;

use Laraflow\Sms\Drivers\SmsDriver;
use Laraflow\Sms\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://docs.clickatell.com/channels/sms-channels/sms-api-reference/#tag/SMS-API/operation/sendMessageHTTP
 */
class AfricasTalking extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.clickatell.{$mode}", [
            'url' => 'https://api.sandbox.africastalking.com/version1/messaging',
            'apiKey' => null,
            'username' => null,
            'from' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'username' => $this->config['username'],
            'to' => $message->getReceiver(),
            'from' => $this->config['from'],
            'message' => $message->getContent(),
        ];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->withHeader('apiKey', $this->config['apiKey'])
            ->get($this->config['url'], $payload)->json();

        logger('Africa\'s Talking Response', [$response]);
    }
}
