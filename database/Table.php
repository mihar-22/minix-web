<?php

namespace Database;

use Minix\Support\Enum;

class Table extends Enum
{
    /**
     * Database table names.
     */

    /**
     * Auth Module
     */
    const USERS = 'users';
    const PASSWORD_RESETS = 'password_resets';

    /**
     * Exchange Module
     */
    const EXCHANGES = 'exchanges';
    const EXCHANGE_KEYS = 'exchange_keys';
    const CURRENCIES = 'currencies';
    const PRODUCTS = 'products';
    const ORDERS = 'orders';
    const TRADES = 'trades';
    const EXCHANGE_PRODUCT = 'exchange_product';
    const EXCHANGE_CURRENCY_MAP = 'exchange_currency_map';
}