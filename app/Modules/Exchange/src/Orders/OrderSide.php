<?php

namespace Minix\Exchange\Orders;

use Minix\Support\Enum;

class OrderSide extends Enum
{
    const BUY = 'buy';
    const SELL = 'sell';
}