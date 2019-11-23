<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQrcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qrcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website')->nullable();
            $table->unsignedBigInteger('hallticket_id')->index();
            $table->string('student_name');
            $table->string('student_index_number');
            $table->string('qrcode_path')->nullable();

            $table->foreign('hallticket_id')->references('id')->on('halltickets');
            
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
        Schema::dropIfExists('qrcodes');
    }
}
