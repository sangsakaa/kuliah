<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Presensi Harian') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2  ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2 flex grid-cols-2 gap-2 justify-center items-center sm:justify-start sm:items-start">
        <div class=" ">
          <form action="/sesi-harian" method="post">
            @csrf
            <input type="hidden" name="kelompok_id" value=" {{$User->kelompok_id}}">
            <input type="hidden" name="tanggal" value="{{ $tanggal->toDateString() }}">
            <button class=" bg-blue-700 px-2 py-1 text-white ">Sesi Presensi</button>
          </form>
        </div>
        <div class=" ">
          <form action="/sesi-harian" method="get">
            <input type="date" name="tanggal" class="py-1 dark:bg-dark-bg" value="{{ $tanggal->toDateString() }}">
            <button class=" bg-red-600 py-1 dark:bg-purple-600  rounded-sm hover:bg-purple-600 text-white px-2 ">
              Cari
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm mt-2 ">
      <div class=" overflow-auto w-full p-2">
        <div class=" py-2 block sm:hidden justify-center items-center grid">
          Daftar Laporan Presensi Harian
        </div>
        <table class=" w-full">
          <thead>
            <tr class="  uppercase text-sm">
              <th rowspan="2" class=" border">No</th>
              <th rowspan="2" class=" border">Absen</th>
              <th rowspan="2" class=" border">Hari</th>
              <th rowspan="2" class=" border">tanggal</th>
              <th rowspan="2" class=" border">Kel</th>
              <th colspan="4" class=" border">Keterangan</th>
            </tr>
            <tr class="  uppercase text-sm">
              <th class=" border">H</th>
              <th class=" border">I</th>
              <th class=" border">S</th>
              <th class=" border">A</th>
            </tr>
          </thead>
          <tbody>
            @if($SesiHarian->count()!= null)
            @foreach($SesiHarian as $sesi)
            <tr>
              <td class=" py-1 border  text-center">{{$loop->iteration}}</td>
              <td class=" border  text-center"><a href="/daftar-sesi-harian/{{$sesi->id}}" class=" bg-blue-700 px-2  py-1 text-white">absen</a></td>
              <td class=" border  text-center"><a href="/daftar-sesi-harian/{{$sesi->id}}">
                  {{ \Carbon\Carbon::parse($sesi->tanggal)->isoFormat('dddd ') }}
                </a></td>
              <td class=" border  text-center"><a href="/daftar-sesi-harian/{{$sesi->id}}">
                  {{ \Carbon\Carbon::parse($sesi->tanggal)->isoFormat(' DD MMMM') }}
                </a></td>
              <td class=" border  text-center">{{$sesi->nama_kelompok}}</td>
              <td class=" border  text-center">
                {{$sesi->Kelompok->where('keterangan','hadir')->count()}}
              </td>
              <td class=" border  text-center">
                {{$sesi->Kelompok->where('keterangan','izin')->count()}}
              </td>
              <td class=" border  text-center">
                {{$sesi->Kelompok->where('keterangan','sakit')->count()}}
              </td>
              <td class=" border  text-center">
                {{$sesi->Kelompok->where('keterangan','alfa')->count()}}
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="9" class=" border text-center">
                <span class=" text-red-700  uppercase text-sm">Belum ada sesi</span>
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>