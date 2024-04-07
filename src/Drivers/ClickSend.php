<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://developers.clicksend.com/docs/rest/v3/?shell#send-sms
 */
class ClickSend extends SmsDriver
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
            'source' => 'required|string',
            'url' => 'required|url:http,https',
            'password' => 'required|string',
            'username' => 'required|string'
        ];
    }

    /**
     * @param SmsMessage $message
     * @return Response
     */
    public function send(SmsMessage $message): Response
    {
        $this->payload = ['messages' => [[
            'source' => $this->config['source'],
            'body' => $message->getContent(),
            'to' => $message->getReceiver(),
        ]]];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->contentType('application/json')
            ->withBasicAuth($this->config['username'], $this->config['password'])
            ->post($this->config['url'], $this->payload);
    }

    protected function mergeConfig(): array
    {
        return [
            'source' => 'php'
        ];
    }
}
