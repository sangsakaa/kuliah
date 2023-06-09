<?php

namespace App\Exports;

use App\Models\Mahasiswa;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Mahasiswa::all();
    }

    public function map($mahasiswa): array
    {
        $rowNum = $this->getRowNum();


        return [
            $rowNum, // Add row number
            $mahasiswa->nim,
            $mahasiswa->nama_mhs,
            $mahasiswa->jenis_kelamin,
            $mahasiswa->prodi,
            $mahasiswa->status,
        ];
    }

    private function getRowNum()
    {
        if (!isset($this->rowNum)) {
            $this->rowNum = 1;
        }

        return $this->rowNum++;
    }



    public function headings(): array
    {
        return [
            'No',
            'Nim',
            'Nama',
            'jenis_kelamin',
            'Program Studi',
            'Status'
        ];
    }
}
