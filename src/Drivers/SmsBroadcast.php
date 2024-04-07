<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://www.smsbroadcast.co.uk/developers
 */
class SmsBroadcast extends SmsDriver
{
    protected function mergeConfig(): array
    {
        return [
            'ref' => null,
            'maxsplit' => null,
            'delay' => null,
        ];
    }

    /**
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        $this->payload = [
            'username' => $this->config['username'],
            'password' => $this->config['password'],
            'ref' => $this->config['ref'],
            'maxsplit' => $this->config['maxsplit'],
            'delay' => $this->config['delay'],
            'from' => $message->getSender(),
            'to' => $message->getReceiver(),
            'message' => $message->getContent(),
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->get($this->config['url'], $this->payload);
    }

    /**
     * this function return validation rules for
     * that sms driver to operate.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'password' => 'required|string',
            'username' => 'required|string'
        ];
    }
}
