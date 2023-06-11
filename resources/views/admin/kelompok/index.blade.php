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
          <div class=" sm:grid grid grid-cols-1 sm:grid-cols-2 gap-2">
            <input class=" py-1 " type="text" placeholder="nama kelompok" name="nama_kelompok">
            <select name="dosen_id" id="" class=" py-1">
              <option value="">--Pilih Dosen Pembimbing--</option>
              @foreach($dataDosen as $item)
              <option value="{{$item->id}}">{{$item->nama_dosen}}</option>
              @endforeach
            </select>
            <select name="desa_id" id="" class=" capitalize py-1">
              <option value="">--Pilih Desa--</option>
              @foreach($dataDesa as $item)
              <option value="{{$item->id}}">Desa.{{$item->nama_desa}} Kec .{{$item->nama_kecamatan}} Kab .{{$item->nama_kabupaten}}</option>
              @endforeach
            </select>
            <input class=" py-1 " type="date" placeholder=" tahun" name="tahun">
            <button class=" bg-blue-700 px-2 py-1 text-white ">Simpan</button>
          </div>
        </form>
      </div>
      <div class="p-1 sm:p-6 mt-2 bg-white  border-gray-200">
        <div id="div1" class=" overflow-auto sm:overflow-hidden ">
          <div class=" block sm:hidden w-full text-center">
            <div class=" w-full flex grid-cols-2 gap-2 text-green-700">
              <div class=" py-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="110px" height="110px">
              </div>
              <div class=" w-full ">
                <p class=" text-center text-lg font-semibold uppercase">yayasan perjuangan wahidiyah dan pondok pesantren kedunglo</p>
                <p class="text-center text-2xl font-semibold w-full spaced-text  tracking-widest   ">UNIVERSITAS WAHIDIYAH KEDIRI</p>


                <p class=" text-center  text-4xl  tracking-widest space-x-2   font-semibold font-sans   ">KULIAH KERJA NYATA</p>
                <p class=" text-center text-xs font-semibold">Alamat : Pondok Pesantren Kedunglo Jl.KH. Wachid Hasyim Kota Kediri 64114 Jawa Timur Telp. (0354) 774511, 771018</p>
              </div>
            </div>
            <hr class=" border-b-2 border-b-green-700">
            <hr class=" border-b border-b-green-700">
            <div class=" py-1">
              <span class=" capitalize text-green-700 font-semibold text-center mt-2 ">daftar kelompok dan pembimbing</span>
            </div>
          </div>
          <table class="  w-full sm:w-full">
            <thead>
              <tr class=" border">
                <th class=" border">No</th>
                <th class=" border">Kelompok</th>
                <th class=" border">Pembimbing</th>
                <th class=" border">Alamat</th>
                <th class=" border hidden sm:block">Act</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataKelompok as $team)
              <tr class=" border">
                <th class=" px-1 capitalize border">{{$loop->iteration}}</th>
                <td class=" px-1 capitalize border text-center"><a href="/detail-kelompok-mahasiswa/{{$team->id}}">{{$team->nama_kelompok}}</a></td>
                <td class=" px-1 capitalize border">{{$team->nama_dosen}}</td>
                <td class=" px-1 capitalize border">
                  Desa .{{$team->nama_desa}}
                  Kec.{{$team->nama_kecamatan}}
                  Kab.{{$team->nama_kabupaten}}
                </td>
                <td class=" px-1 capitalize border border-1 text-center hidden sm:block ">
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
        <div>
        </div>
      </div>
    </div>
</x-app-layout>