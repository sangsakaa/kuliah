<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Score Mahasiswa') }}
    </h2>
  </x-slot>
  @php
  // Ubah array menjadi objek koleksi Laravel
  $statusCounts = collect($statusCounts);
  // Urutkan objek koleksi berdasarkan perbedaan valid dan menunggu
  $sortedStatusCounts = $statusCounts->sortByDesc(function($statusCount) {
  return $statusCount['valid'] - $statusCount['draf'];
  });
  @endphp
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm p-2 ">
      <?php
      $totalMenunggu = 0; // Inisialisasi variabel untuk menyimpan total 'menunggu'
      $totalValid = 0; // Inisialisasi variabel untuk menyimpan total 'menunggu'
      $totalDraf = 0; // Inisialisasi variabel untuk menyimpan total 'menunggu'

      foreach ($sortedStatusCounts as $statusCount) {
        $totalMenunggu += $statusCount['menunggu'];
        $totalValid += $statusCount['valid'];
        $totalDraf += $statusCount['draf'];
      }

      // echo "Total Menunggu: " . $totalMenunggu; // Cetak total 'menunggu'
      // echo "Total Valid: " . $totalValid; // Cetak total 'menunggu'
      ?>
      <div class=" grid grid-cols-3  sm:flex sm:grid-cols-3 gap-2">
        <div class=" bg-red-600 p-2 grid grid-cols-2 rounded-md">
          <div class=" flex">
            <span class=" text-white">Menunggu </span>
          </div>
          <div class="  flex justify-end">
            <span class="text-3xl text-white">
              {{$totalMenunggu}}
            </span> <span class=" text-white">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>

            </span>

          </div>
        </div>
        <div class=" bg-green-200 p-2 grid grid-cols-2 rounded-md">
          <div class=" flex">
            <span>Valid </span>
          </div>
          <div class="  flex justify-end">
            <span class="text-3xl">
              {{$totalValid}}
            </span>
            <span class="  ">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>

            </span>

          </div>
        </div>
        <div class=" bg-blue-500 p-2 grid grid-cols-2 rounded-md">
          <div class=" flex">
            <span class=" text-white">Draf </span>
          </div>
          <div class="  flex justify-end">
            <span class="text-3xl text-white">
              {{$totalDraf}}
            </span>
            <span class="  text-white ">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
              </svg>

            </span>

          </div>
        </div>

      </div>
    </div>
  </div>
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

        <div id="" class=" overflow-auto">
          <div class=" grid grid-cols-1 sm:grid-cols-2 font-semibold">
            <div>
              <span class=" flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                </svg>
                Hasil Perhitungan Status Laporan
              </span>
            </div>
            <div class=" sm:flex  gap-2  grid-cols-2  sm:grid-cols-2 justify-end  hidden  sm:block">
              <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
                Cetak
              </button>
              <!-- <form action="/score-mahasiswa" method="get">
                <input type="text" name="cari" value="{{ request('cari') }}" class=" border border-green-800 text-green-800 rounded-md py-1 px-4" placeholder=" Cari ..">
                <button type="submit" class="  bg-green-800 py-1 px-2 rounded-md text-white">
                  Cari</button>
              </form> -->
            </div>
          </div>
          <div id="div1">
            <table class="table w-full mt-2">
              <thead>
                <tr class=" uppercase text-sm">
                  <th rowspan=" 2" class="border px-1">No</th>
                  <th rowspan=" 2" class="border px-1">Mahasiswa</th>
                  <th rowspan=" 2" class="border px-1">KeL</th>
                  <th rowspan=" 2" class="border px-1">DPL</th>
                  <th rowspan=" 2" class="border px-1">Total <br>Hari</th>
                  <th colspan="3" class="border px-1">Status Lap</th>
                  <th rowspan=" 2" class="border px-1">Score</th>
                  <th rowspan=" 2" class="border px-1">Status</th>
                </tr>
                <tr>
                  <th class="border px-1">Valid</th>
                  <th class="border px-1">Menunggu</th>
                  <th class="border px-1">Draf</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($sortedStatusCounts as $statusCount)
                <tr class=" even:bg-gray-100   ">
                  <th class="border px-1 text-center">{{ $loop->iteration }}</th>

                  <td class="border px-1 text-left uppercase text-sm">{{ strtolower($statusCount['mhs']) }}</td>
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
                  <td class="border px-1 text-center">{{ $statusCount['menunggu'] }}</td>
                  <td class="border px-1 text-center">{{ $statusCount['draf'] }}</td>
                  <td class="border px-1 text-center">{{ $statusCount['valid'] - $statusCount['draf'] }}</td>
                  <td class="border px-1 text-center">

                    @if($statusCount['valid'] - $statusCount['draf'] >= $diffInDays)
                    <span class=" text-green-700 capitalize">
                      terpenuhi
                    </span>
                    @else
                    <span class=" text-red-700 capitalize">
                      dalam pantauan
                    </span>

                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>