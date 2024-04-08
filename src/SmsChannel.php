<?php

namespace Laraflow\Sms;

use BadMethodCallException;
use Exception;
use Illuminate\Http\Client\Response;
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

    private string $driver_code;

    public Response $response;

    /**
     * @throws DriverNotFoundException
     * @throws ValidationException
     */
    private function initDriver(string $driver = null): void
    {
        $active = $driver ?? config('sms.default');

        if ($active == null) {
            throw new InvalidArgumentException('No SMS vendor driver configured.');
        }

        $driverClass = config("sms.providers.{$active}.driver");

        if ($driverClass == null || !class_exists($driverClass)) {
            throw new DriverNotFoundException("No driver configuration found by `{$active}` name.");
        }

        $this->driver_code = $active;

        $mode = config('sms.mode', 'sandbox');

        $config = config("sms.providers.{$active}.{$mode}", []);

        $this->driver = App::make($driverClass);

        $this->driver->setConfig($config, $mode);

    }

    private function logSmsResponse(): void
    {
        if (config('sms.log', false)) {
            Log::channel('sms')->info('Response: ', [
                'vendor' => $this->driver_code,
                'model' => $this->driver->mode,
                'status_code' => $this->response->status(),
                'response' => $this->response->body()
            ]);
        }
    }

    private function validate(SmsMessage $message): void
    {
        if (strlen($message->getReceiver()) == 0) {
            throw new InvalidArgumentException('Message recipient(s) is empty.');
        }

        if (strlen($message->getContent()) == 0) {
            throw new InvalidArgumentException('Message content is empty.');
        }
    }

    /**
     * Send the given notification.
     *
     * @throws ValidationException
     * @throws Exception
     */
    public function send(object $notifiable, Notification $notification): void
    {
        if (!method_exists($notification, 'toSms')) {
            throw new BadMethodCallException(get_class($notification) . " notification is missing the toSms(object $notifiable): SmsMessage method.");
        }

        try {
            /**
             * @var SmsMessage $message
             */
            $message = $notification->toSms($notifiable);

            $this->initDriver($message->getDriver());

            $this->validate($message);

            $this->response = $this->driver->send($message);

            $this->logSmsResponse();

        } catch (Exception $exception) {
            (App::isProduction())
                ? Log::error($exception)
                : throw new Exception($exception->getMessage(), 0, $exception);
        }
    }
}
