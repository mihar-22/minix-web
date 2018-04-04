<?php

namespace Minix\Auth\OAuth;

use Minix\Support\Enum;

class Grant extends Enum
{
    const PASSWORD = 'password';
    const REFRESH = 'refresh_token';
}