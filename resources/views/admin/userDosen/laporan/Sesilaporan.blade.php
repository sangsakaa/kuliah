<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Validasi Laporan ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Validasi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" p-2">
    <div class=" p-4   bg-white w-full py-2 px-2 ">
      <div class=" p-1 sm:p-4 grid grid-cols-2 sm:grid-cols-4">
        <div class=" capitalize">NIDN</div>
        <div class=" capitalize"> :
          {{ $dataDosen->nidn ?? 'Data Dosen not found.' }}
        </div>
        <div class=" capitalize">Pembimbing</div>
        <div class=" capitalize"> :
          {{ strtolower(substr($dataDosen->nama_dosen, 0, 20)) }}{{ strtolower(strlen($dataDosen->nama_dosen) > 15 ? '...' : '') }}
        </div>
        <div class=" capitalize">Kelompok</div>
        <div class=" capitalize"> : {{$dataDosen->nama_kelompok}}</div>
      </div>
    </div>
    <div class=" mt-2  bg-white w-full py-2 px-2 ">
      <div class=" sm:justify-end justify-start grid">
        <form action="/sesi-validasi-laporan-mhs" method="get" class=" py-1 ">
          <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari Tanggal </button>
        </form>
      </div>
      <div class=" overflow-auto">
        <table class=" w-full">
          <thead>
            <tr class=" uppercase">
              <th class="border border-green-700 px-2 py-1 text-center">No</th>
              <th class="border border-green-700 px-2 py-1 text-center">Mahasiswa</th>

              <th class="border border-green-700 px-2 py-1 text-center">Tanggal</th>
              <th class="border border-green-700 px-2 py-1 text-center">Jam</th>

              <th class="border border-green-700 px-2 py-1 text-center">LAP</th>
              <th class="border border-green-700 px-2 py-1 text-center">File</th>
              <th class="border border-green-700 px-2 py-1 text-center">Status</th>
            </tr>
          </thead>
          <tbody class=" text-xs">
            @if($dataLaporan->count() != null)
            @foreach($dataLaporan as $data)
            <tr class=" hover:bg-gray-100">
              <td class=" border border-green-700 px-2 py-1 text-center">{{ $loop->iteration }}</td>
              <td class=" capitalize border border-green-700 px-2 py-1 text-left">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  @foreach($data->Mahasiswa as $list)
                  @foreach($list->Mahasiswa as $detil)
                  {{strtolower($detil->nama_mhs)}}
                  @endforeach
                  @endforeach
                  <br>
                  @foreach($data->Mahasiswa as $list)
                  @foreach($list->Mahasiswa as $detil)
                  {{strtolower($detil->prodi)}}
                  @endforeach
                  @endforeach
                </a>

              </td>
              <td class=" border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd , DD MMMM Y') }}
              </td>
              <td class="border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('H:m') }}
              </td>
              <td class=" border border-green-700 px-2 py-1 text-center">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  LAP
                </a>
              </td>
              <td class=" border border-green-700 px-2 py-1 text-center capitalize">
                @foreach($data->laporanMahasiswa as $status)
                <a href="{{asset('storage/' .$status->bukti_laporan) }}" target="_blank" class="text-blue-500 hover:text-blue-800">Lihat</a>
                @endforeach
              </td>
              <td class=" border border-green-700 px-2 py-1 text-center capitalize">
                @foreach($data->laporanMahasiswa as $status)
                @if($status->status_laporan === 'menunggu')
                <span class="text-red-700 font-semibold">{{$status->status_laporan}}</span>
                @elseif($status->status_laporan === 'valid')
                <span class="text-green-700 font-semibold">{{$status->status_laporan}}</span>
                @elseif($status->status_laporan === null)
                <span class="text-black">Belum melakukan laporan</span>
                @else
                {{$status->status_laporan}}
                @endif
                @endforeach
                @if(count($data->laporanMahasiswa) === 0)
                <span class="text-red-700">Invalid</span>
                @endif
            </tr>
            @endforeach
            @else
            <tr>
              <td class=" py-1 border-black text-center text-red-700 uppercase border" colspan="9">
                Belum ada Laporan
              </td>
            </tr>
            @endif

          </tbody>
        </table>
      </div>
    </div>
    <div class=" bg-white  mt-1  ">
      <p class=" px-2">Note Status :</p>
      <div class=" grid  sm:grid grid-cols-2 sm:grid-cols-2 ">
        <div>
          <p class=" w-32 px-4">Valid </p>
        </div>
        <div>
          : Sudah Diperiksa
        </div>
        <div>
          <p class=" px-4">Menunggu </p>
        </div>
        <div>
          : Belum di Validasi
        </div>
      </div>
    </div>
  </div>
</x-app-layout>