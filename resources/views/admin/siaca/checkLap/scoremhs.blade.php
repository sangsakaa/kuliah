<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Score Mahasiswa') }}
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
        return $statusCount['valid'] - $statusCount['draf'];
        });
        @endphp

        <table class="table w-full">
          <thead>
            <tr class=" uppercase text-sm">
              <th class="border px-1">No</th>
              <th class="border px-1">Dosen</th>
              <th class="border px-1">KeL</th>
              <th class="border px-1">DPL</th>
              <th class="border px-1">Total Hari</th>
              <th class="border px-1">Valid</th>
              <th class="border px-1">Draf</th>
              <th class="border px-1">Score</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($sortedStatusCounts as $statusCount)
            <tr class=" even:bg-gray-100   ">
              <th class="border px-1 text-center">{{ $loop->iteration }}</th>

              <td class="border px-1 text-left uppercase">{{ strtolower($statusCount['mhs']) }}</td>
              <td class="border px-1 text-center">{{ $statusCount['kelompok'] }}</td>
              <td class="border px-1 text-center capitalize">{{ strtolower($statusCount['dosen'])  }}</td>
              <td class="border px-1 text-center">
                @php
                $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', '25-07-2023');
                $currentDate = \Carbon\Carbon::now();
                $diffInDays = $startDate->diffInDays($currentDate);
                @endphp

                <p>{{ $diffInDays }} hari.</p>
              </td>

              <td class="border px-1 text-center">{{ $statusCount['valid'] }}</td>
              <td class="border px-1 text-center">{{ $statusCount['draf'] }}</td>
              <td class="border px-1 text-center">{{ $statusCount['valid'] - $statusCount['draf'] }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>