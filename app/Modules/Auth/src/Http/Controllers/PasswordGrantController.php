<?php

namespace Minix\Auth\Http\Controllers;

use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Router;
use Minix\Auth\OAuth\Cookie;
use Minix\Auth\OAuth\CookieFactory;
use Minix\Auth\OAuth\Grant;
use Minix\Auth\OAuth\Parameter;
use Minix\Auth\OAuth\Repository;
use Minix\Http\Controllers\Controller;

class PasswordGrantController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Grant Controller
    |--------------------------------------------------------------------------
    |
    | This controller issues access tokens to first party applications using a password grant.
    | This is for applications that cannot securely store their client_id and client_secret. It
    | proxies requests to its respective repository route and injects the client_id and client_secret.
    |
    */

    /**
     * @var Router
     */
    private $router;

    /**
     * @var CookieJar
     */
    private $cookies;

    /**
     * @var CookieFactory
     */
    private $cookieFactory;

    /**
     * @var Repository;
     */
    private $repository;

    /**
     * @param Router        $router
     * @param CookieJar     $cookies
     * @param CookieFactory $cookieFactory
     * @param Repository    $repository
     */
    public function __construct(
        Router $router,
        CookieJar $cookies,
        CookieFactory $cookieFactory,
        Repository $repository
    ) {
        $this->router = $router;
        $this->cookies = $cookies;
        $this->cookieFactory = $cookieFactory;
        $this->repository = $repository;
    }

    /**
     * Authorize a first-party client to access the user's account.
     *
     * @param Request $request
     *
     * @return Response
     */
    protected function issueToken(Request $request)
    {
        $data = $request->only(Parameter::USERNAME, Parameter::PASSWORD);

        return $this->proxy($request, Grant::PASSWORD, $data);
    }

    /**
     * Refresh access token for the first-party client.
     *
     * @param Request $request
     *
     * @return Response
     */
    protected function refreshToken(Request $request)
    {
        $refreshToken =
            $request->input(Parameter::REFRESH_TOKEN) ??
            $request->cookie(Cookie::REFRESH_TOKEN);

        $data = [Parameter::REFRESH_TOKEN => $refreshToken];

        return $this->proxy($request, Grant::REFRESH, $data);
    }

    /**
     * Proxy the request to the repository server.
     *
     * @param Request $request
     * @param string  $grantType
     * @param array   $data
     *
     * @return Response
     */
    private function proxy(Request $request, $grantType, $data = [])
    {
        $response = $this->dispatchRequestToAuthServer($request, $grantType, $data);

        if (!$response->isSuccessful()) {
            return $response;
        }

        return $this->attachCookiesTo($response, $request->session()->token());
    }

    /**
     * Dispatch the request to the authorization server.
     *
     * @param Request $request
     * @param string  $grantType
     * @param array   $data
     *
     * @return Response
     */
    private function dispatchRequestToAuthServer(Request $request, $grantType, $data)
    {
        $client = $this->repository->getPasswordGrantClient();

        $request->request->replace(array_merge([
            'grant_type' => $grantType,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '*',
        ], $data));

        $proxy = $request->create('oauth/token', 'POST');

        return $this->router->dispatch($proxy);
    }

    /**
     * Create repository cookies from the authorization response and attach it.
     *
     * @param Response $response
     * @param string   $csrfToken
     *
     * @return Response
     */
    private function attachCookiesTo(Response $response, $csrfToken)
    {
        $data = json_decode($response->getContent());

        return $response
            ->withCookie($this->cookieFactory->makeAccessTokenCookie(
                $this->repository->findUserWithAccessToken($data->access_token)->getKey(),
                $csrfToken
            ))
            ->withCookie($this->cookieFactory->makeRefreshTokenCookie(
                $data->refresh_token
            ));
    }
}
