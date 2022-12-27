<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasCamposAssuntosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_campos_assuntos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('assunto_id');
            $table->integer('campo_id');
            $table->boolean('ativo')->default(1);
            $table->integer('ordem')->nullable();
            $table->boolean('required')->nullable();
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
        Schema::drop('clcoop.demandas_campos_assuntos');
    }
}
