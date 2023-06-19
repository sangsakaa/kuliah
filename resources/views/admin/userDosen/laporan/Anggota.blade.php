<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Daftar Data Anggota') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class=" py-1">
      <div class=" bg-white py-1">
        <div class=" p-2 grid grid-cols-2 sm:grid-cols-4">
          <div>NIDN</div>
          <div> : {{$dataDosen->nidn}}</div>
          <div>Pembimbing</div>
          <div> : {{$dataDosen->nama_dosen}}</div>
          <div>Kelompok</div>
          <div> : {{$dataDosen->nama_kelompok}}</div>
        </div>
      </div>
    </div>
    <div class=" p-2 mt-2 bg-white">
      <div class=" overflow-auto">
        <table class=" w-full">
          <thead>
            <tr class=" px-1 border-black border">
              <th class=" px-1 border-black border">No</th>
              <th class=" px-1 border-black border">NIM</th>
              <th class=" px-1 border-black border">Nama</th>
              <th class=" px-1 border-black border capitalize">
                <span class=" sm:block">jenis Kelamin</span>
                <span class=" hidden">Jk</span>
              </th>
              <th class=" px-1 border-black border">Prodi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataAnggota as $list)
            <tr>
              <td class=" border border-black px-1 text-center">{{$loop->iteration}}</td>
              <td class=" border border-black px-1 capitalize">{{strtolower($list->nim)}}</td>
              <td class=" border border-black px-1 capitalize">{{strtolower($list->nama_mhs)}}</td>
              <td class=" border border-black px-1 capitalize text-center">{{$list->jenis_kelamin}}</td>
              <td class=" border border-black px-1 capitalize text-center">{{$list->prodi}}</td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</x-app-layout>