<?php

namespace Laraflow\Sms\Drivers;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\SmsMessage;

/**
 * @see https://docs.clickatell.com/channels/sms-channels/sms-api-reference/#tag/SMS-API/operation/sendMessageHTTP
 */
class ClickATell extends SmsDriver
{
    /**
     * this function allow programmer to append more config
     * that may or may be needed in the configuration file
     *
     * @return string[]
     */
    protected function mergeConfig(): array
    {
        return [
            'url' => 'https://platform.clickatell.com/messages/http/send',
        ];
    }

    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    public function rules(): array
    {
        return [
            'url' => 'required|url:http,https',
            'apiKey' => 'required|string',
        ];
    }

    public function send(SmsMessage $message): Response
    {
        $this->payload = [
            'apiKey' => $this->config['api_key'],
            'to' => $message->getReceiver(),
            'from' => $message->getSender(),
            'content' => $message->getContent(),
        ];

        $this->removeEmptyParams();

        return Http::withoutVerifying()
            ->timeout(30)
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Accept', 'application/json')
            ->get($this->config['url'], $this->payload);
    }
}
