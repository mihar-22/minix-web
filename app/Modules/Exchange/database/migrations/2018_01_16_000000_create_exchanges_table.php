<?php

use Database\Table;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Minix\Exchange\Platform;

class CreateExchangesTable extends Migration
{
    public function up()
    {
        $this->createTable();
        $this->insertExchanges();
    }

    public function createTable()
    {
        Schema::create(Table::EXCHANGES, function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
        });
    }

    public function insertExchanges()
    {
        DB::table(Table::EXCHANGES)->insert(array_map(function ($id) {
            return ['id' => $id, 'name' => Platform::$name[$id]];
        }, Platform::values()));
    }

    public function down()
    {
        Schema::dropIfExists(Table::EXCHANGES);
    }
}
