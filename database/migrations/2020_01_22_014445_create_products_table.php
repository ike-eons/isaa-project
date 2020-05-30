<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('brand_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('description')->default('');
            $table->string('name')->unique();
            $table->integer('weight');
            $table->integer('carton_quantity');
            $table->decimal('stock_price', 8, 2)->nullable();
            $table->decimal('sales_price', 8, 2)->nullable();

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products');
    }
}
