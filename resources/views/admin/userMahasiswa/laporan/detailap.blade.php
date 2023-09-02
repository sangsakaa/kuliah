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
      <div class=" p-2 flex gap-2">
        <div>
          <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
            Cetak
          </button>
        </div>
        <div>
          <form action="/detail-lap-mhs" method="get" class=" py-1 ">
            <input type="date" name="tanggal" value="{{ $tgl->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
            <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
              Cari Tanggal </button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <div id="div1" class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2 justify-center grid">
        <table class=" mt-2 w-full">
          <thead>
            <tr>
              <th class=" border-black border">Bukti Lap</th>
              <th class=" border-black border">Detail Laporan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rekapLap as $item)
            <tr>
              <td class=" border-black border w-1/3  ">
                <img class=" " src="{{ asset('storage/' .$item->bukti_laporan) }}" alt="" height=" 100px">
              </td>
              <td class=" border-black border ">
                <div class=" px-1 grid grid-cols-1 sm:grid-cols-2 ">
                  <div>Nama Mahasiswa </div>
                  <div>: {{$item->nama_mhs}} </div>
                  <div>Program Studi </div>
                  <div>: {{$item->prodi}} </div>
                  <div>Lokasi / Instansi</div>
                  <div> : {{$item->lokasi_praktik}}</div>
                  <div>Status Laporan </div>
                  <div class=" capitalize flex   "> :
                    @if($item->status_laporan =="valid")
                    <span class=" px-1 flex text-white">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 bg-blue-500 rounded-full">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                      </svg>
                    </span>
                    {{$item->status_laporan}}
                    @endif
                  </div>
                  <div>Kelompok - DPL </div>
                  <div class=" capitalize text-green-800">: {{$item->nama_kelompok}} - {{$item->nama_dosen}} </div>

                  <div>Tanggal Laporan </div>
                  <div class=" capitalize text-red-700">: {{ \Carbon\Carbon::parse($item->tanggal)->isoFormat('dddd , DD MMMM Y') }} </div>
                </div>
                <div class=" text-justify  ">
                  <hr class=" border-b-2 border-black">
                  {{$item->deskripsi_laporan}}
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>