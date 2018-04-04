<?php

namespace Minix\Exchange\Markets;

class MarketManager
{
    public function getDefaultDriver()
    {
        // return global driver??

        throw new \InvalidArgumentException('No Market driver was specified.');
    }
}