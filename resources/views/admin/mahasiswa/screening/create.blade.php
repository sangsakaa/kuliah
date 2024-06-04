<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('form screnning') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-6">
        <form action="/form-screening-mahasiswa" method="post">
          @csrf
          <div class=" grid grid-cols-1 gap-2 sm:grid-cols-2">
            <label for="">Pentanyaan</label>
            <textarea required name="soal" id=""></textarea>
            <label for="">Kategori</label>
            <select id="" class=" py-1 px-1" name="kategori">
              <option value=""> -- Pili Kategori -- </option>
              <option value="2">2</option>
              <option value="3">3</option>
            </select>
            <label for="">Pentanyaan</label>
            <button class=" py-1 px-2 bg-blue-700 text-white">simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class=" w-full mb-2  px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-6">
        <table class=" w-full border">
          <thead>
            <tr class=" border">
              <th>Pentanyaan</th>
              <th>Kategori</th>
            </tr>
          </thead>
          <tbody>
            @foreach($screening as $list)
            <tr class=" border">
              <td>{{$list->soal}}</td>
              <td>{{$list->kategori}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>