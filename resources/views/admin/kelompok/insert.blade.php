<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <span class="  uppercase">Kolektif KELOMPOK {{$kelompok->nama_kelompok}} Kec . {{$kelompok->kecamatan}}</span>
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <button class="  w-10 justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
        x
      </button>
      <a href="/detail-kelompok-mahasiswa/{{$kelompok->id}}" class=" bg-blue-700 text-white px-2 py-1">Kembali</a>
      <!-- <a href="/kelompok-mahasiswa/{{$kelompok->id}}" class=" bg-blue-700 text-white px-2 py-1">kolektif</a> -->
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
  <div id="div1" class=" w-full py-2 px-2 ">
    <div class=" overflow-hidden shadow-sm sm:rounded-lg">
      <div class="sm:p-6 p-1 bg-white  border-gray-200">
        <div class=" grid grid-cols-2 sm:grid-cols-4">
          <div>Kelompok</div>
          <div>: {{$tittle->nama_kelompok}}</div>
          <div>Dosen Pembimbing</div>
          <div class=" sm:text-sm text-xs">: {{strlen($tittle->nama_dosen) > 20 ? substr($tittle->nama_dosen, 0, 20) . "..." : $tittle->nama_dosen;}}</div>
          <div>Jumlah Anggota</div>
          <div>
            : {{$dataMHS->count();}}
          </div>
          <div>Jumlah</div>
          <div>
            : L : {{$dataMHS->where('jenis_kelamin', 'L')->count();}}
            : P : {{$dataMHS->where('jenis_kelamin', 'P')->count();}}
          </div>
        </div>

      </div>
      <div class="sm:p-6 p-1 mt-2 bg-white  border-gray-200">
        <div class=" overflow-auto ">
          <form action="/kolektif-kelompok-mahasiswa/{{$kelompok->id}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="text" class=" hidden py-1" name="kelompok_id" value="{{$kelompok->id}}" id="">
            <button class=" py-1 px-2 bg-blue-700 text-white capitalize">simpan</button>
            <table class=" w-full text-xs sm:text-sm mt-1">
              <thead>
                <tr class=" border">
                  <th class=" border"> <input type="checkbox" name="" id=""></th>
                  <th class=" border">No</th>
                  <th class=" border sm:block hidden ">NIM</th>
                  <th class=" border">Nama Mahasiswa</th>
                  <th class=" border">

                    <p class=" sm:block">JK</p>
                  </th>
                  <th class=" border">Program Studi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($dataMHS as $list)
                <tr class=" hover:bg-gray-100">
                  <th class=" border px-1 "><input type="checkbox" name="mahasiswa[]" value="{{$list->id}}" multiple></th>
                  <th class=" border px-1 ">{{$loop->iteration}}</th>
                  <td class=" border px-1 text-center sm:block hidden   ">{{$list->nim}}</td>
                  <td class=" capitalize border px-1 ">{{strtolower($list->nama_mhs)}}</td>
                  <td class=" border px-1 text-center ">{{$list->jenis_kelamin}}</td>
                  <td class=" border px-1  text-center">
                    @if ($list->prodi === 'S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)')
                    S1 HKI
                    @elseif ($list->prodi === 'S1 Pendidikan Guru Pendidikan Anak Usia Dini')
                    S1 PG PAUD
                    @else
                    {{ $list->prodi }}
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
</x-app-layout>