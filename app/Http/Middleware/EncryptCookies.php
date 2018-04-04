<?php

namespace Minix\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Minix\Auth\OAuth\Cookie;

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
         * @see \Minix\Auth\OAuth\CookieFactory
         * @see \Laravel\Passport\Guards\TokenGuard
         */
        Cookie::ACCESS_TOKEN,
    ];
}
