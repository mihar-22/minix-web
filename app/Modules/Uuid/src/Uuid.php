<?php

namespace Minix\Uuid;

use Ramsey\Uuid\Uuid as UuidFactory;

class Uuid
{
    /**
     * Generate and return a uuid4 string with a given prefix.
     *
     * @param string $prefix
     *
     * @return string
     */
    public static function make($prefix = '')
    {
        return (string) $prefix.strtolower(UuidFactory::uuid4());
    }
}
