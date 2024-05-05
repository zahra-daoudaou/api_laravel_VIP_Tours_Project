<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours_hotels', function (Blueprint $table) {
            $table->id('id_tour_hotel');
            $table->integer('id_hotel');
            $table->foreign('id_hotel')->references('id_hotel')->on('hotels');
            $table->integer('id_tour');
            $table->foreign('id_tour')->references('id_tour')->on('tours');
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
        Schema::dropIfExists('tours_hotels');
    }
}
