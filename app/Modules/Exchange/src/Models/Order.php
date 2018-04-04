<?php

namespace Minix\Exchange\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Minix\Uuid\Uuid;

/**
 * @property string                  $id
 * @property string                  $remote_id
 * @property double                  $price
 * @property double                  $size
 * @property double|null             $total_fee
 * @property string                  $side
 * @property string                  $type
 * @property string                  $time_in_force
 * @property Carbon|null             $opened_at
 * @property Carbon|null             $completed_at
 * @property string                  $status
 * @property Carbon                  $created_at
 * @property Carbon                  $updated_at
 * @property-read ExchangeKey        $exchangeKey
 * @property-read Product            $product
 * @property-read Collection|Trade[] $trades
 */
class Order extends Model
{
    public $incrementing = false;

    protected $dates = ['opened_at', 'completed_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::make($prefix = 'ord_');
        });
    }

    /**
     * @return BelongsTo|ExchangeKey
     */
    public function exchangeKey()
    {
        return $this->belongsTo(ExchangeKey::class);
    }

    /**
     * @return BelongsTo|Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return HasMany|Trade[]
     */
    public function trades()
    {
        return $this->hasMany(Trade::class);
    }
}