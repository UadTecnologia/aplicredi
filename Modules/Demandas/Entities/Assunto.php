<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Assunto extends BaseModel
{
    protected $table = 'clcoop.demandas_assuntos';

    protected $fillable = [
        'nome',
        'ativo',
        'prioridade_id',
        'servicos_assunto_id',
        'credito_assunto_id',
        'lista',
        'nivel'
    ];
}
