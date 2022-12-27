<?php

namespace Modules\Demandas\Entities;

use Modules\BaseModel;

class CamposDisponiveis extends BaseModel
{
    protected $table = 'clcoop.demandas_campos_disponiveis';

    protected $fillable = [
        'descricao',
        'componente',
        'grid',
        'ativo',
        'ordem',
    ];

    public function generateTags(): array
    {
        return [
            'Demandas',
            'Campos',
        ];
    }
}
