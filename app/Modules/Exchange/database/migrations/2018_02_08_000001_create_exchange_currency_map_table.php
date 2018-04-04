<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeCurrencyMapTable extends Migration
{
    public function up()
    {
        Schema::create(Table::EXCHANGE_CURRENCY_MAP, function (Blueprint $table) {
            $table->string('mapping');

            /**
             * Foreign Keys
             */
            $table->string('exchange_id')->index();
            $table->foreign('exchange_id')->references('id')->on(Table::EXCHANGES);

            $table->string('currency_id')->index();
            $table->foreign('currency_id')->references('id')->on(Table::CURRENCIES);
        });
    }

    public function down()
    {
        Schema::dropIfExists(Table::EXCHANGE_CURRENCY_MAP);
    }
}
