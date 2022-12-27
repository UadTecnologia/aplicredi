<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasAvaliacoesTiposTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_avaliacoes_tipos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome');
            $table->decimal('peso', 10);
            $table->text('justificativa')->nullable();
            $table->boolean('ativo')->default(1);
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
        Schema::drop('clcoop.demandas_avaliacoes_tipos');
    }
}
