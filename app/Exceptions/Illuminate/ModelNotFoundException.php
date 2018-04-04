<?php

namespace Minix\Exceptions\Illuminate;

use Illuminate\Database\Eloquent\ModelNotFoundException as IlluminateException;
use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;

class ModelNotFoundException extends BaseException
{
    protected $statusCode = 404;

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
        return new Error(
            'model_not_found',
            'The model could not be found.',
            $this->previous->getMessage()
        );
    }
}
