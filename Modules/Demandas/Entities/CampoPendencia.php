<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class CampoPendencia extends BaseModel
{
    protected $table = 'clcoop.demandas_campos_pendencias';

    protected $fillable = [
        'pendencia_id',
        'campo_pendencia_id',
        'required',
        'ordem',
    ];
}
