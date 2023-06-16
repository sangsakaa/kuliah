<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Laporan Daftar Kelompok') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="  flex bg-blue-300">
        <div>

        </div>
        <div>

        </div>
      </div>
    </div>
    <div class="p-4 mt-2 bg-white  border-gray-200">
      <div>

        <table class=" w-full">
          <thead>
            <tr>
              <th class=" border px-1">No</th>
              <th class=" border px-1">Pembimbing</th>
              <th class=" border px-1">Kelompok</th>
              <th class=" border px-1">Alamat</th>
              <th class=" border px-1">Detail Anggota</th>
            </tr>
          </thead>
          <tbody>
            @foreach($LapMhs as $list)
            <tr>
              <td class=" border px-1 text-center">{{$loop->iteration}}</td>
              <td class=" border px-1">{{$list->nama_dosen}}</td>
              <td class=" border px-1 text-center">{{$list->nama_kelompok}}</td>
              <td class=" border px-1 capitalize">
                Desa.{{$list->nama_desa}} -
                Kec.{{$list->nama_kecamatan}} -
                Kab.{{$list->nama_kabupaten}}
              </td>
              <td class=" border px-1 capitalize text-sm">
                @foreach($list->JmlMahasiswa as $item)
                {{$loop->iteration}}.
                @foreach($item->DetailMahasiswa as $detail)
                {{strtolower($detail->nama_mhs)}} - {{$detail->prodi}} <br>
                @endforeach
                @endforeach
              </td>
            </tr>
            @endforeach
          </tbody>

      </div>
    </div>
  </div>
  </div>
</x-app-layout>