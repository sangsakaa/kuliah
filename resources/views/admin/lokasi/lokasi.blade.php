<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Wilayah') }} {{$provinsi}}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 gap-2 grid  ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
      <div class=" p-4">
        <form action="/lokasi-kabupaten" method="post">
          @csrf
          <div class=" grid grid-cols-1">
            <label for="">Nama Provinsi</label>
            <select name="provinsi_id" id="">
              <option value="">Pilih Provinsi</option>
              @foreach ($provinsis as $provinsi)
              <option value="{{$provinsi->id}}">{{$provinsi->nama_provinsi}}</option>
              @endforeach
            </select>
          </div>
          <div class=" grid grid-cols-1">
            <label for="">Nama Kabupaten</label>
            <input type="text" name="nama_kabupaten" placeholder=" Nama Kabupaten Baru" class=" px-1 py-1">
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
              <th>Provinsi</th>
              <th>Kabupaten / Kota</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($kab as $item)
            <tr class=" capitalize border even:bg-slate-100">
              <td class=" text-center">{{ $loop->iteration }}</td>
              <td class=" text-center">{{ $item->nama_provinsi }}</td>
              <td class=" text-center"><a href="/lokasi-kecamatan/{{$item->id}}">
                  {{ $item->nama_kabupaten }}
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>

</x-app-layout>