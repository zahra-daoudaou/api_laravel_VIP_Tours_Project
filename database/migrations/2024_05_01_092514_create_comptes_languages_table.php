<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComptesLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comptes_languages', function (Blueprint $table) {
            $table->id('id_compte_language');
            $table->integer('id_compte');
            $table->foreign('id_compte')->references('id_compte')->on('comptes');
            $table->integer('id_language');
            $table->foreign('id_language')->references('id_language')->on('languages');
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
        Schema::dropIfExists('comptes_languages');
    }
}
