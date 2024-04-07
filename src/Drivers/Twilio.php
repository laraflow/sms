<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://www.twilio.com/docs/messaging/api/message-resource
 */
class Twilio extends SmsDriver
{
    /**
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        $this->payload = [
            'To' => $message->getReceiver(),
            'Body' => $message->getContent(),
        ];

        $url = str_replace('$TWILIO_ACCOUNT_SID$', $this->config['username'], $this->config['url']);

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withBasicAuth($this->config['username'], $this->config['password'])
            ->post($url, $this->payload);
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
            'url' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string'
        ];
    }
}
