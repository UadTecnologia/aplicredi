<?php

namespace Modules\Demandas\Services\Graficos\TempoMedioPorStatus;

use Modules\Demandas\Entities\Assunto;
use Modules\Demandas\Entities\Interacao as DemandaInteracoes;
use Modules\Demandas\Entities\Status;

class Gateway
{
    public function getAssunto($assuntoId)
    {
        $query = Assunto::where('id', $assuntoId)
            ->get()
            ->first();

        return $query;            
    }

    public function getStatus($assuntoId)
    {
        $query = Status::where('id', $assuntoId)
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
            "$tableInteracoes.demanda_id",
            "$tableInteracoes.status_id",
            "$tableInteracoes.created_at"
        )
            ->join(
                'clcoop.demandas as d',
                "$tableInteracoes.demanda_id",
                '=',
                'd.id'
            )
            ->whereBetween("$tableInteracoes.created_at", [$dataIni, $dataFIm])
            ->whereNotNull("$tableInteracoes.status_id")
            ->whereIn('d.assunto_id', $assuntoId);

        if (!empty($usuarioId[0])) {
            $query->whereIn("$tableInteracoes.user_id", $usuarioId);
        }

        return $query->orderBy('demanda_id', 'asc')
            ->orderBy('created_at', 'asc')
            ->get();
    }
}
