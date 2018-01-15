<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Session\TokenMismatchException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class TokenMismatchException extends BaseException
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
    protected $statusCode = 419;

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
        return new Error('csrf_token_invalid', $this->previous->getMessage());
    }
}
