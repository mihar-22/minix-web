<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Auth\Access\AuthorizationException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class AuthorizationException extends BaseException
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
    protected $statusCode = 403;

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
        return new Error('unauthorized', $this->previous->getMessage());
    }
}
