<?php

namespace Minix\Exchange\Maps;

interface Factory
{
    /**
     * Get a Map provider implementation.
     *
     * @param string|null $driver
     *
     * @return Provider
     */
    public function driver($driver = null);
}