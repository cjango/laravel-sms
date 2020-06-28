<?php

namespace Jason\Sms;

use Illuminate\Support\Facades\Facade as LaravelFacade;

/**
 * Class Facade
 * @package Jason\Sms
 * @method static \Jason\Sms\Sms send($mobile, $channel)
 * @method static \Jason\Sms\Sms check($mobile, $code, $channel)
 */
class Facade extends LaravelFacade
{
    protected static function getFacadeAccessor()
    {
        return \Jason\Sms\Sms::class;
    }
}
