<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours_transports', function (Blueprint $table) {
            $table->id('id_tour_transport');
            $table->integer('id_tour');
            $table->foreign('id_tour')->references('id_tour')->on('tours');
            $table->integer('id_transport');
            $table->foreign('id_transport')->references('id_transport')->on('transports');
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
        Schema::dropIfExists('tours_transports');
    }
}
