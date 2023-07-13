<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Laporan Daftar Kelompok') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="  flex bg-blue-300">
        <div>
          <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
            Cetak
          </button>
        </div>
        <div>

        </div>
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
    <div class="p-4 mt-2 bg-white  border-gray-200">
      <div id="div1" class=" overflow-auto">
        <table class="  w-full">
          <thead>
            <tr>
              <th class="border border-black px-1 ">No</th>
              <th class="border border-black px-1">Pembimbing</th>
              <th class="border border-black px-1">Kel</th>
              <th class="border border-black px-1">Alamat</th>
              <th class="border border-black px-1">No</th>
              <th class="border border-black px-1">Detail Anggota</th>
              <th class="border border-black px-1">Prodi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($LapMhs as $list)
            <tr class=" text-sm">
              <td class="border border-b-2 border-black px-1 text-center py-2" rowspan="{{count($list->JmlMahasiswa) + 1}}">{{$loop->iteration}}</td>
              <td class="border border-b-2 border-black px-1 capitalize" rowspan="{{count($list->JmlMahasiswa) + 1}}">{{strtolower($list->nama_dosen)}}</td>
              <td class="border border-b-2 border-black px-1 text-center" rowspan="{{count($list->JmlMahasiswa) + 1}}">{{$list->nama_kelompok}}</td>
              <td class="border border-b-2 border-black px-1  capitalize" rowspan="{{count($list->JmlMahasiswa) + 1}}">
                Desa.{{$list->nama_desa}} - Kec.{{$list->nama_kecamatan}} <br> Kab. {{$list->nama_kabupaten}}
              </td>
            </tr>
            @foreach($list->JmlMahasiswa as $item)
            <tr class=" text-sm ">
              <th class=" border border-black text-center">
                {{$loop->iteration}}
              </th>
              @foreach($item->DetailMahasiswa as $index=>$detail)
              <td class=" border border-black capitalize px-1">
                {{strtolower($detail->nama_mhs)}} <br>
              </td>
              @if($index === 0)
              <td class=" border border-black text-center" rowspan="{{count($item->DetailMahasiswa)}}">

                @if ($detail->prodi === 'S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)')
                S1 HKI
                @elseif ($detail->prodi === 'S1 Pendidikan Guru Pendidikan Anak Usia Dini')
                S1 PG PAUD
                @else
                {{ $detail->prodi }}
                @endif
              </td>
              @endif
            </tr>
            @endforeach
            @endforeach
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
  </div>
</x-app-layout>