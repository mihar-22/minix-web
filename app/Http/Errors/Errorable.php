<?php

namespace Minix\Http\Errors;

interface Errorable
{
    /**
     * Create an Error that represents the object.
     *
     * @return Error
     */
    public function toError();
}
