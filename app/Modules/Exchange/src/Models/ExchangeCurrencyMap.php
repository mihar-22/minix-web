<?php

namespace Minix\Exchange\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @property string        $mapping
 * @property-read Exchange $exchange
 * @property-read Currency $currency
 */
class ExchangeCurrencyMap extends Pivot
{
}