<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Detail Laporan ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Detail Laporan Mahasiswa') }}
    </h2>
  </x-slot>
  <script>
    function printContent(el) {
      var fullbody = document.body.innerHTML;
      var printContent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = fullbody;
    }
  </script>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2">
        <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
          Cetak
        </button>
      </div>
    </div>
  </div>
  <div id="div1" class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2 justify-center grid">

        @foreach($rekapLap as $lap)
        <div class="  grid grid-cols-4">
          <div>
            Tanggal Laporan
          </div>
          <div>
            : {{$lap->tanggal}}
          </div>
          <div>
            Tanggal Laporan
          </div>
          <div>
            : {{$lap->lokasi_praktik}}
          </div>
        </div>
        <ul class=" py-1 text-justify">
          <li>

            @if($lap->bukti_laporan == null)
            <p class=" text-red-600">Tidak Ada Foto</p>
            @else
            <img class=" p-2" src="{{ asset('storage/' .$lap->bukti_laporan) }}" alt="" width="500" height="600">
            @endif
          </li>
          <li>
            {{$lap->deskripsi_laporan}}
          </li>
        </ul>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>