<?php

namespace Minix\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Minix\Http\Errors\Errorable;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseException extends Exception implements Errorable
{
    /**
     * The HTTP status code.
     *
     * @var int
     */
    protected $statusCode;

    /**
     * Render an exception into a response.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function render($request)
    {
        return response()->json($this->toError()->toArray(), $this->statusCode);
    }
}
