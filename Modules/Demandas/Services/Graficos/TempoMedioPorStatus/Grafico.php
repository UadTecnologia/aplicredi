<?php

namespace Modules\Demandas\Services\Graficos\TempoMedioPorStatus;

use Modules\Demandas\Services\Graficos\DTO\GraficoDTO;
use Modules\Demandas\Services\Graficos\Enum\GraficoEnum;
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
        $interacoes = $this->dados($this->parametros->getAssuntoIds());
        $interacoes = $this->agruparInteracoesPorDemanda($interacoes);

        $this->grafico->setTitle('Tempo médio por status nas demandas (por minuto)');
        $this->grafico->setTooltip();

        $data = $this->agrupaPeriodo($interacoes);

        foreach ($data['status'] as $statusId  => $s) {
            $status = $this->gateway->getStatus($statusId);
            $dados = $this->trataDadosGrafico($data['periodo'], $statusId);

            $this->grafico->setSeries($dados, 'media', $status->nome);
            $this->grafico->setXAxis($dados, 'periodo');

            $this->grafico->setLegend($status->nome);
        }
    }

    private function trataDadosGrafico($dados = [], $statusId = null)
    {
        $data = [];

        foreach ($dados as $periodo => $d) {
            $data[] = [
                'periodo' => date('d/m/Y', strtotime($periodo)),
                'media' => $d[$statusId]['quantidade'] > 0 ?
                    $d[$statusId]['minutos'] / $d[$statusId]['quantidade'] : 0
            ];
        }

        return $data;
    }

    private function agrupaPeriodo($demandas = [])
    {
        $periodo = [];
        $status = [];

        foreach ($demandas as $interacoes) {
            foreach ($interacoes as $interacao) {
                if (empty($status[$interacao['status_id']])) {
                    $status[$interacao['status_id']] = true;
                }
                foreach ($interacao['tempo'] as $data => $tempo) {
                    if (empty($periodo[$data][$interacao['status_id']])) {
                        $periodo[$data][$interacao['status_id']] = [
                            'minutos' => 0,
                            'media' => 0,
                            'quantidade' => 0,
                        ];
                    }

                    $periodo[$data][$interacao['status_id']]['minutos'] += $tempo['minutos'];
                    $periodo[$data][$interacao['status_id']]['quantidade'] += 1;
                }
            }
        }

        foreach ($periodo as $data => $statusInteracoes) {
            foreach ($status as $statusId => $s) {
                if (empty($periodo[$data][$statusId])) {
                    $periodo[$data][$statusId] = [
                        'minutos' => 0,
                        'media' => 0,
                        'quantidade' => 0,
                    ];
                }
            }
        }

        return [
            'status' => $status,
            'periodo' => $periodo,
        ];
    }

    private function agruparInteracoesPorDemanda($interacoes = [])
    {
        $demandas = [];

        foreach ($interacoes as $indiceInterecao => $interacao) {
            if (empty($demandas[$interacao['demanda_id']])) {
                $demandas[$interacao['demanda_id']] = [];
            }

            if ($this->elimineInteracoesDuplicadas($interacoes, $indiceInterecao, $interacao)) {
                continue;
            }

            $demandas[$interacao['demanda_id']][] = $interacao;
        }

        return $this->calculaTempoStatus($demandas);
    }

    private function elimineInteracoesDuplicadas($interacoes, $indiceInterecao, $interacao)
    {
        if (!empty($interacoes[$indiceInterecao + 1])) {
            if ($interacoes[$indiceInterecao + 1]['created_at'] == $interacao['created_at']) {
                return true;
            }
        }

        return false;
    }

    private function calculaTempoStatus($demandas)
    {
        foreach ($demandas as $demadnaId => $interacoes) {
            foreach ($interacoes as $indiceInterecao => $i) {
                $dataStatusInicial = $i['created_at'];
                $dataProximoStatus = $i['created_at'];

                if (!empty($interacoes[$indiceInterecao + 1])) {
                    $dataProximoStatus = $interacoes[$indiceInterecao + 1]['created_at'];
                }

                if (in_array($i['status_id'], GraficoEnum::STATUS_IDS_DEMANDAS_FECHADAS)) {
                    $dataProximoStatus = $dataStatusInicial;
                }

                $demandas[$demadnaId][$indiceInterecao]['data_proxima_interacao'] = $dataProximoStatus;
                $demandas[$demadnaId][$indiceInterecao]['tempo'] = $this->calculaTempo($dataStatusInicial, $dataProximoStatus);
            }
        }

        return $demandas;
    }

    private function calculaTempo($dataStatusInicial, $dataProximoStatus)
    {
        $dataStatusInicial = date('Y-m-d H:i:s', strtotime($dataStatusInicial));
        $dataProximoStatus = date('Y-m-d H:i:s', strtotime($dataProximoStatus));

        $diferencaDias = Utils::diferencaDatas(
            date('Y-m-d', strtotime($dataStatusInicial)),
            date('Y-m-d', strtotime($dataProximoStatus))
        );

        $horarioTrabalhado = [];

        for ($dia = 0; $dia <= $diferencaDias; $dia++) {
            $dataCalculada = date('Y-m-d', strtotime(
                "+ $dia days",
                strtotime($dataStatusInicial)
            ));

            $dataCalculo = Utils::calculaHorasTrabalhadas(
                $dataCalculada,
                $dataStatusInicial,
                $dataProximoStatus
            );

            if (!empty($dataCalculo)) {
                $horarioTrabalhado[$dataCalculada] = $dataCalculo;
            }
        }

        return $horarioTrabalhado;
    }
}
