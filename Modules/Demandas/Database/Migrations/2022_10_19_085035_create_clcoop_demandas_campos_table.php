<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasCamposTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_campos', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('campo_assunto_id')->index('demandas_campos_campo_id');
            $table->integer('demanda_id')->index('demandas_campos_demanda_id');
            $table->text('valor')->nullable();
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
        Schema::drop('clcoop.demandas_campos');
    }
}
