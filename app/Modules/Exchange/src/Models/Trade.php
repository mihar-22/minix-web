<?php

namespace Minix\Exchange\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Minix\Uuid\Uuid;

/**
 * @property string     $id
 * @property string     $remote_id
 * @property double     $price
 * @property double     $size
 * @property double     $fee
 * @property string     $liquidity
 * @property Carbon     $settled_at
 * @property Carbon     $created_at
 * @property Carbon     $updated_at
 * @property-read Order $order
 */
class Trade extends Model
{
    public $incrementing = false;

    protected $dates = ['settled_at'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::make($prefix = 'trd_');
        });
    }

    /**
     * @return BelongsTo|Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}