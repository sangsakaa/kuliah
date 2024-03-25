<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Periode Semester') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 gap-2 grid  ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
      <div class=" p-4">
        <form action="/semester" method="post">
          @csrf
          <div class=" grid grid-cols-1">
            <label for="">Semester</label>
            <select name="semester_id" id="">
              <option value="">Pilih Semester</option>
              @foreach($semester as $list)
              <option value="{{$list->id}}">{{$list->nama_semester}}</option>
              @endforeach
            </select>

          </div>
          <div class=" grid grid-cols-1">
            <label for=""> nama_periode</label>
            <input type="text" name="nama_periode" placeholder=" Nama Kabupaten Baru" class=" px-1 py-1">
          </div>
          <div class=" py-1">
            <button class=" bg-blue-700 px-2 py-1 text-white">Simpan</button>
            <a href="/semester" class=" bg-blue-700 py-1 px-2 text-white">semester</a>
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
              <th>Semester</th>
              <th>Nama Semester</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($periode_semester as $item)

            <tr class=" capitalize border">
              <td class=" text-center">{{ $loop->iteration }}</td>
              <td class=" text-center">
                {{ $item->nama_semester }}
              </td>
              <td class=" text-center">{{ $item->nama_periode }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>

</x-app-layout>