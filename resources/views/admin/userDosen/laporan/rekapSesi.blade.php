<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Time Line') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white grid grid-cols-2 shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/time-line" method="get" class="w-full">
          <input type="month" name="bulan" class=" py-1 dark:bg-dark-bg" value="{{ $bulan->format('Y-m') }}">
          <button class=" bg-red-600 py-1 mt-1 my-1 sm:w-40 rounded-sm hover:bg-purple-600 text-white px-4 ">
            Pilih Bulan
          </button>
        </form>
      </div>
      <div class=" grid justify-end p-2">
        <form action="/time-line" method="get" class=" py-1 ">
          <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari Tanggal </button>
        </form>
      </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <hr class=" border border-b-2">
        <div class=" overflow-auto">
          <table class=" w-full border border-green-800">
            <thead>
              <tr class="border bg-green-200  text-black text-xs sm:text-sm ">
                <th class="border border-green-800 px-1 w-24 uppercase " rowspan="2">Kelompok</th>
                <th class="border border-green-800 px-1 py-1  uppercase  text-black " colspan="{{ $periodeBulan->count() }}">
                  {{$bulan->isoFormat('MMMM YYYY')}}

                </th>
              </tr>
              <tr class="border border-green-800 bg-green-200  text-black text-xs sm:text-sm ">
                @foreach ($periodeBulan as $hari)
                <th class=" py-1 border w-8 border-green-800 {{ $hari->isSunday() ? " border-green-800 bg-green-800 text-white "
                                    : "" }}">{{ $hari->day }}</th>
                @endforeach
              </tr>
            </thead>
            <tbody class=" text-sm border border-green-800">
              @foreach ($dataRekapSesi as $rekapSesi)
              <tr class=" border border-green-800 text-xs sm:text-sm even:bg-green-100 hover:bg-gray-200 ">
                <th class="border border-green-800 text-center uppercase py-1 ">
                  {{ $rekapSesi['kelompok']->nama_kelompok }}
                </th>
                @foreach ($rekapSesi['sesiPerBulan'] as $sesi)
                <td class="border border-green-800  {{ $sesi['hari']->isSunday() ? " bg-green-800 text-white" : "" }}">
                  <div class="grid justify-items-center  ">
                    @if (!$sesi['data'])
                    <span class=" text-red-700 font-semibold">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </span>

                    @elseif ($sesi['data'])
                    <span class=" text-green-800">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                      </svg>
                    </span>
                    @endif
                  </div>
                </td>
                @endforeach
              </tr>
              @endforeach
            </tbody>
        </div>
        </table>
      </div>

      <div class=" py-2">
        <table class=" w-full border border-green-800">
          <thead>
            <tr class="border bg-green-200  text-black text-xs sm:text-sm ">
              <th class="border border-green-800  uppercase " rowspan="2">no</th>
              <th class="border border-green-800 px-1 uppercase " rowspan="2">Mahasiswa</th>
              <th class="border border-green-800  py-1  uppercase  text-black " colspan="{{ $periodeBulan->count() }}">
                {{$bulan->isoFormat('MMMM YYYY')}}

              </th>
            </tr>
            <tr class="border border-green-800 bg-green-200  text-black text-xs sm:text-sm ">
              @foreach ($periodeBulan as $hari)
              <th class=" py-1 border  border-green-800 {{ $hari->isSunday() ? " border-green-800 bg-green-800 text-white "
                                    : "" }}">{{ $hari->day }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody class=" text-sm border border-green-800">
            @foreach ($dataRekapSesiPerAnggota as $rekapSesi)
            <tr class=" border border-green-800 text-xs sm:text-sm even:bg-green-100 hover:bg-gray-200 ">
              <th>
                {{$loop->iteration}}
              </th>
              <th class="border border-green-800 text-left capitalize py-1 ">
                {{ strtolower($rekapSesi['kelompok']->nama_mhs )}}
              </th>
              @foreach ($rekapSesi['sesiPerBulan'] as $sesi)
              <td class="border border-green-800  {{ $sesi['hari']->isSunday() ? " bg-green-800 text-white" : "" }}">
                <div class="grid justify-items-center  ">
                  @if (!$sesi['data'])
                  <span class=" text-red-700 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </span>

                  @elseif ($sesi['data'])
                  <span class=" text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                  </span>
                  @endif
                </div>
              </td>
              @endforeach
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class=" p-2 mt-4">
      <table class=" w-full">
        <thead>
          <tr class=" capitalize">
            <th class=" border px-1">Tanggal Kirim</th>
            <th class=" border px-1">on time</th>
            <th class=" border px-1">Created_at</th>
            <th class=" border px-1">Updated_at</th>
            <th class=" border px-1">Mahasiswa</th>
            <th class=" border px-1">Status</th>
          </tr>
        </thead>
        <tbody>
          @if($dataLap->count()!== null)
          @foreach($dataLap as $item)
          <tr>
            <td class=" border text-center px-1">

              <a href="/daftar-validasi-laporan-mhs/{{$item->id}}">
                {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd, DD MMMM Y') }}
              </a>
            </td>
            <td class="border text-center px-1">
              {{ \Carbon\Carbon::parse($item->tanggal)->diff(\Carbon\Carbon::parse($item->created_at))->format('%d hari') }}
            </td>

            <td class=" border text-center px-1">
              {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('dddd, DD MMMM Y') }}
            </td>

            <td class=" border text-center px-1">
              {{ \Carbon\Carbon::parse($item->updated_at)->isoFormat('dddd, DD MMMM Y') }}
            </td>
            <td class=" border text-left px-1">
              {{$item->nama_mhs}}
            </td>
            <td class=" border text-center px-1 capitalize ">
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
          <tr>
            <td colspan="6" class=" border text-center text-red-700 capitalize text-sm font-semibold">
              tidak ada laporan
            </td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</x-app-layout>