<?php

namespace Minix\Exchange\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string                     $id
 * @property-read Currency              $baseCurrency
 * @property-read Currency              $quoteCurrency
 * @property-read Collection|Order[]    $orders
 * @property-read Collection|Exchange[] $exchanges
 */
class Product extends Model
{
    public $incrementing = false;

    public $timestamps = false;

    /**
     * @return BelongsTo|Currency
     */
    public function baseCurrency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return BelongsTo|Currency
     */
    public function quoteCurrency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return HasMany|Order[]
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return BelongsToMany|Exchange[]
     */
    public function exchanges()
    {
        return $this->belongsToMany(Exchange::class);
    }
}