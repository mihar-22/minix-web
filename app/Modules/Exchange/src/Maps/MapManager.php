<?php

namespace Minix\Exchange\Maps;

use Illuminate\Support\Manager;

class MapManager extends Manager implements Factory
{
    public function createGdaxDriver()
    {
    }

    public function getDefaultDriver()
    {
        throw new \InvalidArgumentException('No Mapping driver was specified.');
    }
}