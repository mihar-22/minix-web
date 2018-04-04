<?php

namespace Minix\Exchange\Models;

use Database\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string                                $id
 * @property string                                $name
 * @property-read Collection|ExchangeKey[]         $exchangeKeys
 * @property-read Collection|Product[]             $products
 * @property-read Collection|ExchangeCurrencyMap[] $currencyMaps
 */
class Exchange extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    /**
     * @return HasMany|ExchangeKey[]
     */
    public function exchangeKeys()
    {
        return $this->hasMany(ExchangeKey::class);
    }

    /**
     * @return BelongsToMany|Product[]
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsToMany|ExchangeCurrencyMap[]
     */
    public function currencyMaps()
    {
        return $this->belongsToMany(Currency::class, Table::EXCHANGE_CURRENCY_MAP)
            ->using(ExchangeCurrencyMap::class);
    }
}