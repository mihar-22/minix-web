<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Auth\AuthenticationException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class AuthenticationException extends BaseException
{
    protected $statusCode = 401;

    /**
     * The previous exception.
     *
     * @var IlluminateException
     */
    protected $previous;

    /**
     * @param IlluminateException $previous
     */
    public function __construct(IlluminateException $previous)
    {
        $this->previous = $previous;

        parent::__construct();
    }

    public function toError()
    {
        return new Error('unauthenticated', $this->previous->getMessage());
    }
}
