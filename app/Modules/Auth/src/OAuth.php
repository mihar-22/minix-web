<?php

namespace Minix\Auth;

use Laravel\Passport\Client;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser as JwtParser;
use Minix\Auth\Models\User;

class OAuth
{
    /*
    |--------------------------------------------------------------------------
    | OAuth
    |--------------------------------------------------------------------------
    |
    | This is mostly a helper class inline with Laravel Passport. At this current time it's only
    | use is to help with the Password Grant process, which enables first-party applications to
    | obtain oauth tokens.
    |
    | @see \Minix\Auth\Http\Controllers\PasswordGrantController
    |
    */

    /**
     * The username request parameter key.
     *
     * @var string
     */
    const USERNAME_PARAM = 'username';

    /**
     * The password request parameter key.
     *
     * @var string
     */
    const PASSWORD_PARAM = 'password';

    /**
     * The refresh token request parameter key.
     *
     * @var string
     */
    const ACCESS_TOKEN_PARAM = 'access_token';

    /**
     * The refresh token request parameter key.
     *
     * @var string
     */
    const REFRESH_TOKEN_PARAM = 'refresh_token';

    /**
     * The access token cookie name.
     *
     * @var string
     */
    const ACCESS_TOKEN_COOKIE = 'laravel_token';

    /**
     * The refresh token cookie name.
     *
     * @var string
     */
    const REFRESH_TOKEN_COOKIE = 'refresh_token';

    /**
     * The password grant type identifier.
     *
     * @var string
     */
    const PASSWORD_GRANT = 'password';

    /**
     * The refresh grant type identifier.
     *
     * @var string
     */
    const REFRESH_GRANT = 'refresh_token';

    /**
     * @var OAuthCookieFactory
     */
    public $cookieFactory;

    /**
     * @var Client
     */
    private $clients;

    /**
     * @var Token
     */
    private $tokens;

    /**
     * The JWT token parser.
     *
     * @var JwtParser
     */
    private $jwt;

    /**
     * @param OAuthCookieFactory $cookieFactory
     * @param Client             $clients
     * @param Token              $tokens
     * @param JwtParser          $jwt
     */
    public function __construct(
        OAuthCookieFactory $cookieFactory,
        Client $clients,
        Token $tokens,
        JwtParser $jwt
    ) {
        $this->cookieFactory = $cookieFactory;
        $this->clients = $clients;
        $this->tokens = $tokens;
        $this->jwt = $jwt;
    }

    /**
     * Get the user instance for the given JWT representation of the access token.
     *
     * @param string $jwt
     *
     * @return User
     */
    public function findUserWithAccessToken($jwt)
    {
        $accessToken = $this->jwt->parse($jwt)->getClaim('jti');

        return $this->tokens->find($accessToken)->user()->first();
    }

    /**
     * Get the Minix password grant client from the database.
     *
     * @return Client
     */
    public function getPasswordGrantClient()
    {
        return $this->clients->where('password_client', true)->first();
    }
}
