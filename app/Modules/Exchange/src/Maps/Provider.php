<?php

namespace Minix\Exchange\Maps;

use Minix\Exchange\Models\Currency;
use Minix\Exchange\Models\Order;
use Minix\Exchange\Models\Product;
use Minix\Exchange\Models\Trade;

interface Provider
{
    /*
    |--------------------------------------------------------------------------
    | Map Provider
    |--------------------------------------------------------------------------
    |
    | A Map provider implementation class takes JSON encoded objects from exchanges and "maps"
    | them to a Minix model.
    |
    */

    /**
     * @param string $currency
     *
     * @return Currency
     *
     * @throws \InvalidArgumentException
     */
    public function mapCurrency($currency);

    /**
     * @param string $product
     *
     * @return Product
     *
     * @throws \InvalidArgumentException
     */
    public function mapProduct($product);

    /**
     * @param string $attribute
     *
     * @return Mapping
     *
     * @throws \InvalidArgumentException
     */
    public function getOrderMapping($attribute);

    /**
     * @param string $attribute
     *
     * @return Mapping
     *
     * @throws \InvalidArgumentException
     */
    public function getTradeMapping($attribute);

    /**
     * @param array $order
     *
     * @return Order
     */
    public function mapOrder(array $order);

    /**
     * @param array $trade
     *
     * @return Trade
     */
    public function mapTrade(array $trade);
}