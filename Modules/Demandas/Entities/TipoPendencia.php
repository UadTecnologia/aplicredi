<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class TipoPendencia extends BaseModel
{
    protected $table = 'clcoop.demandas_tipos_pendencias';

    protected $fillable = [
        'nome',
        'ativo',
    ];
}
