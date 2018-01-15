<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Database\Eloquent\ModelNotFoundException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class ModelNotFoundException extends BaseException
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
    protected $statusCode = 404;

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
            'model_not_found',
            'The model could not be found.',
            $this->previous->getMessage()
        );
    }
}
