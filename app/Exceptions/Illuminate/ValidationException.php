<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Validation\ValidationException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class ValidationException extends BaseException
{
    /**
     * The previous exception.
     *
     * @param IlluminateException
     */
    protected $previous;

    /**
     * The HTTP status code.
     *
     * @var int
     */
    protected $statusCode = 422;

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
        return new Error(
            'validation_failed',
            $this->previous->getMessage(),
            'Check the `errors` field for more information.',
            $this->previous->errors()
        );
    }
}
