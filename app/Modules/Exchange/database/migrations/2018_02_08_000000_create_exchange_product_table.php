<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangeProductTable extends Migration
{
    public function up()
    {
        Schema::create(Table::EXCHANGE_PRODUCT, function (Blueprint $table) {
            $table->string('exchange_id')->index();
            $table->foreign('exchange_id')->references('id')->on(Table::EXCHANGES);

            $table->string('product_id')->index();
            $table->foreign('product_id')->references('id')->on(Table::PRODUCTS);
        });
    }

    public function down()
    {
        Schema::dropIfExists(Table::EXCHANGE_PRODUCT);
    }
}
