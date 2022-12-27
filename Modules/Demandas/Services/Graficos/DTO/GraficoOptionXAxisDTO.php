<?php

namespace Modules\Demandas\Services\Graficos\DTO;

use Modules\Demandas\Services\Graficos\Enum\GraficoEnum;

class GraficoOptionXAxisDTO
{
    public $type = GraficoEnum::TYPE_XAXIS;

    public $data = [];
}