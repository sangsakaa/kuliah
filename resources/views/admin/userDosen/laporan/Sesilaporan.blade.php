<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Validasi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" p-2">
    <div class=" p-4   bg-white w-full py-2 px-2 ">
      <div class=" p-4 grid grid-cols-4">
        <div class=" capitalize">nama Pembimbing</div>
        <div class=" capitalize"> : {{$dataDosen->nidn}}</div>
        <div class=" capitalize">nama Pembimbing</div>
        <div class=" capitalize"> : {{strtolower($dataDosen->nama_dosen)}}</div>
      </div>
    </div>
    <div class=" mt-2  bg-white w-full py-2 px-2 ">
      <div class="">
        <table class=" w-full">
          <thead>
            <tr>
              <th class="border text-center">No</th>
              <th class="border text-center">Tanggal</th>
              <th class="border text-center">Kelompok</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataLaporan as $data)
            <tr>
              <td class=" border text-center">{{ $loop->iteration }}</td>
              <td class=" border text-center">{{ $data->tanggal }}</td>
              <td class=" border text-center">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  {{ $data->kelompok_id }}
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