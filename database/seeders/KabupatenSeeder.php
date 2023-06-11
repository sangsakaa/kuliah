<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KabupatenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kabupaten = [
            ['provinsi_id' => 4, 'nama_kabupaten' => 'banyuwangi'],
            ['provinsi_id' => 4, 'nama_kabupaten' => 'jember'],
            ['provinsi_id' => 4, 'nama_kabupaten' => 'lumajang'],
            ['provinsi_id' => 4, 'nama_kabupaten' => 'malang'],
            ['provinsi_id' => 4, 'nama_kabupaten' => 'tulungagung'],
            // Tambahkan kabupaten/kota lainnya di Jawa Timur sesuai kebutuhan
        ];
        DB::table('kabupaten')->insert($kabupaten);
    }
}
