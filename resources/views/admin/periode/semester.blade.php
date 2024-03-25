<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Semester') }} <span class=" capitalize"></span>
    </h2>
  </x-slot>
  <div class=" w-full p-2  ">
    <div class=" grid grid-cols-2 gap-2 ">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
        <div class=" p-4">
          <form action="/semester" method="post">
            @csrf
            <div class=" grid grid-cols-1">
              <label for="">Nama Kecamatan</label>

              <input type="text" name="semester" value="">
            </div>
            <div class=" grid grid-cols-1">
              <label for="">Nama Desa</label>
              <input type="text" name="nama_semester" placeholder=" Nama Kabupaten Baru" class=" px-1 py-1">
            </div>
            <div class=" py-1">
              <button class=" bg-blue-700 px-2 py-1 text-white">Simpan</button>
              <a href="/periode-semester" class=" bg-blue-700 py-1 px-2 text-white">periode</a>
            </div>
          </form>
        </div>
      </div>
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
        <div class=" p-4">
          <table class=" w-full">
            <thead>
              <tr class=" capitalize border">
                <th>No</th>
                <th>Semester</th>
                <th>Nama Semester</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($semester as $item)
              <tr class=" capitalize border">
                <td class=" text-center">{{ $loop->iteration }}</td>
                <td class=" text-center">
                  {{ $item->semester }}
                </td>
                <td class=" text-center">{{ $item->nama_semester }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>

      </div>
    </div>


</x-app-layout>