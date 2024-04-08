<?php

namespace Laraflow\Sms\Contracts;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laraflow\Sms\SmsMessage;

abstract class SmsDriver
{
    public ?string $mode;

    protected mixed $config;

    public $payload;

    /**
     * @throws ValidationException
     */
    public function setConfig(array $config = [], string $mode = 'sandbox'): void
    {
        $this->mode = $mode;

        $this->config = array_merge($config, $this->mergeConfig());

        $this->validate();
    }

    /**
     * this function allow programmer to append more config
     * that may or may be needed in the configuration file
     */
    protected function mergeConfig(): array
    {
        return [];
    }

    /**
     * this function will evaluate if config values
     * given from user configuration.
     *
     * @throws ValidationException
     */
    private function validate(): void
    {
        $validator = Validator::make($this->config, $this->rules());

        if (! $validator->valid()) {
            throw ValidationException::withMessages($validator->errors()->messages());
        }
    }

    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    abstract public function rules(): array;

    protected function removeEmptyParams(): void
    {
        $this->payload = array_filter($this->payload, function ($element) {
            return ! empty($element);
        });
    }

    /**
     * execute the sms sending request to api provider
     *
     * @param SmsMessage $message
     * @return Response
     */
    abstract public function send(SmsMessage $message): Response;
}
