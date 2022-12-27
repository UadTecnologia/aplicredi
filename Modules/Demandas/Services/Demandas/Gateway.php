<?php

namespace Modules\Demandas\Services\Demandas;

use Modules\Demandas\Entities\Assunto;

class Gateway
{
    public function getAssuntos($setorId)
    {
        $tableAssuntos = 'clcoop.demandas_assuntos';

        $query = Assunto::select("$tableAssuntos.*")
            ->join(
                'clcoop.demandas_assuntos_setores as s',
                "$tableAssuntos.id",
                '=',
                's.assunto_id'
            )
            ->where('s.setor_id', $setorId)
            ->get();

        return $query;
    }

    public function getSetores()
    {
        return [
            [
                'id' => 1,
                'descricao' => 'TI',
            ],
            [
                'id' => 2,
                'descricao' => 'Administrativo',
            ],
            [
                'id' => 9,
                'descricao' => 'Operacional',
            ],
        ];
    }

    public function getUsuarios($setorId)
    {
        $query = [
            [
                'id' => 228,
                'setor_id' => 1,
                'nome' => 'Jacson',
            ],
            [
                'id' => 1287,
                'setor_id' => 1,
                'nome' => 'André',
            ],
            [
                'id' => 44,
                'setor_id' => 3,
                'nome' => 'Daniela',
            ],
        ];

        $retorno = [];

        foreach ($query as $key => $q) {
            if ($q['setor_id'] == $setorId) {
                $retorno[] = $query[$key];
            }
        }

        return $retorno;
    }
}
