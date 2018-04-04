<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Auth\Access\AuthorizationException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class AuthorizationException extends BaseException
{
    protected $statusCode = 403;

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
        return new Error('unauthorized', $this->previous->getMessage());
    }
}
