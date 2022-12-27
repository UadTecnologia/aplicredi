<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Tipo extends BaseModel
{
    protected $table = 'clcoop.demandas_tipos';

    protected $fillable = [
        'nome',
        'ativo',
    ];
}
