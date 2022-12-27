<?php

namespace Modules\Demandas\Services\Graficos\InteracoesUsuarios;

use Illuminate\Support\Facades\DB;
use Modules\Demandas\Entities\Assunto;
use Modules\Demandas\Entities\Interacao as DemandaInteracoes;

class Gateway
{
    public function getAssunto($assuntoId)
    {
        $query = Assunto::where('id', $assuntoId)
            ->get()
            ->first();

        return $query;            
    }

    public function getInteracoes(
        $dataIni,
        $dataFIm,
        $assuntoId = null,
        $usuarioId = null
    ) {
        $tableInteracoes = 'clcoop.demandas_interacoes';

        $query = DemandaInteracoes::select(
            DB::raw("to_char($tableInteracoes.created_at, 'DD/MM/YYYY') as periodo"),
            DB::raw('count(*) as interacoes')
        )
            ->join(
                'clcoop.demandas as d',
                "$tableInteracoes.demanda_id",
                '=',
                'd.id'
            )
            ->whereBetween("$tableInteracoes.created_at", [$dataIni, $dataFIm])
            ->where("$tableInteracoes.user_id", $usuarioId);

        if (!empty($assuntoId)) {
            $query->whereIn('d.assunto_id', $assuntoId);
        }

        return $query->groupBy('periodo')
            ->orderBy('periodo')
            ->get();
    }
}
