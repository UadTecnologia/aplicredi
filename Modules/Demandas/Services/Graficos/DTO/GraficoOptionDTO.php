<?php

namespace Modules\Demandas\Services\Graficos\DTO;

class GraficoOptionDTO
{
    public $xAxis = null;

    public $yAxis = null;

    public $series = [];

    public function __construct()
    {
        $this->xAxis = new GraficoOptionXAxisDTO();
        $this->yAxis = new GraficoOptionYAxisDTO();
    }
}