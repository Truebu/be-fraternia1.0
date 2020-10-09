<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var TYPE_NAME $password */
        $password = password_hash('1234', PASSWORD_BCRYPT);
        DB::table('users')->insert([
            [
                'usuarioNombre'=>'Juan David Castañeda',
                'usuarioEmail'=>'juancastaneda.dv@academia.umb.edu.co',
                'usuarioTelefonoPrincipal' => '3132296236',
                'usuarioContraseña'=> $password,
                'fk_universidadId' => 1
            ],
        ]);
    }
}
