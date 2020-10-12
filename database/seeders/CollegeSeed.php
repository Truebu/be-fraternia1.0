<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('universidad')->insert([
            [
                'nombreUniversidad'=>'UMB'
            ],
            [
                'nombreUniversidad'=>'UMNG'
            ],
            [
                'nombreUniversidad'=>'La Salle'
            ],
        ]);
    }
}
