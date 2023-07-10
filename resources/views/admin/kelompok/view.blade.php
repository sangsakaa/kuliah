<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Kelompok '.$tittle->nama_kelompok)
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      <span class=" capitalize">KELOMPOK {{$tittle->nama_kelompok}} Kec . {{$tittle->nama_kecamatan}} Desa .{{$tittle->nama_desa}} </span>
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <button class="  w-10 justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
        x
      </button>
      <a href="/kelompok-mahasiswa" class=" bg-blue-700 text-white px-2 py-1">Kembali</a>
      <a href="/kolektif-kelompok-mahasiswa/{{$kelompok->id}}" class=" bg-blue-700 text-white px-2 py-1">kolektif</a>
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
            : {{$dataAnggota->count();}}
          </div>

          <div>Jumlah</div>
          <div>
            : L : {{$dataAnggota->where('jenis_kelamin', 'L')->count();}}
            : P : {{$dataAnggota->where('jenis_kelamin', 'P')->count();}}
          </div>
        </div>

      </div>
      <div class="sm:p-6 p-1 mt-2 bg-white  border-gray-200">
        <div class=" overflow-auto ">
          <table class=" w-full text-xs sm:text-sm">
            <thead>
              <tr class=" border">
                <th class=" border">No</th>
                <th class=" border  ">NIM</th>
                <th class=" border  ">Username</th>
                <th class=" border  ">Password</th>
                <th class=" border">Nama Mahasiswa</th>
                <th class=" border">
                  <p class=" sm:block">JK</p>
                </th>
                <th class=" border">Program Studi</th>
                <th class=" border ">Act</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataAnggota as $list)
              <tr>
                <th class=" border px-1 ">{{$loop->iteration}}</th>
                <td class=" border px-1 text-center   ">{{$list->nim}}</td>
                <td class=" border px-1 text-center   ">{{$list->nim.'@uniwa.ac.id'}}</td>
                <td class=" border px-1 text-center   ">{{$list->nim}}</td>
                <td class=" capitalize border px-1 ">{{strtolower($list->nama_mhs)}}</td>
                <td class=" border px-1 text-center ">{{$list->jenis_kelamin}}</td>
                <td class=" border px-1 text-center ">{{$list->prodi}}</td>
                <td class=" border px-1 text-center   ">
                  <div class=" flex gap-2 justify-center ">
                    <div>
                      <form action="/detail-kelompok-mahasiswa/{{$list->id}}" method="post">
                        @csrf
                        @method('delete')
                        <button class=" hover:bg-red-500 font-semibold py-0.5  px-2 text-white bg-red-700">H</button>
                      </form>
                    </div>
                    <!-- Button trigger modal -->
                    <div>
                      <a class=" hover:bg-yellow-200 font-semibold py-0.5  px-2 text-white bg-blue-700" href="/edit-kelompok-mahasiswa/{{$list->id}}">
                        E
                      </a>
                    </div>
                  </div>


                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</x-app-layout>