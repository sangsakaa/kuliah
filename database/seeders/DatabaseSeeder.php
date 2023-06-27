<?php

namespace Database\Seeders;

use ProvinsiSeeder;
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
        // $this->call(ProvinsiSeeder::class);
        // $this->call(KabupatenSeeder::class);
        // $this->call(KecamatanSeeder::class);
        $this->call(DesaSeeder::class);
    }
}
