<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number')->unique();
            $table->string('reference')->nullable();
            $table->integer('distributor_id')->unsigned()->default(1);
            $table->date('date');
            $table->double('total',8,2);
            $table->timestamps();
        });

        Schema::create('stock_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('stock_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->double('unit_price');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
