<?php

namespace Minix\Support\Tests\Fake;

use Minix\Support\ModelAttribute;

class FakeModelAttribute extends ModelAttribute
{
    const ONE = 'one';
    const RELATION_ONE = 'relation_one';
    const RELATION_TWO = 'relation_two';

    public static $relations = [
        self::RELATION_ONE,
        self::RELATION_TWO,
    ];
}