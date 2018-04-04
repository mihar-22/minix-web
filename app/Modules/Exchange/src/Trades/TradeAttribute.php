<?php

namespace Minix\Exchange\Trades;

use Minix\Support\ModelAttribute;

class TradeAttribute extends ModelAttribute
{
    const ID = 'id';
    const REMOTE_ID = 'remote_id';
    const PRICE = 'price';
    const SIZE = 'size';
    const FEE = 'fee';
    const LIQUIDITY = 'liquidity';
    const SETTLED_AT = 'settled_at';
    const ORDER = 'order';

    public static $relations = [
        self::ORDER,
    ];
}