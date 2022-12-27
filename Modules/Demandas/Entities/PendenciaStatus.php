<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class PendenciaStatus extends BaseModel
{
    protected $table = 'clcoop.demandas_pendencias_status';

    protected $fillable = [
        'tipo_pendencia_id',
        'status_id',
    ];
}
