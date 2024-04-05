<?php

namespace Fintech\Bell\Drivers\Sms;

use Fintech\Bell\Drivers\SmsDriver;
use Fintech\Bell\Messages\SmsMessage;
use Illuminate\Support\Facades\Http;

/**
 * @see https://www.smsbroadcast.co.uk/developers
 */
class SmsBroadcast extends SmsDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.sms.mode', 'sandbox');

        $this->config = config("fintech.bell.sms.smsbroadcast.{$mode}", [
            'url' => 'https://api.smsbroadcast.com.au/api-adv.php',
            'username' => null,
            'password' => null,
            'from' => null,
            'ref' => null,
            'maxsplit' => null,
            'delay' => null,
        ]);
    }

    public function send(SmsMessage $message): void
    {
        $this->validate($message);

        $payload = [
            'username' => $this->config['username'],
            'password' => $this->config['password'],
            'from' => $this->config['from'],
            'ref' => $this->config['ref'],
            'maxsplit' => $this->config['maxsplit'],
            'delay' => $this->config['delay'],
            'to' => $message->getReceiver(),
            'message' => $message->getContent(),
        ];

        $response = Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->get($this->config['url'], $payload)->json();

        logger('Sms Broadcast Response', [$response]);
    }
}
