<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Update Kelompok')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Update Data Kelompok') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/edit-kelompok-mahasiswa/{{$anggota_Kelompok->id}}" method="post">
          @csrf
          @method('patch')
          <div class=" grid grid-cols-1 gap-2 w-1/4">
            <label for="" class=" ">Kelompok</label>

            <select name="kelompok_id" id="" class="py-1 ">
              @foreach($dataKelompok as $kel)
              <option value="{{$kel->id}}" {{$anggota_Kelompok->kelompok_id == $kel->id ? 'selected' : ''}}>
                {{$kel->nama_kelompok}}
              </option>
              @endforeach
            </select>
            <label for="" class=" w-1/4">Mahasiswa</label>

            <input type="text" nama="mahasiswa_id" class=" py-1 px-1" value="{{$Mhs}}">
            <input type="text" nama="mahasiswa_id" class=" py-1 px-1" value="{{$anggota_Kelompok->mahasiswa_id}}">
            <div class=" flex grid-cols-2  gap-2">
              <div>
                <button class=" py-1 px-2 bg-blue-700 text-white">update</button>
              </div>
              <div class=" mt-1">
                <a href="/detail-kelompok-mahasiswa/{{$anggota_Kelompok->kelompok_id}}" class=" mt-2 py-1 px-2 bg-blue-700 text-white">Kembali</a>
              </div>

            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>