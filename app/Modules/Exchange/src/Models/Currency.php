<?php

namespace Minix\Exchange\Models;

use Database\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string                                $id
 * @property string                                $name
 * @property string|null                           $symbol
 * @property-read Collection|ExchangeCurrencyMap[] $exchangeMaps
 */
class Currency extends Model
{
    /**
     * The identifier prefix for fiat currencies.
     *
     * @var string
     */
    public static $fiatPrefix = 'F-';

    /**
     * The identifier prefix for crypto currencies.
     *
     * @var string
     */
    public static $cryptoPrefix = 'C-';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * @return bool
     */
    public function isFiat()
    {
        return $this->id[0] === 'F';
    }

    /**
     * Scope a query to only include fiat currencies.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeFiat($query)
    {
        return $query->where('id', 'like', 'F%');
    }

    /**
     * Scope a query to only include crypto currencies.
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeCrypto($query)
    {
        return $query->where('id', 'like', 'C%');
    }

    /**
     * @return HasMany|Product[]
     */
    public function baseProducts()
    {
        return $this->hasMany(Product::class, 'base_currency_id');
    }

    /**
     * @return HasMany|Product[]
     */
    public function quoteProducts()
    {
        return $this->hasMany(Product::class, 'quote_currency_id');
    }

    /**
     * @return BelongsToMany|ExchangeCurrencyMap[]
     */
    public function exchangeMaps()
    {
        return $this->belongsToMany(Exchange::class, Table::EXCHANGE_CURRENCY_MAP)
            ->using(ExchangeCurrencyMap::class);
    }

    /**
     * Save the model to the database with the fiat or crypto prefix.
     *
     * @param bool  $isFiat
     * @param array $options
     */
    public function saveWithPrefix($isFiat = false, $options = [])
    {
        $this->id = $isFiat ? self::$fiatPrefix.$this->id : self::$cryptoPrefix.$this->id;

        $this->save($options);
    }
}
