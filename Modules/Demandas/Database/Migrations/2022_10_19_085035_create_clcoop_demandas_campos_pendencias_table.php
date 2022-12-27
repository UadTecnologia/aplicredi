<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasCamposPendenciasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_campos_pendencias', function (Blueprint $table) {
            $table->smallInteger('id');
            $table->integer('pendencia_id');
            $table->integer('campo_id');
            $table->integer('ordem')->nullable();
            $table->boolean('required')->nullable()->default(0);
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
        Schema::drop('clcoop.demandas_campos_pendencias');
    }
}
