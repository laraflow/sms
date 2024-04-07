<?php

namespace Laraflow\Sms;

use BadMethodCallException;
use Exception;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Laraflow\Sms\Contracts\SmsDriver;
use Laraflow\Sms\Exceptions\DriverNotFoundException;

class SmsChannel
{
    /**
     * @var SmsDriver
     */
    private mixed $driver;

    public $response;

    /**
     * @throws DriverNotFoundException|ValidationException|InvalidArgumentException
     */
    public function __construct()
    {
        $active = config('sms.default');

        if ($active == null) {
            throw new InvalidArgumentException('No SMS vendor driver configured as default.');
        }

        $driver = config("sms.vendors.{$active}.driver");

        if ($driver == null || ! class_exists($driver)) {
            throw new DriverNotFoundException("No driver configuration found by `{$active}` name.");
        }

        $mode = config('sms.mode', 'sandbox');

        $config = config("sms.vendors.{$active}.{$mode}", []);

        $this->driver = App::make($driver);

        $this->driver->setConfig($config);

        $this->driver->mode = $mode;
    }

    /**
     * Send the given notification.
     *
     * @throws ValidationException
     * @throws Exception
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (! method_exists($notification, 'toSms')) {
            throw new BadMethodCallException(get_class($notification)." notification is missing the toSms(object $notifiable): SmsMessage method.");
        }

        try {

            $message = $notification->toSms($notifiable);

            $this->validate($message);

            $this->response = $this->driver->send($message);

            $this->logSmsResponse();

        } catch (Exception $exception) {
            (App::isProduction())
                ? Log::error($exception)
                : throw new Exception($exception->getMessage(), 0, $exception);
        }
    }

    private function logSmsResponse(): void
    {
        if (config('sms.log', false)) {
            Log::debug('SMS Vendor Response: ', ['status_code' => $this->response->status(), 'response' => $this->response->body()]);
        }
    }

    /**
     * this function will validate if the given content satisfy the
     * driver required params.
     */
    private function validate(SmsMessage $message): void
    {
        if ($message->getReceiver() == null || strlen($message->getReceiver()) == 0) {
            throw new InvalidArgumentException('Message recipient(s) is empty.');
        }

        if ($message->getContent() == null || strlen($message->getContent()) == 0) {
            throw new InvalidArgumentException('Message content is empty.');
        }
    }
}
