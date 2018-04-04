<?php

namespace Minix\Auth\OAuth;

use Carbon\Carbon;
use Laravel\Passport\ApiTokenCookieFactory;
use Symfony\Component\HttpFoundation\Cookie as HttpCookie;

class CookieFactory extends ApiTokenCookieFactory
{
    /**
     * Create a new access token cookie.
     *
     * @param mixed  $userId
     * @param string $csrfToken
     *
     * @return HttpCookie
     */
    public function makeAccessTokenCookie($userId, $csrfToken)
    {
        $config = $this->config->get('session');

        $expiration = Carbon::now()->addMinutes($config['lifetime']);

        return new HttpCookie(
            Cookie::ACCESS_TOKEN,
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
     * @return HttpCookie
     */
    public function makeRefreshTokenCookie($refreshToken)
    {
        $config = $this->config->get('auth.passport.tokens.refresh');

        $expiration = Carbon::now()->addMinutes($config['expire']);

        return new HttpCookie(
            Cookie::REFRESH_TOKEN,
            $refreshToken,
            $expiration,
            null,
            null,
            false,
            true
        );
    }
}
