<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CollegeSeed::class);
        $this->call(CompanySeed::class);
        $this->call(SectorSeed::class);
        $this->call(VacantSeed::class);
        // \App\Models\User::factory(10)->create();
    }
}
