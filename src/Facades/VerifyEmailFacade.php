<?php

namespace Megaads\RealEmail\Facades;

use Illuminate\Support\Facades\Facade;

class VerifyEmailFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'realemail';
    }
}