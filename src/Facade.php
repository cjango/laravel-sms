<?php

namespace Jason\Sms;

use Illuminate\Support\Facades\Facade as LaravelFacade;

class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return \Jason\Sms\Facade::class;
    }
}
