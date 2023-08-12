<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Rekap Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-4">
        <table class=" w-full">
          <thead>
            <tr>
              <th class=" border px-1 w-5">No</th>
              <th class=" border px-1">Tanggal</th>
              <th class=" border px-1">Kelompok</th>
              <th class=" border px-1">Keterangan</th>
              <th class=" border px-1">Alasan</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dataAnggota as $anggota)
            <tr class=" border ">
              <th class=" border  capitalize px-1">{{ $loop->iteration }}</th>
              <td class=" border  capitalize px-1">{{ strtolower($anggota->nama_mhs) }}</td>
              <td class=" border  capitalize px-1">{{ $anggota->nama_kelompok}}</td>
              <td class=" border  capitalize px-1">{{ $anggota->keterangan }}</td>
              <td class=" border  capitalize px-1">{{ $anggota->alasan }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>