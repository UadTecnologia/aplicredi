<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Prioridade extends BaseModel
{
    protected $table = 'clcoop.demandas_prioridades';

    protected $fillable = [
        'nome',
        'minutos',
        'ativo',
    ];
}
