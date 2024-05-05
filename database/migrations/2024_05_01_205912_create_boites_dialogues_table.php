<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoitesDialoguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boites_dialogues', function (Blueprint $table) {
            $table->id('id_dialogue');
            $table->string('contenue');
            $table->date('date_dialogue');
            $table->unsignedBigInteger('id_utilisateur');
            $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs');
            $table->unsignedBigInteger('id_guide');
            $table->foreign('id_guide')->references('id_guide')->on('guides');
            $table->unsignedBigInteger('id_message')->nullable();
            $table->timestamps();
        });
        
        Schema::table('boites_dialogues', function (Blueprint $table) {
            $table->foreign('id_message')->references('id_dialogue')->on('boites_dialogues');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boites_dialogues');
    }
}
