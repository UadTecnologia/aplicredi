<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Interacao extends BaseModel
{
    protected $table = 'clcoop.demandas_interacoes';

    protected $fillable = [
        'demanda_id',
        'user_id',
        'setor_id',
        'descricao',
        'pendencia',
        'status_id'
    ];
}
