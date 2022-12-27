<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Anexo extends BaseModel
{
    protected $table = 'clcoop.demandas_anexos';

    protected $fillable = [
        'demanda_id',
        'arquivo',
        'nome',
        'user_id',
        'ano',
    ];
}
