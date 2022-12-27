<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClcoopDemandasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clcoop.demandas', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->index('idx_demandas_users');
            $table->integer('setor_id');
            $table->integer('status_id')->index('idx_demandas_status');
            $table->integer('assunto_id')->index('idx_demandas_assunto');
            $table->integer('solicitado_setor_id');
            $table->integer('tipo_id')->index('idx_demandas_tipos');
            $table->dateTime('created_at_old')->nullable();
            $table->integer('pa_id')->index('idx_demandas_pa_id');
            $table->integer('solicitado_pa_id')->index('idx_demandas_pa_solicitado_id');
            $table->dateTime('inicio_atendimento')->nullable();
            $table->dateTime('fim_atendimento')->nullable();
            $table->time('horas_trabalhadas')->nullable();
            $table->integer('minutos')->nullable();
            $table->integer('tipo_pendencia_id')->nullable();
            $table->integer('operador_pa_id')->nullable();
            $table->string('titulo', 500)->nullable()->index('idx_tsvtitulo_demandas');
            $table->text('descricao')->nullable();
            $table->integer('subsetor_id')->nullable();
            $table->integer('ultima_interacao')->default(1)->comment('Quando 1 a ultima interação foi do mesmo setor, quando foir 0 a interação partiu de outra área.');
            $table->integer('atendido_por')->nullable();
            $table->integer('ultima_interacao_solicitante')->nullable();
            $table->index(['user_id','assunto_id','solicitado_setor_id','solicitado_pa_id'], 'idx_demandas_2');
            $table->index(['assunto_id','solicitado_setor_id','solicitado_pa_id'], 'idx_demandas_1');
            $table->index(['status_id','tipo_id'], 'status_id_tipo_id_demandas_idx');
            $table->index(['status_id','pa_id','solicitado_pa_id'], 'solicitado_pa_id_pa_id_status_id_idx_demandas');
            $table->index(['solicitado_setor_id','solicitado_pa_id','created_at'], 'idx_demandas_3');
            $table->index(['user_id','assunto_id','solicitado_setor_id','solicitado_pa_id','created_at'], 'idx_demandas_5');
            $table->index(['id','user_id','assunto_id','solicitado_setor_id','solicitado_pa_id','created_at'], 'idx_demandas_6');
            $table->index(['id','assunto_id','solicitado_setor_id','solicitado_pa_id'], 'idx_demandas_7');
            $table->index(['id','solicitado_setor_id','solicitado_pa_id'], 'idx_demandas_4');
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
        Schema::drop('clcoop.demandas');
    }
}
