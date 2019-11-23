<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClearancevalidatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clearancevalidators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('fee',5,2)->unsigned()->default(0.00);
            $table->decimal('attendance',3,2)->unsigned()->default(0.00);
            $table->boolean('library')->default(0);
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
        Schema::dropIfExists('clearancevalidators');
    }
}
