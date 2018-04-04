<?php

namespace Minix\Auth\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Minix\Exchange\Models\ExchangeKey;
use Minix\Exchange\Models\Order;
use Minix\Uuid\Uuid;

/**
 * @property string                        $id
 * @property string                        $name
 * @property string                        $email
 * @property string                        $password
 * @property Carbon                        $created_at
 * @property Carbon                        $updated_at
 * @property-read Collection|ExchangeKey[] $exchangeKeys
 * @property-read Collection|Order[]       $orders
 */
class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public $incrementing = false;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::make($prefix = 'usr_');
        });
    }

    /**
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return HasMany|ExchangeKey
     */
    public function exchangeKeys()
    {
        return $this->hasMany(ExchangeKey::class);
    }

    /**
     * @return HasManyThrough|Order[]
     */
    public function orders()
    {
        return $this->hasManyThrough(Order::class, ExchangeKey::class);
    }
}
