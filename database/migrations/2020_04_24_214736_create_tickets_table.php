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
            $table->boolean('send_to_fournisseur')->default(false);
            $table->string('nouvelle_anomalie')->nullable();
            // l'etat de ticket est ce que relancer ou bien nouvelle ticket
            $table->boolean('ticket_status')->default(false);
            // ce champ est true si cette ticket est relancé
            $table->boolean('ticket_isRelanced')->default(false);
            // ticket created by
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
