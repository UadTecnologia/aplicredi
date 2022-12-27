<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class PrioridadeSetor extends BaseModel
{
    protected $table = 'clcoop.demandas_prioridades_setores';

    protected $fillable = [
        'setor_id',
        'prioridade_id',
        'minutos',
    ];
}
