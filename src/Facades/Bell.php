<?php

namespace Fintech\Bell\Facades;

use Fintech\Bell\Drivers\SmsDriver;
use Illuminate\Support\Facades\Facade;

/**
 * @method static SmsDriver sms()
 *
 * // Crud Service Method Point Do not Remove //
 *
 * @see \Fintech\Bell\Bell
 */
class Bell extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Bell\Bell::class;
    }
}
