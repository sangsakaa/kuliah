<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Update Kelompok')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Update Data Kelompok') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2  ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
      <form action="/edit-kelompok/{{$kelompok->id}}" method="post">
        @csrf
        @method('patch')
        <div class=" grid grid-cols-1 p-2">
          <div class=" grid grid-cols-1">
            <label for="">Nama Kelompok</label>
            <input type="text" name="nama_kelompok" class="py-1 px-2" value="{{$kelompok->nama_kelompok}}">
          </div>
          <div class=" grid grid-cols-1">
            <label for="">Dosen Pembimbing Lapangan</label>
            <select name="dosen_id" id="" class="py-1 ">
              @foreach($dataDosen as $kel)
              <option value="{{$kel->id}}" {{$kelompok->dosen_id == $kel->id ? 'selected' : ''}}>
                {{$kel->nama_dosen}}
              </option>
              @endforeach
            </select>
          </div>
          <div class=" grid grid-cols-1">
            <label for="">Desa</label>
            <select name="desa_id" id="" class="py-1 capitalize ">
              @foreach($dataDesa as $kel)
              <option value="{{$kel->id}}" {{$kelompok->desa_id == $kel->id ? 'selected' : ''}}>
                Desa {{$kel->nama_desa}} Kec.{{$kel->nama_kecamatan}} Kab. {{$kel->nama_kabupaten}}
              </option>
              @endforeach
            </select>
            <div class=" py-1">
              <a href="/kelompok-mahasiswa" class=" bg-blue-700 px-1 py-1 text-white">Batal</a>
              <button class=" bg-blue-700 px-1 py-1 text-white">simpan</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</x-app-layout>