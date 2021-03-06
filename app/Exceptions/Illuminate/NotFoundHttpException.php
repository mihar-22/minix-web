<?php

namespace Minix\Exceptions\Illuminate;

use Minix\Exceptions\BaseException;
use Minix\Http\Errors\Error;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException as IlluminateException;

class NotFoundHttpException extends BaseException
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
            'invalid_route',
            'This route is not a valid endpoint.',
            $this->previous->getMessage()
        );
    }
}
