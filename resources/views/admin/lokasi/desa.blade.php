<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Wilayah') }} - <span class=" capitalize">Kec . {{$kecamatan->nama_kecamatan}}</span>
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 gap-2 grid  ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
      <div class=" p-4">
        <form action="/lokasi-desa/{{$kecamatan->id}}" method="post">
          @csrf
          <div class=" grid grid-cols-1">
            <label for="">Nama Kecamatan</label>
            <input type="text" name="kecamatan_id" value="{{$kecamatan->id}}" hidden>
            <input type="text" name="kabupaten_id" disabled value="{{$kecamatan->nama_kecamatan}}">
          </div>
          <div class=" grid grid-cols-1">
            <label for="">Nama Desa</label>
            <input type="text" name="nama_desa" placeholder=" Nama Kabupaten Baru" class=" px-1 py-1">
          </div>
          <div class=" py-1">
            <button class=" bg-blue-700 px-2 py-1 text-white">Simpan</button>
          </div>
        </form>
      </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">

      <div class=" p-4">

        <table class=" w-full sm:h-1/2">
          <thead>
            <tr class=" capitalize border">
              <th>No</th>
              <th>Kecamatan</th>
              <th>Desa</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($desa as $item)

            <tr class=" capitalize border">
              <td class=" text-center">{{ $loop->iteration }}</td>
              <td class=" text-center"><a href="/lokasi-desa/{{$item->id}}">
                  {{ $item->nama_kecamatan }}
                </a>
              </td>
              <td class=" text-center">{{ $item->nama_desa }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>

</x-app-layout>