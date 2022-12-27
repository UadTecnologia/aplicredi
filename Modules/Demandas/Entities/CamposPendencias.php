<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class CamposPendencias extends BaseModel
{
    protected $table = 'clcoop.demandas_pendencias_campos';

    protected $fillable = [
        'demanda_id',
        'campo_pendencia_id',
        'valor',
    ];

    public function generateTags(): array
    {
        return [
            'Demandas',
            'Campos',
        ];
    }
}
