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
            <tr>
              <th class="border border-black" rowspan="2">No</th>
              <th class="border border-black" rowspan="2">Tanggal</th>
              <th class="border border-black" colspan="2"> Jumlah Status</th>
            </tr>
            <tr>
              <th class="border border-black w-1/5"> Valid</th>
              <th class="border border-black  w-1/5"> Menunggu</th>
            </tr>
          </thead>
          <tbody>
            @php
            $groupedLaporan = $rekapLapHarian->groupBy('tanggal');
            @endphp
            @foreach($groupedLaporan as $tanggal => $laporan)
            @php
            $jumlahValid = $laporan->where('status_laporan', 'valid')->count();
            $jumlahMenunggu = $laporan->where('status_laporan', 'menunggu')->count();
            @endphp
            <tr>
              <td class="border border-black text-center">
                {{$loop->iteration}}
              </td>
              <td class="border border-black text-center">
                {{ \Carbon\Carbon::parse($tanggal)->isoFormat('dddd , DD MMMM Y') }}
              </td>
              <td class="border border-black text-center">{{ $jumlahValid }}</td>
              <td class="border border-black text-center">{{ $jumlahMenunggu }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>


    </div>
  </div>

  </div>





</x-app-layout>