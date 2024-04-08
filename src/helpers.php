<?php
if (!function_exists('sms')) {
    /**
     * Return a fresh instance to SMS service class
     *
     * @param string|null $to
     * @param string|null $message
     * @param string|null $from
     * @param string|null $driver
     *
     * @return \Laraflow\Sms\Sms
     */
    function sms(?string $to = null, ?string $message = null, ?string $from = null, ?string $driver = null): \Laraflow\Sms\Sms
    {
        return \Laraflow\Sms\Sms::make($to, $message, $from, $driver);
    }
}
