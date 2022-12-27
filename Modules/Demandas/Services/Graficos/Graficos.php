<?php

namespace Modules\Demandas\Services\Graficos;

use Modules\Demandas\Services\Graficos\Enum\GraficoEnum;

class Graficos
{
    public $grafico = null;

    private $parametros;

    public function all()
    {
        return [
            'data' => GraficoEnum::TIPO_GRAFICOS,
            'status' => true,
        ];
    }

    public function render($request)
    {
        $this->parametros = new Parametros($request);

        if ($this->parametros->getTipoGrafico() == GraficoEnum::TIPO_INTERACOES_USUARIOS) {
            $this->grafico = new InteracoesUsuarios\Grafico($this->parametros);
        }

        if ($this->parametros->getTipoGrafico() == GraficoEnum::TIPO_TEMPO_STATUS_DEMANDAS) {
            $this->grafico = new TempoMedioPorStatus\Grafico($this->parametros);
        }

        return [
            'data' => $this->grafico->render(),
            'status' => true,
        ];
    }
}