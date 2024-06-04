<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Check Lap ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Cek Lap Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <a href="/score-mahasiswa" class=" bg-red-700 text-white py-1 px-2">Kembali</a>
        <table class=" mt-2">
          <thead>
            <tr>
              <th class=" border px-1">No</th>
              <th class=" border px-1">Nama</th>
              <th class=" border px-1">DPL</th>
            </tr>
          </thead>
          <tbody>
            @foreach($ScoreDosen as $list)
            <tr class=" even:bg-gray-100 ">
              <th class=" px-1 border">
                {{$loop->iteration}} .
              </th>
              <td class=" px-1 border capitalize ">
                {{strtolower($list->nama_mhs)}}
              </td>
              <td class=" px-1 border capitalize ">
                {{$list->nama_dosen}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>