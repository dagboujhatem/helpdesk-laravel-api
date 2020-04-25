<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('objet');
            $table->string('element');
            $table->string('nom');
            $table->string('date_d_ouverture');
            $table->string('date_d_echeance');
            $table->string('categorie');
            $table->string('impact');
            $table->string('etat');
            $table->string('departement')->nullable();
            $table->string('lieu')->nullable();
            $table->string('num_agence')->nullable();
            $table->string('commentaire')->nullable();
            $table->string('description');
            $table->string('file');
            $table->string('priorite')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
