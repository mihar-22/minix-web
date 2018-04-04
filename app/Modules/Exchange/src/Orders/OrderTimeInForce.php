<?php

namespace Minix\Exchange\Orders;

use Minix\Support\Enum;

class OrderTimeInForce extends Enum
{
    const GOOD_TILL_CANCELLED = 'GTC';
    const GOOD_TILL_TIME = 'GTT';
    const IMMEDIATE_OR_CANCELLED = 'IOC';
    const FILL_OR_KILL = 'FOK';
}
