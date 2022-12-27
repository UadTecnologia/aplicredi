<?php

namespace Modules\Demandas\Console\Commands;

use Illuminate\Console\Command;
use Modules\Demandas\Entities\Demanda;
use Modules\Demandas\Entities\Interacao as DemandasInteracoes;

class InsereStatusInteracoesDemandas extends Command
{
    protected $signature = 'demandas:insere-status-interacoes';

    protected $description = 'Insere status ABERTO, INICIADO, FINALIZADO nas interações';

    const STATUS_ABERTO = 1;

    const STATUS_ANDAMENTO = 2;

    const STATUS_FINALIZADO = 3;

    const DESCRICAO_STATUS_AUTOMATIZADO = 'Interação automatizada';

    public function __construct()
    {
        ini_set('max_execution_time', '-1');
        ini_set('memory_limit', '-1');
        ini_set('MAX_EXECUTION_TIME', '-1');

        parent::__construct();
    }

    public function handle()
    {
        $this->info('Buscando demandas...');

        // primeiro id interacao = 5232020

        $demandas = Demanda::get();

        foreach ($demandas as $demanda) {
            $this->info('Demanda: ' . $demanda['id']);
            
            if(!empty($demanda['created_at'])) {
               DemandasInteracoes::insert([
                    'demanda_id' => $demanda['id'],
                    'created_at' => $demanda['created_at'],
                    'updated_at' => $demanda['updated_at'],
                    'user_id' => $demanda['setor_id'],
                    'setor_id' => $demanda['setor_id'],
                    'descricao' => self::DESCRICAO_STATUS_AUTOMATIZADO,
                    'status_id' => self::STATUS_ABERTO
                ]);
            }
            if(!empty($demanda['inicio_atendimento'])) {
               DemandasInteracoes::insert([
                    'demanda_id' => $demanda['id'],
                    'created_at' => $demanda['inicio_atendimento'],
                    'updated_at' => $demanda['inicio_atendimento'],
                    'user_id' => $demanda['atendido_por'] ?? $demanda['user_id'],
                    'setor_id' => $demanda['setor_id'],
                    'descricao' => self::DESCRICAO_STATUS_AUTOMATIZADO,
                    'status_id' => self::STATUS_ANDAMENTO
                ]);
            }
            if(!empty($demanda['fim_atendimento'])) {
               DemandasInteracoes::insert([
                    'demanda_id' => $demanda['id'],
                    'created_at' => $demanda['fim_atendimento'],
                    'updated_at' => $demanda['fim_atendimento'],
                    'user_id' => $demanda['atendido_por'] ?? $demanda['user_id'],
                    'setor_id' => $demanda['setor_id'],
                    'descricao' => self::DESCRICAO_STATUS_AUTOMATIZADO,
                    'status_id' => self::STATUS_FINALIZADO
                ]);
            }
        }
    }
}
