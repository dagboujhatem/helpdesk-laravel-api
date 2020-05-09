<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMissionResponsesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nom');
            $table->string('collaborateurs');
            $table->string('mission');
            $table->string('date_debut');
            $table->string('date_fin');
            $table->text('reponse');
            $table->boolean('isConfirmed')->default(false);
            $table->integer('mission_id')->unsigned();
            $table->foreign('mission_id')
                ->references('id')->on('missions')
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
        Schema::drop('mission_responses');
    }
}
