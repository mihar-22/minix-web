<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Auth\AuthenticationException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class AuthenticationException extends BaseException
{
    /**
     * The previous exception.
     *
     * @var IlluminateException
     */
    protected $previous;

    /**
     * The HTTP status code.
     *
     * @var int
     */
    protected $statusCode = 401;

    /**
     * @param IlluminateException $previous
     */
    public function __construct(IlluminateException $previous)
    {
        $this->previous = $previous;

        parent::__construct();
    }

    /**
     * @return Error
     */
    public function toError()
    {
        return new Error('unauthenticated', $this->previous->getMessage());
    }
}
