<?php

namespace Modules\Demandas\Services\Graficos\Helper;

use DateTime;

class Utils
{
	const SABADO = 6;

	const DMINGO = 0;

	const HORA_INICIO_AM = '08:00:00';

	const HORA_FIM_AM = '12:00:00';

	const HORA_INICIO_PM = '13:00:00';

	const HORA_FINAL_PM = '17:30:00';

	static function datasPeriodo($datas, $colData, $colValue, $dataI, $dataF)
	{
		$diferencaDatas = self::diferencaDatas($dataI, $dataF);

		$datasPeriodo = [];

		for ($data = 1; $data <= $diferencaDatas; $data++) {
			$periodo = [
				$colData => date('d/m/Y', strtotime("+ $data days", strtotime($dataI))),
				$colValue => 0
			];

			foreach ($datas as $d) {
				if ($d[$colData] == $periodo[$colData]) {
					$periodo[$colValue] = $d[$colValue];
					break;
				}
			}

			if (self::dataUtil(self::dataPtBrParaUS($periodo[$colData]))) {
				$datasPeriodo[] = $periodo;
			}
		}

		return $datasPeriodo;
	}

	static function diferencaDatas($dataIni, $dataFim, $type = 'days')
	{
		if ($type == 'minutes') {
			if (is_null($dataIni)) {
				return 0;
			}

			$intervalo = date_diff(
				new DateTime(date('Y-m-d H:i:00', strtotime($dataIni))),
				new DateTime(date('Y-m-d H:i:00', strtotime($dataFim)))
			);
			$minutes = $intervalo->days * 24 * 60;
			$minutes += $intervalo->h * 60;
			$minutes += $intervalo->i;

			return  $minutes == 0 ? 1 : $minutes;
		}

		$dataIni = new DateTime($dataIni);
		$dataFim = new DateTime($dataFim);

		$intervalo = $dataIni->diff($dataFim);

		return  $intervalo->days;
	}

	static private function dataPtBrParaUS($data)
	{
		$data = explode('/', $data);

		return $data[2] . '-' . $data[1] . '-' . $data[0];
	}

	static function dataUtil($data)
	{
		if (in_array(date('w', strtotime($data)), [self::SABADO, self::DMINGO])) {
			return false;
		}

		$feriados = self::feriados()[date('Y', strtotime($data))] ?? [];

		foreach ($feriados as $f) {
			if (date('m-d', strtotime($data)) == $f) {
				return false;
			}
		}

		return true;
	}

