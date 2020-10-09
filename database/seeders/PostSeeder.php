<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publicacion')->insert([
            [
                'publicacionTitulo'=>'Frontend',
                'publicacionDescripcion'=>'Se busca',
                'cboCollege' => 1,
                'fk_usuarioId'=> 1,
                'publicacionFechaCreacion' => '2020-10-02'
            ],
        ]);
    }
}
