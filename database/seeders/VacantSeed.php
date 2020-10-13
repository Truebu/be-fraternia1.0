<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VacantSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vacante')->insert([
            [
                'vacanteNombre'=>'Frontend',
                'vacanteDescripcion'=>'Se busca',
                'id_empresa' => 1,
                'id_users'=> 1,
                'cboCollege'=>1,
                'fechasRegistro' => '2020-10-02'
            ],
        ]);
    }
}
