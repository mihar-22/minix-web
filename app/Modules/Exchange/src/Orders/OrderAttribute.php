<?php

namespace Minix\Exchange\Orders;

use Minix\Support\ModelAttribute;

class OrderAttribute extends ModelAttribute
{
    const ID = 'id';
    const REMOTE_ID = 'remote_id';
    const PRICE = 'price';
    const SIZE = 'size';
    const SIDE = 'side';
    const TYPE = 'type';
    const TIME_IN_FORCE = 'time_in_force';
    const OPENED_AT = 'opened_at';
    const COMPLETED_AT = 'completed_at';
    const STATUS = 'status_id';
    const TOTAL_FEE = 'total_fee';
    const PRODUCT = 'product';
    const EXCHANGE_KEY = 'exchange_key';

    public static $relations = [
        self::PRODUCT,
        self::EXCHANGE_KEY,
    ];
}