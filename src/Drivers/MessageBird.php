<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://developers.messagebird.com/api/sms-messaging/#send-outbound-sms
 */
class MessageBird extends SmsDriver
{
    protected function mergeConfig(): array
    {
        return [
            'type' => 'sms',
            'mclass' => 1,
            'url' => 'https://rest.messagebird.com/messages',
        ];
    }

    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [
            'type' => 'required|string',
            'url' => 'required|url:http,https',
            'access_key' => 'required|string',
            'mclass' => 'nullable',
        ];
    }

    public function send(SmsMessage $message): Response
    {
        $this->payload = [
            'recipients' => $message->getReceiver(),
            'originator' => $message->getSender(),
            'type' => $this->config['type'],
            'mclass' => $this->config['mclass'],
            'body' => $message->getContent(),
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withToken($this->config['access_key'], 'AccessKey')
            ->post($this->config['url'], $this->payload);
    }
}
