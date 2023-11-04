<?php

namespace Fintech\Bell\Facades;

use Illuminate\Support\Facades\Facade;

/**
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
