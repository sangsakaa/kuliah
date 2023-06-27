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
            // Desa-desa di Sendang
            'Sendang' => [
                'Kedoyo',
                'Nyawangan',
                'Tugu (Krajan)',
                'Tugu (Soko)',
                'Ngluntung',
                
            ],
            // Desa-desa di Ngunut
            'Ngunut' => [
                'Kacangan',
                'Kaliwungu',
            ],
            // Desa-desa di Kalidawir
            'Kalidawir' => [
                'Krandengan'

            ],
            // Desa-desa di Rejotangan
            'Rejotangan' => [
                'Tenggur'

            ],
            // Desa-desa di Gondang
            'Gondang' => [
                'Rejosari',
                'Gondang',
                
            ],
            'Karangrejo' => [
                'Jeli',
                'Sukorejo',
                'Gedangan',
                'Babadan'
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
