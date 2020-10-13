<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('empresa')->insert([
            [
                'empresaNombre'=>'Empresa',
                'empresaEmail'=>'empresa@academia.umb.edu.co',
                'empresaTelefono' => '3132296236',
                'nitEmpresa'=> '1234567890',
                'empresaDescripcion'=>'Esmpresa de tecnología',
                'id_sector' => 1,
                'id_user' => 1
            ],
        ]);
    }
}
