<?php

namespace Database\Seeders;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $desaKecamatan = [
            // Desa-desa di Boyolangu
            'Boyolangu' => [
                'Banaran',
                'Baturagung',
                'Boyolangu',
                'Bugel',
                'Bululawang',
                'Gadingrejo',
                'Gentungan',
                'Grogolan',
                'Jambewangi',
                'Kebonagung'
            ],
            // Desa-desa di Campurdarat
            'Campurdarat' => [
                'Jatiduwur',
                'Jatimulyo',
                'Jatipurwo',
                'Jatisari',
                'Karangjati',
                'Karangmojo',
                'Karangsono',
                'Karangsono Kulon',
                'Kebak',
                'Kedawung'
            ],
            // Desa-desa di Gondang
            'Gondang' => [
                'Jatipuro',
                'Bujel',
                'Dawuhan',
                'Durenan',
                'Gondang',
                'Jugo',
                'Kanigoro',
                'Karangbong',
                'Karanganyar',
                'Karangduren'
            ],
            'Karangrejo' => [
                'Karangrejo',
                'Gadung',
                'Sidomulyo',
                'Dawuhan',
                'Sumberbulu',
                'Pagerwojo',
                'Karangsari',
                'Klakah',
                'Sumberjambe',
                'Sidorejo'
            ],
            // Daftar desa di kecamatan lainnya...
        ];

        foreach ($desaKecamatan as $kecamatan => $desa) {
            $kecamatanId = Kecamatan::where('nama_kecamatan', $kecamatan)->value('id');
            foreach ($desa as $nama) {
                Desa::create([
                    'kecamatan_id' => $kecamatanId,
                    'nama_desa' => $nama
                ]);
            }
        }
    }
}
