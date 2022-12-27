<?php

namespace Modules\Demandas\Services\Graficos\InteracoesUsuarios;

use Modules\Demandas\Services\Graficos\DTO\GraficoDTO;
use Modules\Demandas\Services\Graficos\Helper\Utils;

class Grafico
{
    public $grafico = null;

    private $gateway;

    private $parametros;

    public function __construct($parametros)
    {
        $this->grafico = new GraficoDTO();
        $this->gateway = new Gateway;
        $this->parametros = $parametros;
    }

    public function render()
    {
        $this->calculo();

        return  $this->grafico;
    }

    private function dados($assuntoId = [])
    {
        return $this->gateway->getInteracoes(
            $this->parametros->getDataIni(),
            $this->parametros->getDataFim(),
            $assuntoId,
            $this->parametros->getUsuarioIds(),
        );
    }

    private function calculo()
    {
        if (!empty($this->parametros->getAssuntoIds())) {
            $this->dadosAssunto();
        }

        if (empty($this->parametros->getAssuntoIds())) {
            $this->dadosGeral();
        }

        $this->grafico->setTitle('Intereções por usuário');
        $this->grafico->setTooltip();
        $this->grafico->setDownloadImage(true);
    }

    private function dadosGeral()
    {
        $data = Utils::datasPeriodo(
            $this->dados([]),
            'periodo',
            'interacoes',
            $this->parametros->getDataIni(),
            $this->parametros->getDataFim()
        );

        $this->grafico->setSeries($data, 'interacoes', 'Interações');
        $this->grafico->setXAxis($data, 'periodo');
        $this->grafico->setLegend('Interações');
    }

    private function dadosAssunto()
    {
        foreach ($this->parametros->getAssuntoIds() as $assuntoId) {
            $data = Utils::datasPeriodo(
                $this->dados([$assuntoId]),
                'periodo',
                'interacoes',
                $this->parametros->getDataIni(),
                $this->parametros->getDataFim()
            );

            $assunto = $this->gateway->getAssunto($assuntoId);

            $legenda = $assunto->nome ?? 'Interações';

            $this->grafico->setSeries($data, 'interacoes', $legenda);
            $this->grafico->setXAxis($data, 'periodo');
            $this->grafico->setLegend($legenda);
        }
    }
}
