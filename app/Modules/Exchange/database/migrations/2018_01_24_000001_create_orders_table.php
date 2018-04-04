<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Minix\Exchange\Orders\OrderAttribute;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create(Table::ORDERS, function (Blueprint $table) {
            $table->char(OrderAttribute::ID, 40)->primary();
            $table->string(OrderAttribute::REMOTE_ID)->unique()->index();
            $table->decimal(OrderAttribute::PRICE, 10, 8);
            $table->decimal(OrderAttribute::SIZE, 10, 8);
            $table->decimal(OrderAttribute::TOTAL_FEE, 10, 8)->nullable();
            $table->char(OrderAttribute::SIDE, 3);
            $table->string(OrderAttribute::TYPE);
            $table->string(OrderAttribute::TIME_IN_FORCE);
            $table->timestamp(OrderAttribute::OPENED_AT)->nullable();
            $table->timestamp(OrderAttribute::COMPLETED_AT)->nullable();
            $table->string(OrderAttribute::STATUS);
            $table->timestamps();

            /**
             * Foreign Keys
             */
            $exchangeKeyColumn = OrderAttribute::toForeignKey(OrderAttribute::EXCHANGE_KEY);
            $table->string($exchangeKeyColumn);
            $table->foreign($exchangeKeyColumn)->references('id')
                ->on(Table::EXCHANGE_KEYS)->onDelete('cascade');

            $productColumn = OrderAttribute::toForeignKey(OrderAttribute::PRODUCT);
            $table->string($productColumn);
            $table->foreign($productColumn)->references('id')->on(Table::PRODUCTS);
        });
    }

    public function down()
    {
        Schema::dropIfExists(Table::ORDERS);
    }
}

