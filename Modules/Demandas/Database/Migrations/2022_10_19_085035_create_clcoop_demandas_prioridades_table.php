<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasPrioridadesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_prioridades', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome');
            $table->integer('minutos');
            $table->boolean('ativo')->default(1);
            $table->string('color')->nullable();
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
        Schema::drop('clcoop.demandas_prioridades');
    }
}
