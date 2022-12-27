<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasStatusTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas_status', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nome');
            $table->text('mensagem_automatica')->nullable();
            $table->boolean('ativo')->default(1);
            $table->string('color')->nullable();
            $table->smallInteger('peso')->nullable();
            $table->boolean('pendencia')->nullable()->default(0);
            $table->boolean('fechaDemandaPendencia')->nullable()->default(0);
            $table->integer('clcoop_id')->nullable();
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
        Schema::drop('clcoop.demandas_status');
    }
}
