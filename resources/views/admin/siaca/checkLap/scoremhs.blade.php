<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Score Mahasiswa') }}
    </h2>
  </x-slot>
  <script>
    function printContent(el) {
      var fullbody = document.body.innerHTML;
      var printContent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = fullbody;
    }
  </script>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2">
        <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
          Cetak
        </button>

        @php
        // Ubah array menjadi objek koleksi Laravel
        $statusCounts = collect($statusCounts);
        // Urutkan objek koleksi berdasarkan perbedaan valid dan menunggu
        $sortedStatusCounts = $statusCounts->sortByDesc(function($statusCount) {
        return $statusCount['valid'] - $statusCount['draf'];
        });
        @endphp

        <div id="div1" class=" overflow-auto">
          <h2 class=" flex font-semibold">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
              </svg>

            </span>
            Hasil Perhitungan Status Laporan
          </h2>
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
  </div>
</x-app-layout>