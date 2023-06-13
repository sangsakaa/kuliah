<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Validasi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" p-2">
    <div class=" p-4   bg-white w-full py-2 px-2 ">
      <div class=" p-4 grid grid-cols-2 sm:grid-cols-4">
        <div class=" capitalize">NIDN</div>
        <div class=" capitalize"> : {{$dataDosen->nidn}}</div>
        <div class=" capitalize">nama Pembimbing</div>
        <div class=" capitalize"> : {{strtolower($dataDosen->nama_dosen)}}</div>

      </div>
    </div>
    <div class=" mt-2  bg-white w-full py-2 px-2 ">
      <div class=" overflow-auto">
        <table class=" w-full">
          <thead>
            <tr class=" uppercase">
              <th class="border border-green-700 px-2 py-1 text-center">No</th>
              <th class="border border-green-700 px-2 py-1 text-center">Tanggal</th>
              <th class="border border-green-700 px-2 py-1 text-center">Jam</th>
              <th class="border border-green-700 px-2 py-1 text-center">KEL</th>
              <th class="border border-green-700 px-2 py-1 text-center">LAP</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataLaporan as $data)
            <tr>
              <td class=" border border-green-700 px-2 py-1 text-center">{{ $loop->iteration }}</td>
              <td class=" border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd , DD MMMM Y') }}
              </td>
              <td class="border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('H:m') }}
              </td>
              <td class=" border border-green-700 px-2 py-1 text-center">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  {{ $data->nama_kelompok }}

                </a>
              </td>
              <td class=" border border-green-700 px-2 py-1 text-center">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  LAP
                </a>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>


      </div>
    </div>
  </div>
</x-app-layout>