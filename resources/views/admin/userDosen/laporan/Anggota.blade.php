<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Daftar Anggota ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Daftar Data Anggota') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class=" py-1">
      <div class=" bg-white py-1">
        <div class=" p-2  grid grid-cols-2 sm:grid-cols-4     ">
          <div class="">NIDN</div>
          <div class=" "> :
            {{ $dataDosen->nidn ?? 'Data Dosen not found.' }}
          </div>
          <div class="">Pembimbing</div>
          <div class=" "> :
            {{strlen($dataDosen->nama_dosen) > 25 ? substr($dataDosen->nama_dosen, 0, 25) . "..." : $dataDosen->nama_dosen;}}
          </div>
          <div class="">Kelompok</div>
          <div class=""> : {{$dataDosen->nama_kelompok}}</div>
          <div class="">Jumlah</div>
          <div class="">
            : L : {{$dataAnggota->where('jenis_kelamin', 'L')->count();}}
            : P : {{$dataAnggota->where('jenis_kelamin', 'P')->count();}}
          </div>
        </div>
      </div>
    </div>
    <div class=" py-1">
      <div class=" bg-white py-1">
        <div class=" p-2  grid grid-cols-2 sm:grid-cols-4     ">
          <span class=" py-1 ">Periode Aktif</span> <span class=" rounded-lg px-3 py-1 bg-blue-700 text-white text-center">{{$dataPeriode->nama_periode}}</span>
        </div>
      </div>
    </div>
    <div class=" p-2 mt-2 bg-white">
      <div class=" overflow-auto">
        <table class=" w-full">
          <thead>
            <tr class=" px-1 border-black border">
              <th class=" px-1 border-black border">No</th>
              <!-- <th class=" px-1 border-black border">NIM</th> -->
              <th class=" px-1 border-black border">Nama</th>
              <th class=" px-1 border-black border capitalize">
                <span class=" sm:block">JK</span>
                <span class=" hidden">Jk</span>
              </th>

            </tr>
          </thead>
          <tbody>
            @foreach($dataAnggota as $list)
            <tr>
              <td class=" border border-black px-1 text-center">{{$loop->iteration}}</td>
              <!-- <td class=" border border-black px-1 capitalize ">
                <p>{{strtolower($list->nim)}}</p>
                </p>
              </td> -->
              <td class=" border border-black px-1 capitalize">
                {{strtolower($list->nama_mhs)}} <br>
                @if ($list->prodi === 'S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)')
                S1 HKI
                @elseif ($list->prodi === 'S1 Pendidikan Guru Pendidikan Anak Usia Dini')
                S1 PG PAUD
                @else
                {{ $list->prodi }}
                @endif

              </td>
              <td class=" border border-black px-1 capitalize text-center">{{$list->jenis_kelamin}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</x-app-layout>