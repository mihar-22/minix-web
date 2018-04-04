<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrenciesTable extends Migration
{
    public function up()
    {
        Schema::create(Table::CURRENCIES, function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('symbol')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(Table::CURRENCIES);
    }
}
