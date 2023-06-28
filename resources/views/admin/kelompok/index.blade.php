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
      <div id="div1" class="p-1 sm:p-6 mt-2 bg-white  border-gray-200">
        <div class=" overflow-auto sm:overflow-hidden ">
          <div class=" block sm:hidden w-full text-center">
            <div class=" w-full flex grid-cols-2 gap-2 text-green-700">
              <div class=" py-4">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" width="110px" height="110px">
              </div>
              <div class=" w-full ">
                <p class=" text-center text-lg font-semibold uppercase">yayasan perjuangan wahidiyah dan pondok pesantren kedunglo</p>
                <p class="text-center text-2xl font-semibold w-full spaced-text  tracking-widest   ">UNIVERSITAS WAHIDIYAH KEDIRI</p>
                <p class=" text-center  text-4xl  tracking-widest space-x-2  font-black    font-sans    ">KULIAH KERJA NYATA</p>
                <p class=" text-center text-xs font-semibold">Alamat : Pondok Pesantren Kedunglo Jl.KH. Wachid Hasyim Kota Kediri 64114 Jawa Timur Telp. (0354) 774511, 771018</p>
              </div>
            </div>
            <hr class=" border-b-2 border-b-green-700">
            <hr class=" border-b border-b-green-700">
            <div class=" py-1">
              <span class="  uppercase text-green-700 font-semibold text-center mt-2 ">daftar kelompok dan pembimbing</span>
            </div>
          </div>
          <table class="  w-full sm:w-full">
            <thead>
              <tr class=" border border-black">
                <th rowspan="2" class=" border border-black">No</th>
                <th rowspan="2" class=" border border-black">Kel</th>
                <th rowspan="2" class=" border border-black">NIDN</th>
                <th rowspan="2" class=" border border-black">Pembimbing</th>
                <th rowspan="2" class=" border border-black">Alamat</th>
                <th class=" border border-black" colspan="3">Keterangan</th>
                <th rowspan="3" class=" border border-black hidden sm:block">Act</th>
              </tr>
              <tr>
                <th class=" border border-black">Jml</th>
                <th class=" border border-black">L</th>
                <th class=" border border-black">P</th>

              </tr>

            </thead>
            <tbody>
              @foreach($dataKelompok as $team)
              <tr class=" border border-black text-sm">
                <th class=" px-1 capitalize border border-black">{{$loop->iteration}}</th>
                <td class=" px-1 capitalize border border-black text-center"><a href="/detail-kelompok-mahasiswa/{{$team->id}}">{{$team->nama_kelompok}}</a></td>
                <td class=" px-1 capitalize border border-black text-center">{{$team->nidn}}</td>
                <td class=" px-1 capitalize border border-black ">{{strtolower($team->nama_dosen)}}</td>
                <td class=" px-1 capitalize border border-black text-sm">
                  Desa .{{$team->nama_desa}}
                  Kec.{{$team->nama_kecamatan}}
                  Kab.{{$team->nama_kabupaten}}
                </td>
                <td class=" text-center px-1 capitalize border border-black text-sm">

                  {{$team->JmlMahasiswa->count()}}
                </td>
                <td class=" text-center px-1 capitalize border border-black text-sm">
                  @php
                  $jumlahPria = 0;
                  $jumlahWanita = 0;
                  @endphp

                  @foreach($team->JmlMahasiswa as $list)
                  @foreach($list->Mahasiswa as $org)
                  @if($org->jenis_kelamin == 'L')
                  @php $jumlahPria++; @endphp
                  @elseif($org->jenis_kelamin == 'P')
                  @php $jumlahWanita++; @endphp
                  @endif
                  @endforeach
                  @endforeach
                  {{ $jumlahPria }} <br>
                </td>
                <td class=" text-center px-1 capitalize border border-black text-sm">
                  @php
                  $jumlahPria = 0;
                  $jumlahWanita = 0;
                  @endphp

                  @foreach($team->JmlMahasiswa as $list)
                  @foreach($list->Mahasiswa as $org)
                  @if($org->jenis_kelamin == 'L')
                  @php $jumlahPria++; @endphp
                  @elseif($org->jenis_kelamin == 'P')
                  @php $jumlahWanita++; @endphp
                  @endif
                  @endforeach
                  @endforeach

                  {{ $jumlahWanita }}
                </td>
                <td class=" px-1 capitalize border  border-1 text-center hidden sm:block ">
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
        <div class=" block sm:hidden">
          <table class=" mt-2 w-full">
            <thead>
              <tr class=" border">

                <th class=" border border-black px-1">Kecamatan</th>
                <th class=" border border-black px-1">Jumlah</th>
                <th class=" border border-black px-1">No</th>
                <th class=" border border-black px-1">Desa</th>
                <th class=" border border-black px-1">Kelompok</th>
                <th class=" border border-black px-1">Dosen</th>
              </tr>
            </thead>
            <tbody>
              @php
              $previousKecamatan = null;
              @endphp
              @foreach($dataKelompok->groupBy('nama_kecamatan') as $kecamatan => $data)
              @foreach($data as $item)

              @php
              $rowspan = $kecamatan === $previousKecamatan ? 0 : $data->count();
              $previousKecamatan = $kecamatan;
              @endphp
              <tr class=" border border-black ">

                @if($rowspan > 0)
                <td class=" border border-black px-1 text-center" rowspan="{{ $rowspan }}">{{ $kecamatan }}</td>
                @endif
                @if($rowspan > 0)
                <td class=" border border-black px-1 text-center" rowspan="{{ $rowspan }}">{{ $data->count() }}</td>
                @endif
                <td class=" border border-black px-1 text-center">{{ $loop->iteration }}</td>
                <td class=" border border-black px-1 text-center">{{ $item->nama_desa }}</td>
                <td class=" border border-black px-1 text-center">{{ $item->nama_kelompok }}</td>
                <td class=" border border-black px-1 text-left capitalize">{{ strtolower($item->nama_dosen) }}</td>
              </tr>
              @endforeach
              @endforeach
            </tbody>
          </table>



        </div>
      </div>
    </div>
</x-app-layout>