<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class AvaliacaoTipo extends BaseModel
{
    protected $table = 'clcoop.demandas_avaliacoes_tipos';

    protected $fillable = [
        'nome',
        'peso',
        'ativo',
    ];
}
