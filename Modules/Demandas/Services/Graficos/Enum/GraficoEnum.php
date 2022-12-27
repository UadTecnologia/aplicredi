<?php

namespace Modules\Demandas\Services\Graficos\Enum;

class GraficoEnum
{
    const STATUS_IDS_DEMANDAS_FECHADAS = [3];
    
    const TYPE_XAXIS = 'category';

    const TYPE_YAXIS = 'value';

    const TYPE_LINE = 'line';

    const MEDIA = 'avg';

    const SOMA = 'count';

    const TIPO_TEMPO_STATUS_DEMANDAS = 'tempo-status-demanda';

    const TIPO_INTERACOES_USUARIOS = 'interacoes-usuarios';

    const TIPO_GRAFICOS = [
        [
            'title' => 'Tempo médio por status nas demandas',
            'type' => self::TIPO_TEMPO_STATUS_DEMANDAS,
            'filters' => [
                [
                    'name' => 'dataIni',
                    'required' => true
                ],
                [
                    'name' => 'dataFim',
                    'required' => true
                ],
                [
                    'name' => 'assuntoId',
                    'required' => true
                ],
                [
                    'name' => 'usuarioId',
                    'required' => false
                ],
                [
                    'name' => 'setorId',
                    'required' => true
                ],
            ]
        ],
        [
            'title' => 'Intereções de usuários',
            'type' => self::TIPO_INTERACOES_USUARIOS,
            'filters' => [
                [
                    'name' => 'dataIni',
                    'required' => true
                ],
                [
                    'name' => 'dataFim',
                    'required' => true
                ],
                [
                    'name' => 'assuntoId',
                    'required' => true
                ],
                [
                    'name' => 'usuarioId',
                    'required' => true
                ],
                [
                    'name' => 'setorId',
                    'required' => true
                ],
            ]
        ]
    ];
}
