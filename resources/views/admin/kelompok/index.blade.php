<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('KELOMPOK MAHASISWA') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="p-1 bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
        Cetak
      </button>
    </div>
  </div>
  <script>
    function printContent(el) {
      var fullbody = document.body.innerHTML;
      var printContent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = fullbody;
    }
  </script>
  <div class=" w-full  px-2 ">
    <div class=" overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-1 sm:p-6 mt-2 bg-white  border-gray-200">
        <form action="/kelompok-mahasiswa" method="post">
          @csrf
          <div class=" sm:flex grid grid-cols-1 gap-2">
            <input class=" py-1 " type="text" placeholder="nama kelompok" name="nama_kelompok">
            <select name="dosen_id" id="" class=" py-1">
              @foreach($dataDosen as $item)
              <option value="{{$item->id}}">{{$item->nama_dosen}}</option>
              @endforeach
            </select>
            <input class=" py-1 " type="text" placeholder=" kecamatan" name="kecamatan">
            <input class=" py-1 " type="date" placeholder=" tahun" name="tahun">
            <button class=" bg-blue-700 px-2 py-1 text-white ">Simpan</button>
          </div>
        </form>
      </div>
      <div class="p-1 sm:p-6 mt-2 bg-white  border-gray-200">
        <div id="div1" class=" sm:overflow-hidden ">
          <table class=" w-full sm:w-full">
            <thead>
              <tr class=" border">
                <th class=" border">No</th>
                <th class=" border">Kelompok</th>
                <th class=" border">Pembimbing</th>
                <th class=" border">Kecamatan</th>
                <th class=" border">Act</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataKelompok as $team)
              <tr class=" border">
                <th class=" px-1 capitalize border">{{$loop->iteration}}</th>
                <td class=" px-1 capitalize border text-center"><a href="/detail-kelompok-mahasiswa/{{$team->id}}">{{$team->nama_kelompok}}</a></td>
                <td class=" px-1 capitalize border">{{$team->nama_dosen}}</td>
                <td class=" px-1 capitalize border">{{$team->kecamatan}}</td>
                <td class=" px-1 capitalize border text-center ">
                  <form action="/kelompok-mahasiswa/{{$team->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button class=" hover:bg-red-500 font-semibold py-0.5  px-2 text-white bg-red-700">H</button>
                  </form>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</x-app-layout>