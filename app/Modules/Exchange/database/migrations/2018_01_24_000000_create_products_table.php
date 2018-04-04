<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create(Table::PRODUCTS, function (Blueprint $table) {
            $table->string('id')->primary();

            /**
             * Foreign Keys
             */
            $table->string('base_currency_id');
            $table->foreign('base_currency_id')->references('id')->on(Table::CURRENCIES);

            $table->string('quote_currency_id');
            $table->foreign('quote_currency_id')->references('id')->on(Table::CURRENCIES);
        });
    }

    public function down()
    {
        Schema::dropIfExists(Table::PRODUCTS);
    }
}