<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class CamposAssuntos extends BaseModel
{
    protected $table = 'clcoop.demandas_campos_assuntos';

    protected $fillable = [
        'assunto_id',
        'campo_id',
        'ordem',
        'required',
    ];

    public function generateTags(): array
    {
        return [
            'Demandas',
            'Campos',
        ];
    }
}
