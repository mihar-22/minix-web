<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Minix\Exchange\Trades\TradeAttribute;

class CreateTradesTable extends Migration
{
    public function up()
    {
        Schema::create(Table::TRADES, function (Blueprint $table) {
            $table->char('id', 40)->primary();
            $table->string(TradeAttribute::REMOTE_ID)->unique()->index();
            $table->decimal(TradeAttribute::PRICE, 10, 8);
            $table->decimal(TradeAttribute::SIZE, 10, 8);
            $table->decimal(TradeAttribute::FEE, 10, 8);
            $table->char(TradeAttribute::LIQUIDITY, 1);
            $table->timestamp(TradeAttribute::SETTLED_AT);
            $table->timestamps();

            /**
             * Foreign Keys
             */
            $orderColumn = TradeAttribute::toForeignKey(TradeAttribute::ORDER);
            $table->char($orderColumn, 40);
            $table->foreign($orderColumn)->references('id')->on(Table::ORDERS)->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists(Table::TRADES);
    }
}
