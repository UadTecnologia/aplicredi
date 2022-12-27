<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasCamposDisponiveisTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_campos_disponiveis', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('descricao');
            $table->string('grid', 45);
            $table->string('componente');
            $table->boolean('ativo')->default(1);
            $table->integer('ordem')->nullable();
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
        Schema::drop('clcoop.demandas_campos_disponiveis');
    }
}
