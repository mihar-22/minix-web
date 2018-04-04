<?php

namespace Minix\Exchange\Maps\Providers;

use Minix\Exchange\Orders\OrderAttribute;
use Minix\Exchange\Orders\OrderStatus;
use Minix\Exchange\Platform;
use Minix\Exchange\Trades\TradeAttribute;
use Minix\Exchange\Trades\TradeLiquidity;

class Gdax extends AbstractProvider
{
    protected function getOrderMappingsArgs()
    {
        return [
            [OrderAttribute::REMOTE_ID, 'id'],
            [OrderAttribute::PRICE, 'price'],
            [OrderAttribute::SIZE, 'size'],
            [OrderAttribute::SIDE, 'side'],
            [OrderAttribute::TYPE, 'type'],
            [OrderAttribute::TIME_IN_FORCE, 'time_in_force'],
            [OrderAttribute::OPENED_AT, 'created_at'],
            [OrderAttribute::COMPLETED_AT, 'done_at'],
            [OrderAttribute::STATUS, ['status', 'done_reason'], 'mapOrderStatus'],
            [OrderAttribute::PRODUCT, 'product_id', 'mapProduct'],
        ];
    }

    protected function getTradeMappingsArgs()
    {
        return [
            [TradeAttribute::REMOTE_ID, 'id'],
            [TradeAttribute::PRICE, 'price'],
            [TradeAttribute::SIZE, 'size'],
            [TradeAttribute::FEE, 'fee'],
            [TradeAttribute::LIQUIDITY, 'liquidity', 'mapTradeLiquidity'],
            [TradeAttribute::SETTLED_AT, 'created_at'],
        ];
    }

    /**
     * @param string $status
     * @param string $doneReason
     *
     * @return string
     */
    protected function mapOrderStatus($status, $doneReason)
    {
        if ($doneReason) {
            return ($doneReason === 'cancelled') ? OrderStatus::CANCELLED : OrderStatus::FILLED;
        }

        return ($status === 'pending') ? OrderStatus::PENDING : OrderStatus::OPEN;
    }

    /**
     * @param string $liquidity
     *
     * @return string
     */
    protected function mapTradeLiquidity($liquidity)
    {
        return ($liquidity === 'M') ? TradeLiquidity::MAKER : TradeLiquidity::TAKER;
    }

    protected function splitRawProduct($id)
    {
        return explode('-', $id);
    }

    protected function getExchangeId()
    {
        return Platform::GDAX;
    }
}