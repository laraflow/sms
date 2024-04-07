<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://www.infobip.com/docs/api/channels/sms/sms-messaging/outbound-sms/send-sms-message
 */
class Infobip extends SmsDriver
{

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
            'token' => 'required|string'
        ];
    }

    /**
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        $this->payload = ['messages' => [[
            'destinations' => [['to' => $message->getReceiver()]],
            'from' => $message->getSender(),
            'text' => $message->getContent(),
        ]]];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeaders(['Content-Type' => 'application/json', 'Accept' => 'application/json'])
            ->withToken($this->config['token'], 'App')
            ->post($this->config['url'], $this->payload);
    }
}
