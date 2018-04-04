<?php

namespace Minix\Auth\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestResponse;
use Laravel\Passport\Client;
use Laravel\Passport\ClientRepository;
use Minix\Auth\Models\User;
use Minix\Auth\OAuth\Cookie as OAuthCookie;
use Minix\Auth\OAuth\Parameter;
use Symfony\Component\HttpFoundation\Cookie;
use Tests\TestCase;

class PasswordGrantTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Client
     */
    private $client;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();

        $this->client = (new ClientRepository())
            ->createPasswordGrantClient(null, 'Test Client', 'http://localhost');
    }

    /** @test */
    public function i_can_get_fresh_oauth_tokens()
    {
        $response = $this->requestUserLogin();

        $this->assertValidNewTokenResponse($response);
    }

    /** @test */
    public function i_can_refresh_my_access_token_using_parameters()
    {
        $refreshToken = $this->getNewToken(Parameter::REFRESH_TOKEN);

        $response = $this->requestTokenRefresh([Parameter::REFRESH_TOKEN => $refreshToken]);

        $this->assertValidNewTokenResponse($response);
    }

    /** @test */
    public function i_can_refresh_my_access_token_using_cookies()
    {
        $refreshToken = $this->getNewTokenCookie(OAuthCookie::REFRESH_TOKEN);

        $response = $this->requestTokenRefresh([], [OAuthCookie::REFRESH_TOKEN => $refreshToken]);

        $this->assertValidNewTokenResponse($response);
    }

    /**
     * @return TestResponse
     */
    private function requestUserLogin()
    {
        return $this->postJson($this->getEndPoint('token'), $this->getUserCredentials());
    }

    /**
     * @param array $parameters
     * @param array $cookies
     *
     * @return TestResponse
     */
    private function requestTokenRefresh($parameters = [], $cookies = [])
    {
        return $this->call(
            'POST',
            $this->getEndPoint('token/refresh'),
            $parameters,
            $cookies
        );
    }

    /**
     * @param string $action
     *
     * @return string
     */
    private function getEndPoint($action)
    {
        return "api/v1/auth/{$action}";
    }

    /**
     * @return array
     */
    private function getUserCredentials()
    {
        return [
            Parameter::USERNAME => $this->user->email,
            Parameter::PASSWORD => 'secret',
        ];
    }

    /**
     * Get a new oauth token by extracting it from the login response.
     *
     * @param string $id
     *
     * @return string
     */
    private function getNewToken($id)
    {
        return array_get($this->requestUserLogin()->json(), $id);
    }

    /**
     * Get a new oauth token by getting the cookie value from the login response.
     *
     * @param string $id
     *
     * @return string
     */
    private function getNewTokenCookie($id)
    {
        return array_first(
            $this->requestUserLogin()->headers->getCookies(),

            function (Cookie $value) use ($id) {
                return $value->getName() == $id;
            }
        )->getValue();
    }

    /**
     * @param TestResponse $response
     */
    private function assertValidNewTokenResponse($response)
    {
        $response->assertStatus(200)
            ->assertCookie(OAuthCookie::ACCESS_TOKEN)
            ->assertCookie(OAuthCookie::REFRESH_TOKEN)
            ->assertJson(['token_type' => 'Bearer'])
            ->assertSee(Parameter::ACCESS_TOKEN)
            ->assertSee(Parameter::REFRESH_TOKEN);
    }
}
