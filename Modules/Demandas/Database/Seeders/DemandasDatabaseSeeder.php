<?php

namespace Modules\Demandas\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DemandasDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->command->info('Inserindo Demandas');

        $path = public_path() . '/sql/demandas.sql';
        DB::unprepared(file_get_contents($path));
        
        $path = public_path() . '/sql/demandas472805.sql';
        DB::unprepared(file_get_contents($path));

        $path = public_path() . '/sql/demandas472907.sql';
        DB::unprepared(file_get_contents($path));

        $this->command->info('Demandas inseridas!');

        // $this->call("OthersTableSeeder");
    }
}
