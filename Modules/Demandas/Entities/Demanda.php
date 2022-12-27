<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Demanda extends BaseModel
{
    protected $table = 'clcoop.demandas';

    protected $fillable = [
        'id',
        'user_id',
        'setor_id',
        'status_id',
        'assunto_id',
        'solicitado_setor_id',
        'tipo_id',
        'descricao',
        'created_at_old',
        'pa_id',
        'solicitado_pa_id',
        'inicio_atendimento',
        'fim_atendimento',
        'horas_trabalhadas',
        'minutos',
        'tipo_pendencia_id',
        'operador_pa_id',
        'created_at',
        'updated_at',
        'titulo',
        'subsetor_id',
        'ultima_interacao',
        'atendido_por',
        'ultima_interacao_solicitante',
        'demanda_id_replicada',
    ];
}
