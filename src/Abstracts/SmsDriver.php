<?php

namespace Laraflow\Sms\Abstracts;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Laraflow\Sms\SmsMessage;

abstract class SmsDriver
{
    protected mixed $config;

    public ?string $mode;

    public function setConfig(array $config = []): void
    {
        $this->config = array_merge($config, $this->mergeConfig());
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
    public function validateConfig(): void
    {
        $validator = Validator::make($this->config, $this->rules());

        if (! $validator->valid()) {
            throw ValidationException::withMessages($validator->errors()->messages());
        }
    }

    /**
     * this function will validate if the given content satisfy the
     * driver required params.
     */
    public function validate(SmsMessage $message): void
    {
        if ($message->getReceiver() == null || strlen($message->getReceiver()) == 0) {
            throw new InvalidArgumentException('Message recipient could not be empty.');
        }

        if ($message->getContent() == null || strlen($message->getContent()) == 0) {
            throw new InvalidArgumentException('Message content could not be empty.');
        }
    }

    /**
     * this function return validation rules for
     * that sms driver to operate.
     */
    abstract public function rules(): array;

    abstract public function send(SmsMessage $message): Response;
}
