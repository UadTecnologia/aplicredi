<?php

namespace Modules\Sistema\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Sistema\Entities\EmailTipo;
use Modules\Sistema\Entities\FoneTipo;
use Modules\Sistema\Entities\EnderecoTipo;
use Modules\Sistema\Entities\PessoaTipo;
use Modules\Sistema\Entities\Modulo;

class SistemaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->command->info('Inserindo cidades');

        $path = public_path() . '/sql/cidades.sql';
        DB::unprepared(file_get_contents($path));
        DB::update("update cidade set created_at = '2020-09-08 11:10:01', updated_at = '2020-09-08 11:10:01'");

        $this->command->info('Cidades inseridas!');

        FoneTipo::insert(
            [
                'descricao' => 'Fixo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'descricao' => 'Celular',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        );

        EmailTipo::insert([
            'descricao' => 'E-mail NF-e',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        EnderecoTipo::insert([
            'descricao' => 'Principal',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        PessoaTipo::insert([
            [
                'descricao' => 'Revenda',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'descricao' => 'Usuário',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);

        Modulo::insert([
            [
                'id_modulo' => 1,
                'descricao' => 'Pessoa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_modulo' => 2,
                'descricao' => 'Produto',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id_modulo' => 3,
                'descricao' => 'Usuário',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
