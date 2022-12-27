<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class AssuntoSetor extends BaseModel
{
    protected $table = 'clcoop.demandas_assuntos_setores';

    protected $fillable = [
        'setor_id',
        'subsetor_id',
        'assunto_id',
    ];
}
