<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasPrioridadesSetoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_prioridades_setores', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('setor_id');
            $table->integer('prioridade_id');
            $table->integer('minutos');
            $table->integer('subsetor_id')->nullable();
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
        Schema::drop('clcoop.demandas_prioridades_setores');
    }
}
