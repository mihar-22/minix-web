<?php

namespace Minix\Auth\OAuth;

use Minix\Support\Enum;

class Parameter extends Enum
{
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const ACCESS_TOKEN = 'access_token';
    const REFRESH_TOKEN = 'refresh_token';
}