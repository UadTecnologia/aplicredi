<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasInteracoesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_interacoes', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('demanda_id')->index('idx_interacao_demanda_id');
            $table->integer('user_id');
            $table->integer('setor_id');
            $table->text('descricao');
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
        Schema::drop('clcoop.demandas_interacoes');
    }
}
