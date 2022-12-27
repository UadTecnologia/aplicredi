<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Status extends BaseModel
{
    protected $table = 'clcoop.demandas_status';

    protected $fillable = [
        'nome',
        'mensagem_automatica',
        'ativo',
        'color',
        'peso',
        'pendencia',
        'fechaDemandaPendencia',
        'clcoop_id',
    ];
}
