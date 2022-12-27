<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Avaliacao extends BaseModel
{
    protected $table = 'clcoop.demandas_avaliacoes';

    protected $fillable = [
        'demanda_id',
        'user_id',
        'setor_id',
        'tipo_avaliacao_id',
        'peso',
        'avaliado_user_id',
        'justificativa',
    ];
}
