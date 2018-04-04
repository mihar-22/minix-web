<?php

namespace Minix\Auth\OAuth;

use Laravel\Passport\Client;
use Laravel\Passport\Token;
use Lcobucci\JWT\Parser as JwtParser;
use Minix\Auth\Models\User;

class Repository
{
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
     * @param Client    $clients
     * @param Token     $tokens
     * @param JwtParser $jwt
     */
    public function __construct(Client $clients, Token $tokens, JwtParser $jwt)
    {
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