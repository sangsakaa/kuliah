<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinsi = [
            ['negara_id' => 1, 'nama_provinsi' => 'DKI Jakarta'],
            ['negara_id' => 1, 'nama_provinsi' => 'Jawa Barat'],
            ['negara_id' => 1, 'nama_provinsi' => 'Jawa Tengah'],
            ['negara_id' => 1, 'nama_provinsi' => 'Jawa Timur'],
            // Tambahkan provinsi lainnya sesuai kebutuhan
        ];

        DB::table('provinsi')->insert($provinsi);
    }
}
