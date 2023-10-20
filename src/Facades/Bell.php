<?php

namespace Fintech\Bell\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fintech\Bell\Bell
 */
class Bell extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fintech\Bell\Bell::class;
    }
}
