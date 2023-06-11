<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kabupatenId = 5; // Ubah sesuai dengan id kabupaten yang sesuai

        $kecamatan = [
            'Boyolangu',
            'Campurdarat',
            'Gondang',
            'Kalidawir',
            'Karangrejo',
            'Kauman',
            'Kedungwaru',
            'Ngantru',
            'Ngunut',
            'Pagerwojo',
            'Pakel',
            'Pucanglaban',
            'Rejotangan',
            'Sendang',
            'Sumbergempol',
            'Tanggunggunung',
            'Tulungagung',
            'Bandung',
            'Besuki',
            'Bringin',
            'Kedungjajang',
            'Klampis',
            'Karangan',
            'Kedungadem',
            'Nglegok'
        ];

        foreach ($kecamatan as $nama) {
            Kecamatan::create([
                'kabupaten_id' => $kabupatenId,
                'nama_kecamatan' => $nama
            ]);
        }
    }
}
