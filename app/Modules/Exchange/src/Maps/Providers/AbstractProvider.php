<?php

namespace Minix\Exchange\Maps\Providers;

use Minix\Exchange\Maps\Mapping;
use Minix\Exchange\Maps\Provider;
use Minix\Exchange\Models\Currency;
use Minix\Exchange\Models\Exchange;
use Minix\Exchange\Models\Order;
use Minix\Exchange\Models\Product;
use Minix\Exchange\Models\Trade;
use Minix\Exchange\Orders\OrderAttribute;
use Minix\Exchange\Platform;
use Minix\Exchange\Trades\TradeAttribute;

abstract class AbstractProvider implements Provider
{
    /**
     * The exchange the mapping is for.
     *
     * @var Exchange
     */
    protected $exchange;

    /**
     * @var Currency
     */
    protected $currencies;

    /**
     * @var Product
     */
    protected $products;

    /**
     * @var array
     */
    protected $orderMappings;

    /**
     * @var array
     */
    protected $tradeMappings;

    /**
     * @param Currency $currencies
     * @param Product  $products
     */
    public function __construct(Currency $currencies, Product $products)
    {
        $this->currencies = $currencies;
        $this->products = $products;
    }

    public function mapCurrency($currency)
    {
        // try to return from cache/db using mapping

        // try to get from cache/db using id

        throw new \InvalidArgumentException($currency.' is not currently a supported currency.');
    }

    public function mapProduct($product)
    {
        // try to get product from cache

        // try to get from db and store in cache

        // map currencies
        list($base, $quote) = $this->splitRawProduct($product);

        // build product and save

        // store in cache
    }

    public function mapOrder(array $order)
    {
        $attributes = [];
        $relations = [];

        foreach (OrderAttribute::values() as $attribute) {
            $mapping = $this->getOrderMapping($attribute);
            $key = $mapping->attribute;
            $value = $mapping->execute($order);

            OrderAttribute::isRelation($attribute) ?
                $relations[$key] = $value :
                $attributes[$key] = $value;
        }

        return Order::make($attributes)->setRelations($relations);
    }

    public function mapTrade(array $trade)
    {
        $attributes = [];
        $relations = [];

        foreach (TradeAttribute::values() as $attribute) {
            $mapping = $this->getTradeMapping($attribute);
            $key = $mapping->attribute;
            $value = $mapping->execute($trade);

            TradeAttribute::isRelation($attribute) ?
                $relations[$key] = $value :
                $attributes[$key] = $value;
        }

        return Trade::make($attributes)->setRelations($relations);
    }

    /**
     * @return Exchange
     */
    protected function getExchange()
    {
        if ($this->exchange) {
            return $this->exchange;
        }

        // try to get from cache

        // try to get from db and cache it
    }

    public function getOrderMapping($attribute)
    {
        if (!OrderAttribute::exists($attribute)) {
            throw new \InvalidArgumentException($attribute.' is not a valid Order attribute.');
        }

        if (!$this->orderMappings) {
            $this->orderMappings = $this->makeMappings($this->getOrderMappingsArgs());
        }

        return $this->orderMappings[$attribute];
    }

    public function getTradeMapping($attribute)
    {
        if (!TradeAttribute::exists($attribute)) {
            throw new \InvalidArgumentException($attribute.' is not a valid Trade attribute.');
        }

        if (!$this->tradeMappings) {
            $this->tradeMappings = $this->makeMappings($this->getTradeMappingsArgs());
        }

        return $this->tradeMappings[$attribute];
    }

    /**
     * Get nested arrays of arguments to create mappings.
     *
     * @return array
     */
    abstract protected function getOrderMappingsArgs();

    /**
     * Get nested arrays of arguments to create a mappings.
     *
     * @return array
     */
    abstract protected function getTradeMappingsArgs();

    /**
     * Given a raw product string (Eg: BTC/USD) from an exchange, it is split up into it's base
     * and quote currency identifiers (Eg: [BTC, USD]).
     *
     * @param string $id
     *
     * @return array
     */
    abstract protected function splitRawProduct($id);

    /**
     * Get the exchange identifier.
     *
     * @return string
     *
     * @see Platform
     */
    abstract protected function getExchangeId();

    /**
     * Make the Mapping instances given a nested array of arguments and store it in an associative
     * array with the key set to the respective Mapping attribute.
     *
     * @param array $argumentSets
     *
     * @return array
     */
    private function makeMappings(array $argumentSets)
    {
        $mappings = [];

        foreach ($argumentSets as $arguments) {
            $attribute = $arguments[0];
            $key = isset($arguments[1]) ? $arguments[1] : null;
            $callback = isset($arguments[2]) ? [$this, $arguments[2]] : null;

            $mappings[$attribute] = Mapping::make($attribute, $key, $callback);
        }

        return $mappings;
    }
}