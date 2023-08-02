<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Score Dosen') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2">

        <h2>Hasil Perhitungan Status Laporan</h2>
        @php
        // Ubah array menjadi objek koleksi Laravel
        $statusCounts = collect($statusCounts);
        // Urutkan objek koleksi berdasarkan perbedaan valid dan menunggu
        $sortedStatusCounts = $statusCounts->sortByDesc(function($statusCount) {
        return $statusCount['valid'] - $statusCount['menunggu'];
        });
        @endphp

        <table class="table w-full">
          <thead>
            <tr class=" uppercase text-sm">
              <th class="border px-1">No</th>
              <th class="border px-1">Dosen</th>
              <th class="border px-1">Jumlah Valid</th>
              <th class="border px-1">Jumlah Menunggu</th>
              <th class="border px-1">Score</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sortedStatusCounts as $statusCount)
            <tr class=" even:bg-blue-400 ">
              <th class="border px-1 text-center">{{ $loop->iteration }}</th>
              <td class="border px-1 text-left uppercase">{{ strtolower($statusCount['dosen']) }}</td>
              <td class="border px-1 text-center">{{ $statusCount['valid'] }}</td>
              <td class="border px-1 text-center">{{ $statusCount['menunggu'] }}</td>
              <td class="border px-1 text-center">{{ $statusCount['valid'] - $statusCount['menunggu'] }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>