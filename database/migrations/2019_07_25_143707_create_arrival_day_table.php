<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArrivalDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arrival_day', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('arrival_id')->unsigned();
            $table->foreign('arrival_id')->references('id')->on('arrivals');

            $table->integer('day_id')->unsigned()->nullable();
            $table->foreign('day_id')->references('id')->on('days');
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
        Schema::dropIfExists('arrival_day');
    }
}
