<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasAnexosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_anexos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('demanda_id');
            $table->text('arquivo');
            $table->string('nome');
            $table->integer('user_id');
            $table->integer('ano')->nullable();
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
        Schema::drop('clcoop.demandas_anexos');
    }
}
