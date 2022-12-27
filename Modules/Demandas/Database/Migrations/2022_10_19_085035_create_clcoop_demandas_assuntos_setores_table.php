<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasAssuntosSetoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_assuntos_setores', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('setor_id');
            $table->integer('subsetor_id')->nullable();
            $table->integer('assunto_id');
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
        Schema::drop('clcoop.demandas_assuntos_setores');
    }
}
