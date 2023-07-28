<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Time Line ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Time Line') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white p-2 shadow-sm sm:rounded-lg">
      <div class=" grid justify-end p-2">
        <form action="/cek-valid-dosen" method="get" class=" py-1 ">
          <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari Tanggal </button>
        </form>
      </div>
      <table class=" w-full">
        <thead>
          <tr class=" capitalize">
            <th class=" border border-black px-1">Tanggal Kirim</th>
            <th class=" border border-black px-1">on time</th>
            <th class=" border border-black px-1">Created_at</th>
            <th class=" border border-black px-1">Updated_at</th>
            <th class=" border border-black px-1">Mahasiswa</th>
            <th class=" border border-black px-1">Status</th>
          </tr>
        </thead>
        <tbody>
          @if($dataLap->count()!== null)
          @foreach($dataLap as $item)
          <tr class=" border border-black">
            <td class=" border border-black text-center px-1">
              <a href="/daftar-validasi-laporan-mhs/{{$item->id}}">
                {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, DD MMMM Y') }}
              </a>
            </td>
            <td class="border border-black text-center px-1">
              {{ \Carbon\Carbon::parse($item->tanggal)->diff(\Carbon\Carbon::parse($item->created_at))->format('%d hari') }}
            </td>
            <td class=" border border-black text-center px-1">
              {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, DD MMMM Y') }}
            </td>
            <td class=" border border-black text-center px-1">
              {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('dddd, DD MMMM Y') }}
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