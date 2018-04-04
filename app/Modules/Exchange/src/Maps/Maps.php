<?php

namespace Minix\Exchange\Maps;

use Illuminate\Support\Facades\Facade;

class Maps extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Factory::class;
    }
}