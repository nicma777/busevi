<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartureDayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departure_day', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('departure_id')->unsigned();
            $table->foreign('departure_id')->references('id')->on('departures');

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
        Schema::dropIfExists('departure_day');
    }
}
