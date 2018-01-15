<?php

namespace Minix\Auth;

use Carbon\Carbon;
use Laravel\Passport\ApiTokenCookieFactory;
use Symfony\Component\HttpFoundation\Cookie;

class OAuthCookieFactory extends ApiTokenCookieFactory
{
    /**
     * Create a new access token cookie.
     *
     * @param mixed  $userId
     * @param string $csrfToken
     *
     * @return Cookie
     */
    public function makeAccessTokenCookie($userId, $csrfToken)
    {
        $config = $this->config->get('session');

        $expiration = Carbon::now()->addMinutes($config['lifetime']);

        return new Cookie(
            OAuth::ACCESS_TOKEN_COOKIE,
            $this->encrypter->encrypt($this->createToken($userId, $csrfToken, $expiration)),
            $expiration,
            $config['path'],
            $config['domain'],
            $config['secure'],
            true
        );
    }

    /**
     * Create a new refresh token cookie.
     *
     * @param string $refreshToken
     *
     * @return Cookie
     */
    public function makeRefreshTokenCookie($refreshToken)
    {
        $config = $this->config->get('auth.passport.tokens.refresh');

        $expiration = Carbon::now()->addMinutes($config['expire']);

        return new Cookie(
            OAuth::REFRESH_TOKEN_COOKIE,
            $refreshToken,
            $expiration,
            null,
            null,
            false,
            true
        );
    }
}
