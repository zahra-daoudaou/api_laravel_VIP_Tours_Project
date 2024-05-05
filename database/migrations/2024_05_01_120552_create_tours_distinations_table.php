<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursDistinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours_distinations', function (Blueprint $table) {
            $table->id('id_tour_distination');
            $table->integer('id_tour');
            $table->foreign('id_tour')->references('id_tour')->on('tours');
            $table->integer('id_distination');
            $table->foreign('id_distination')->references('id_distination')->on('distinations');
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
        Schema::dropIfExists('tours_distinations');
    }
}
