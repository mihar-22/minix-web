<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Minix\Exchange\Models\Currency;

class AddCryptoCurrencies extends Migration
{
    public function up()
    {
        $map = function ($currency) {
            return array_merge($currency, [
                'id' => (Currency::$cryptoPrefix).$currency['id'],
            ]);
        };

        DB::table(Table::CURRENCIES)->insert(array_map($map, [
            [
                'id' => 'BTC',
                'name' => 'Bitcoin',
                'symbol' => '₿',
            ],
            [
                'id' => 'BCH',
                'name' => 'Bitcoin Cash',
                'symbol' => '₿',
            ],
            [
                'id' => 'ETH',
                'name' => 'Ethereum',
                'symbol' => 'Ξ',
            ],
            [
                'id' => 'LTC',
                'name' => 'Litecoin',
                'symbol' => 'Ł',
            ],
        ]));
    }

    public function down()
    {
        // no-op
    }
}
