<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasAvaliacoesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_avaliacoes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('demanda_id');
            $table->integer('user_id');
            $table->integer('setor_id');
            $table->integer('tipo_avaliacao_id');
            $table->integer('avaliado_user_id');
            $table->decimal('peso', 10);
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
        Schema::drop('clcoop.demandas_avaliacoes');
    }
}
