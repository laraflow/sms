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
                'mode' => $this->driver->mode,
                'status_code' => $this->response->status(),
                'response' => $this->processResponseBody($this->response->body())
            ]);
        }
    }

    private function processResponseBody($content)
    {
        $dump = json_decode($content, true);

        if (json_last_error() == JSON_ERROR_NONE) {
            return $dump;
        }

        return $content;
    }

    private function validate(SmsMessage $message): void
    {
        if (empty($message->getReceiver())) {
            throw new InvalidArgumentException('Message recipient(s) is empty.');
        }

        if (empty($message->getContent())) {
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

            if (!$to = $notifiable->routeNotificationFor('sms', $notification)) {
                throw new BadMethodCallException(get_class($notifiable) . " notifiable is missing the `routeNotificationForSms(object $notifiable): string` method.");
            }

            $message->to($to);

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
