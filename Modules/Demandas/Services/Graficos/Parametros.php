<?php

namespace Modules\Demandas\Services\Graficos;

use Modules\Demandas\Services\Graficos\Enum\GraficoEnum;

class Parametros
{
    public $request = null;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function getDataIni()
    {
        $data = $this->request->get('dataIni') ?? null;

        if (empty($data)) return null;

        return $data . ' 00:00:00';
    }

    public function getDataFim()
    {
        $data = $this->request->get('dataFim') ?? null;

        if (empty($data)) return null;

        return $data . ' 23:59:59';
    }

    public function getDataAbertura()
    {
        return $this->request->get('dataAbertura') ?? null;
    }

    public function getAssuntoIds() :array
    {
        return $this->request->get('assuntoIds') ?? [];
    }

    public function getUsuarioIds() :array
    {
        return $this->request->get('usuarioIds') ?? [];
    }

    public function getTipoGrafico() :string
    {
        return $this->request->get('tipoGrafico') ?? '';
    }

    public function getTipoResultado() :string
    {
        return $this->request->get('media') ? GraficoEnum::MEDIA : GraficoEnum::SOMA;
    }
}