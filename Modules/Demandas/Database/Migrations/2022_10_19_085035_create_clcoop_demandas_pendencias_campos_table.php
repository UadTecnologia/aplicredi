<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasPendenciasCamposTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_pendencias_campos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('campo_pendencia_id')->index('demandas_campos_campo_id_copy');
            $table->string('valor');
            $table->integer('demanda_id')->index('demandas_campos_demanda_id_copy');
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
        Schema::drop('clcoop.demandas_pendencias_campos');
    }
}
