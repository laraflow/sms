<?php

namespace Fintech\Bell\Drivers\Push;

use Fintech\Bell\Drivers\PushDriver;
use Fintech\Bell\Messages\PushMessage;
use Illuminate\Support\Facades\Http;

/**
 * FCM (Firebase Cloud Messaging)
 *
 * @see https://laravel-notification-channels.com/fcm/
 */
class FirebasePush extends PushDriver
{
    private array $config;

    public function __construct()
    {
        $mode = config('fintech.bell.push.mode', 'sandbox');

        $this->config = config("fintech.bell.push.fcm.{$mode}", [
            'url' => null,
            'username' => null,
            'password' => null,
        ]);
    }

    public function send(PushMessage $message): void
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

        logger('SMS Response', [$response]);
    }
}
