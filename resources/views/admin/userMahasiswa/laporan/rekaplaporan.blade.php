<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Rekap Laporan Harian') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2 overflow-auto">
        <table class="w-full">
          <thead>
            <tr class=" border  uppercase text-sm bg-slate-200">
              <th class=" px-1 border border-black" rowspan="2">No</th>
              <th class=" px-1 border border-black" rowspan="2">Hari</th>
              <th class=" px-1 border border-black" rowspan="2">Tanggal</th>
              <th class=" px-1 border border-black" colspan="3"> Status</th>
              <th class=" px-1 border border-black" rowspan="2"> Total</th>
            </tr>
            <tr class=" border  bg-slate-200">
              <th class=" px-1 border border-black "> V</th>
              <th class=" px-1 border border-black  "> M</th>
              <th class=" px-1 border border-black  "> D</th>
            </tr>
          </thead>
          <tbody>
            @php
            $groupedLaporan = $rekapLapHarian->groupBy('tanggal');
            $totalValid = 0;
            $totalMenunggu = 0;
            $totalDraf = 0;
            @endphp

            @foreach($groupedLaporan as $tanggal => $laporan)
            @php
            $jumlahValid = $laporan->where('status_laporan', 'valid')->count();
            $jumlahMenunggu = $laporan->where('status_laporan', 'menunggu')->count();
            $jumlahDraf = $laporan->where('status_laporan', 'draf')->count();
            $totalValid += $jumlahValid;
            $totalMenunggu += $jumlahMenunggu;
            $totalDraf += $jumlahDraf;
            @endphp
            <!-- Lakukan apa pun yang ingin Anda tampilkan di sini dengan data laporan untuk setiap tanggal -->

            <tr class=" hover:bg-green-100 even:bg-gray-100">
              <td class="border border-black text-center">
                {{$loop->iteration}}
              </td>
              <td class="border border-black text-left px-1">
                {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd') }}
              </td>
              <td class="border border-black text-left px-1">
                {{ \Carbon\Carbon::parse($tanggal)->isoFormat('DD MMMM Y') }}
              </td>
              <td class="border border-black text-center">{{ $jumlahValid }}</td>
              <td class="border border-black text-center">{{ $jumlahMenunggu }}</td>
              <td class="border border-black text-center">{{ $jumlahDraf }}</td>
              <td class="border border-black text-center">{{ $jumlahMenunggu + $jumlahValid + $jumlahDraf }}</td>
            </tr>
            @endforeach
            <tr class=" bg-slate-100">
              <td class="border border-black text-center" colspan="3">Jumlah</td>
              <td class="border border-black text-center">{{ $totalValid }}</td>
              <td class="border border-black text-center">{{ $totalMenunggu }}</td>
              <td class="border border-black text-center">{{ $totalDraf }}</td>
              <td class="border border-black text-center">{{ $totalMenunggu + $totalValid + $totalDraf}}</td>
            </tr>
          </tbody>
        </table>
        <div class=" mt-2 p-2 bg-blue-100">
          <p class="">Note : </p>
          <p>V : Valid</p>
          <p>M : Menunggu</p>
          <p>D : Draf</p>
        </div>

      </div>


    </div>
  </div>

  </div>





</x-app-layout>