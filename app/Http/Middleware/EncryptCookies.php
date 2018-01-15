<?php

namespace Minix\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Minix\Auth\OAuth;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        /*
         * Encrypted on creation and decrypted by token guard.
         *
         * @see \Minix\Auth\OAuthCookieFactory
         * @see \Laravel\Passport\Guards\TokenGuard
         */
        OAuth::ACCESS_TOKEN_COOKIE,
    ];
}
