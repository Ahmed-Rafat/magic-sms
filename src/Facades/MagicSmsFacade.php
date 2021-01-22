<?php

namespace AR\MagicSms\Facades;

use Illuminate\Support\Facades\Facade;

class MagicSmsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'magic-sms';
    }
}
