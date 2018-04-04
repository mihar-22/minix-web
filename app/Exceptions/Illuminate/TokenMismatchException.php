<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Session\TokenMismatchException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class TokenMismatchException extends BaseException
{
    protected $statusCode = 419;

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
        return new Error('csrf_token_invalid', $this->previous->getMessage());
    }
}
