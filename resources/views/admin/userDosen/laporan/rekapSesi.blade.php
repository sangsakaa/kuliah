<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Time Line') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/time-line" method="get" class="w-full">
          <input type="month" name="bulan" class=" py-1 dark:bg-dark-bg" value="{{ $bulan->format('Y-m') }}">
          <button class=" bg-red-600 py-1 mt-1 my-1 sm:w-40 rounded-sm hover:bg-purple-600 text-white px-4 ">
            Pilih Bulan
          </button>
        </form>
      </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <hr class=" border border-b-2">
        <table class="table-fixed w-full border border-green-800">
          <thead>
            <tr class="border bg-green-200  text-black text-xs sm:text-sm">
              <th class="border border-green-800 px-1 w-24 " rowspan="2">Kelompok</th>
              <th class="border border-green-800 px-1  uppercase  text-black " colspan="{{ $periodeBulan->count() }}">
                {{$bulan->isoFormat('MMMM YYYY')}}
              </th>
            </tr>
            <tr class="border border-green-800 bg-green-200  text-black text-xs sm:text-sm ">
              @foreach ($periodeBulan as $hari)
              <th class="border w-8 border-green-800 {{ $hari->isSunday() ? " border-green-800 bg-green-800 text-white "
                                    : "" }}">{{ $hari->day }}</th>
              @endforeach
            </tr>
          </thead>
          <tbody class=" text-sm border border-green-800">

            @foreach ($dataRekapSesi as $rekapSesi)
            <tr class=" border border-green-800 text-xs sm:text-sm even:bg-green-100 hover:bg-gray-200">
              <th class="border border-green-800 text-center ">Kelompok {{ $rekapSesi['kelompok']->nama_kelompok }}</th>
              @foreach ($rekapSesi['sesiPerBulan'] as $sesi)
              <td class="border border-green-800 {{ $sesi['hari']->isSunday() ? " bg-green-800 text-white" : "" }}">
                <div class="grid justify-items-center">
                  @if (!$sesi['data'])
                  @elseif ($sesi['data'])
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                  </svg>

                  @else
                  x
                  @endif
                </div>
              </td>
              @endforeach
            </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <div>


      </div>
    </div>
</x-app-layout>