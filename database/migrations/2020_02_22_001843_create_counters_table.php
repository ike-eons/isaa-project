<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Counter;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key')->unique();
            $table->string('prefix');
            $table->string('value');
            $table->timestamps();
        });

        Counter::create([
            'key' => 'stock',
            'prefix' => 'EMJ10-',
            'value' => 1000
        ]);

        Counter::create([
            'key' => 'invoice',
            'prefix' => 'INV-',
            'value' => 1000
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('counters');
    }
}
