<?php

namespace Laraflow\Sms\Facades;

use Illuminate\Support\Facades\Facade;
use Laraflow\Sms\Drivers\SmsDriver;

/**
 * @method static SmsDriver sms()
 *
 * @see \Laraflow\Sms\Bell
 */
class Sms extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Laraflow\Sms\Sms::class;
    }
}
