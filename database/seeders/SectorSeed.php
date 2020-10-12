<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectorSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sector')->insert([
            [
                'sectorNombre'=>'Tenología'
            ],
            [
                'sectorNombre'=>'Humaniddes'
            ],
            [
                'sectorNombre'=>'Reciclaje'
            ],
        ]);
    }
}
