<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Validation\ValidationException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class ValidationException extends BaseException
{
    protected $statusCode = 422;

    /**
     * The previous exception.
     *
     * @param IlluminateException
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
        return new Error(
            'validation_failed',
            $this->previous->getMessage(),
            'Check the `errors` field for more information.',
            $this->previous->errors()
        );
    }
}
