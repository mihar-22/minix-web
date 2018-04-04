<?php

namespace Minix\Exchange\Orders;

use Minix\Support\Enum;

class OrderStatus extends Enum
{
    const PENDING = 'pending';
    const OPEN = 'open';
    const PARTIALLY_FILLED = 'partially_filled';
    const FILLED = 'filled';
    const CANCELLED = 'cancelled';
    const EXPIRED = 'expired';
}