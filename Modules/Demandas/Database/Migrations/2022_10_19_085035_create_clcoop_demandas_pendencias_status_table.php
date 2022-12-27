<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasPendenciasStatusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_pendencias_status', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('tipo_pendencia_id');
            $table->integer('status_id');
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
        Schema::drop('clcoop.demandas_pendencias_status');
    }
}