	static function calculaHorasTrabalhadas($dataCalculada, $dataInicial, $dataFinal)
	{
		if (!self::dataUtil($dataCalculada)) {
			return [];
		}

		$diaSemana = date('w', strtotime($dataCalculada));

		$horaTrabalhadaDiaSemana = self::jornadaTrabalho()[$diaSemana];

		$dataCalculadaInicialAM = $dataCalculada . ' ' . $horaTrabalhadaDiaSemana['inicioAM'];
		$dataCalculadaFinalAM = $dataCalculada . ' ' . $horaTrabalhadaDiaSemana['fimAM'];
		$dataCalculadaInicialPM = $dataCalculada . ' ' . $horaTrabalhadaDiaSemana['inicioPM'];
		$dataCalculadaFinalPM = $dataCalculada . ' ' . $horaTrabalhadaDiaSemana['fimPM'];

		$dataCalculo = [
			'inicioAm' => null,
			'finalAm' => null,
			'inicioPm' => null,
			'finalPm' => null,
			'minutosAm' => 0,
			'minutosPm' => 0,
			'minutos' => 0
		];

		if (
			$dataInicial > $dataCalculadaFinalAM &&
			$dataInicial < $dataCalculadaInicialPM
		) {
			$dataCalculo['inicioPm'] = $dataInicial;
		}

		if (
			$dataInicial < $dataCalculadaInicialAM
		) {
			$dataCalculo['inicioAm'] = $dataInicial;
		}

		if (
			$dataFinal > $dataCalculadaFinalAM &&
			$dataFinal < $dataCalculadaInicialPM
		) {
			$dataCalculo['finalPm'] = $dataFinal;
		}

		if (
			$dataFinal < $dataCalculadaInicialAM
		) {
			$dataCalculo['finalAm'] = $dataFinal;
		}

		if (
			$dataInicial <= $dataCalculadaInicialAM &&
			$dataFinal >=  $dataCalculadaInicialAM
		) {
			$dataCalculo['inicioAm'] = $dataCalculadaInicialAM;


			if ($dataFinal > $dataCalculadaFinalAM) {
				$dataCalculo['finalAm'] = $dataCalculadaFinalAM;
			}

			if ($dataFinal < $dataCalculadaFinalAM) {
				$dataCalculo['finalAm'] = $dataFinal;
			}
		}

		if (
			$dataInicial >= $dataCalculadaInicialAM &&
			$dataInicial <= $dataCalculadaFinalAM
		) {
			$dataCalculo['inicioAm'] = $dataInicial;

			if ($dataFinal > $dataCalculadaFinalAM) {
				$dataCalculo['finalAm'] = $dataCalculadaFinalAM;
			}

			if ($dataFinal < $dataCalculadaFinalAM) {
				$dataCalculo['finalAm'] = $dataFinal;
			}
		}

		if ($dataFinal > $dataCalculadaInicialPM) {
			$dataCalculo['inicioPm'] = $dataCalculadaInicialPM;
		}

		if (
			$dataInicial >= $dataCalculadaInicialPM &&
			$dataInicial <= $dataCalculadaFinalPM
		) {
			$dataCalculo['inicioPm'] = $dataInicial;
		}

		if ($dataFinal > $dataCalculadaFinalPM) {
			$dataCalculo['finalPm'] = $dataCalculadaFinalPM;
		}

		if (
			$dataFinal <= $dataCalculadaFinalPM &&
			$dataFinal >= $dataCalculadaInicialPM
		) {
			$dataCalculo['finalPm'] = $dataFinal;
		}

		$dataCalculo['minutosAm'] = self::diferencaDatas($dataCalculo['inicioAm'], $dataCalculo['finalAm'], 'minutes');
		$dataCalculo['minutosPm'] = self::diferencaDatas($dataCalculo['inicioPm'], $dataCalculo['finalPm'], 'minutes');

		$dataCalculo['minutos'] = $dataCalculo['minutosPm'] + $dataCalculo['minutosAm'];

		return $dataCalculo;
	}

	static function jornadaTrabalho()
	{
		return [
			[
				'day' => 'Domingo',
				'inicioAM' => null,
				'fimAM' => null,
				'inicioPM' => null,
				'fimPM' => null,
			],
			[
				'day' => 'Segunda-Feira',
				'inicioAM' => self::HORA_INICIO_AM,
				'fimAM' => self::HORA_FIM_AM,
				'inicioPM' => self::HORA_INICIO_PM,
				'fimPM' => self::HORA_FINAL_PM,
			],
			[
				'day' => 'Terça-Feira',
				'inicioAM' => self::HORA_INICIO_AM,
				'fimAM' => self::HORA_FIM_AM,
				'inicioPM' => self::HORA_INICIO_PM,
				'fimPM' => self::HORA_FINAL_PM,
			],
			[
				'day' => 'Quarta-Feira',
				'inicioAM' => self::HORA_INICIO_AM,
				'fimAM' => self::HORA_FIM_AM,
				'inicioPM' => self::HORA_INICIO_PM,
				'fimPM' => self::HORA_FINAL_PM,
			],
			[
				'day' => 'Quinta-Feira',
				'inicioAM' => self::HORA_INICIO_AM,
				'fimAM' => self::HORA_FIM_AM,
				'inicioPM' => self::HORA_INICIO_PM,
				'fimPM' => self::HORA_FINAL_PM,
			],
			[
				'day' => 'Sexta-Feira',
				'inicioAM' => self::HORA_INICIO_AM,
				'fimAM' => self::HORA_FIM_AM,
				'inicioPM' => self::HORA_INICIO_PM,
				'fimPM' => self::HORA_FINAL_PM,
			],
			[
				'day' => 'Sábado',
				'inicioAM' => null,
				'fimAM' => null,
				'inicioPM' => null,
				'fimPM' => null,
			],
		];
	}

	static function feriados()
	{
		return [
			2022 => [
				'01-01',
				'02-28',
				'03-01',
				'04-15',
				'04-21',
				'05-01',
				'06-16',
				'07-29',
				'09-07',
				'10-12',
				'11-02',
				'11-15',
				'12-25',
			]
		];
	}
}
