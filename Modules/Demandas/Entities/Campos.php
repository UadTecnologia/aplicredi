<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class Campos extends BaseModel
{
    protected $table = 'clcoop.demandas_campos';

    protected $fillable = [
        'demanda_id',
        'campo_assunto_id',
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
