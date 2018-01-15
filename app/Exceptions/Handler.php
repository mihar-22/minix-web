<?php

namespace Minix\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException as IlluminateAuthorizationException;
use Illuminate\Auth\AuthenticationException as IlluminateAuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException as IlluminateModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException as IlluminateTokenMismatchException;
use Illuminate\Validation\ValidationException as IlluminateValidationException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Minix\Exceptions\Illuminate\AuthenticationException;
use Minix\Exceptions\Illuminate\AuthorizationException;
use Minix\Exceptions\Illuminate\ModelNotFoundException;
use Minix\Exceptions\Illuminate\NotFoundHttpException;
use Minix\Exceptions\Illuminate\TokenMismatchException;
use Minix\Exceptions\Illuminate\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as IlluminateNotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        OAuthServerException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $e
     *
     * @return mixed
     *
     * @throws \Exception
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into a response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $e)
    {
        $e = $this->prepareExceptionForRendering($e);

        return parent::render($request, $e);
    }

    /**
     * Prepare the exception to be rendered into an HTTP response.
     *
     * @param \Exception $e
     *
     * @return \Exception
     */
    public function prepareExceptionForRendering(Exception $e)
    {
        if ($e instanceof IlluminateValidationException) {
            $e = new ValidationException($e);
        }

        if ($e instanceof IlluminateAuthorizationException) {
            $e = new AuthorizationException($e);
        }

        if ($e instanceof IlluminateAuthenticationException) {
            $e = new AuthenticationException($e);
        }

        if ($e instanceof IlluminateModelNotFoundException) {
            $e = new ModelNotFoundException($e);
        }

        if ($e instanceof IlluminateTokenMismatchException) {
            $e = new TokenMismatchException($e);
        }

        if ($e instanceof IlluminateNotFoundHttpException) {
            $e = new NotFoundHttpException($e);
        }

        return $e;
    }
}
