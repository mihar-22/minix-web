<?php

namespace Minix\Exchange\Orders;

use Minix\Support\Enum;

class OrderType extends Enum
{
    const LIMIT = 'limit';
    const LIMIT_MAKER = 'limit_maker';
    const MARKET = 'market';
    const STOP = 'stop';
    const STOP_LIMIT = 'stop_limit';
    const TAKE = 'take_profit';
    const TAKE_LIMIT = 'take_limit';
}