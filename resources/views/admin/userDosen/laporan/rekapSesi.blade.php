<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Rekap Lap ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Rekap Laporan Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white grid sm:grid grid-cols-1 sm:grid-cols-2 shadow-sm sm:rounded-lg p-2 ">
      <!-- <div class=" px-2">
        <form action="/rekap-laporan-mhs" method="get" class="w-full">
          <input type="month" name="bulan" class=" py-1 dark:bg-dark-bg" value="{{ $bulan->format('Y-m') }}">
          <button class=" bg-red-600 py-1 mt-1 my-1 sm:w-40 rounded-sm hover:bg-purple-600 text-white px-4 ">
            Pilih Bulan
          </button>
        </form>
      </div> -->
      <div class=" grid px-2">
        <form action="/rekap-laporan-mhs" method="get" class=" py-1 ">
          <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari Tanggal </button>
        </form>
      </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg   mt-2 p-2">
      <div class=" overflow-auto  px-2 py-1 ">
        <table class=" w-full">
          <thead>
            <tr class=" capitalize">
              <th class=" border border-black px-1">Hari</th>
              <th class=" border border-black px-1">Tanggal</th>

              <th class=" border border-black px-1 w-1/2">Mahasiswa</th>
              <th class=" border border-black px-1">Status</th>
            </tr>
          </thead>
          <tbody>
            @if($dataLap->count() != null)
            @foreach($dataLap as $item)
            <tr class=" border border-black">
              <td class=" border border-black text-left px-1">

                <a href="/daftar-validasi-laporan-mhs/{{$item->id}}">
                  {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd') }}
                </a>
              </td>
              <td class=" border border-black text-left px-1">

                <a href="/daftar-validasi-laporan-mhs/{{$item->id}}">
                  {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('DD MMMM Y') }}
                </a>
              </td>
              <td class=" border border-black text-left px-1">
                {{$item->nama_mhs}}
              </td>
              <td class=" border border-black text-center px-1 capitalize ">
                @if($item->status_laporan === 'menunggu')
                <span class="text-red-700 font-semibold">{{$item->status_laporan}}</span>
                @elseif($item->status_laporan === 'valid')
                <span class="text-green-700 font-semibold">{{$item->status_laporan}}</span>
                @elseif($item->status_laporan === null)
                <span class="text-black">Belum laporan</span>
                @else
                {{$item->status_laporan}}
                @endif
              </td>
            </tr>
            @endforeach
            @else
            <tr class=" border border-black">
              <td colspan="6" class=" border border-black text-center text-red-700 capitalize text-sm font-semibold">
                tidak ada laporan
              </td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>
</x-app-layout>