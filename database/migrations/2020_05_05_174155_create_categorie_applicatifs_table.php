<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategorieApplicatifsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorie_applicatifs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('probleme');
            $table->string('description');
            $table->string('solution_file');
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
        Schema::drop('categorie_applicatifs');
    }
}
