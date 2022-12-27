<?php

namespace Modules\Demandas\Services\Graficos\DTO;

use Modules\Demandas\Services\Graficos\Enum\GraficoEnum;

class GraficoDTO
{
    public $option = [];

    public $height = '400px';

    public $width = '100%';

    public function __construct()
    {
        $this->option = new GraficoOptionDTO();
    }

    public function setWidth($value)
    {
        $this->width = $value;
    }

    public function setHeight($value)
    {
        $this->height = $value;
    }

    public function setSeries($data, $colunm, $name, $type = GraficoEnum::TYPE_LINE)
    {
        $value = [];

        foreach ($data as $d) {
            $value[] = $d[$colunm];
        }

        $this->option->series[] = [
            'data' => $value,
            'name' => $name,
            'type' => $type
        ];
    }

    public function setTitle($title = '')
    {
        $this->option->title['text'] = $title;
    }

    public function setLegend($legend = [])
    {
        $this->option->legend['data'][] = $legend;
    }

    public function setTooltip($tooltip = 'axis')
    {
        $this->option->tooltip['trigger'] = $tooltip;
    }

    public function setYAxisValue($type = '')
    {
        $this->option->yAxis->type = $type;
    }

    public function setXAxis($data, $colunm,  $type = 'category')
    {
        $this->option->xAxis->type = $type;
        $this->option->xAxis->data = $this->formatDataXAxis(
            $data,
            $colunm
        );
    }

    private function formatDataXAxis($data = [], $colunm)
    {
        $return = [];

        foreach ($data as $d) {
            $return[] = $d[$colunm];
        }

        return $return;
    }

    public function setDownloadImage($value = false)
    {
        if ($value) {
            $this->option->toolbox = [
                'feature' => [
                    'saveAsImage' => []
                ]
            ];
        }
    }
}
