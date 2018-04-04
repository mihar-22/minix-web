<?php

namespace Minix\Auth\OAuth;

use Minix\Support\Enum;

class Cookie extends Enum
{
    const ACCESS_TOKEN = 'laravel_token';
    const REFRESH_TOKEN = 'refresh_token';
}