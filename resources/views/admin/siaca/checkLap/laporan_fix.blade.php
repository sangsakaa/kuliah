<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Laporan')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
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
  <div class="p-2">
    <div class=" grid  bg-white p-4">
      <div class="px-2 mt-2   bg-white ">
        <div class="px-2 py-2 overflow-auto">
          <div class=" flex gap-2 justify-end py-1">
            <form action="/cek-kualitas-fix" method="get">
              <input type="text" name="cari" value="{{ request('cari') }}" class=" border border-green-800 text-green-800 rounded-md py-1 px-4" placeholder=" Cari ..">
              <button type="submit" class="  bg-green-800 py-1 px-2 rounded-md text-white">
                Cari</button>
            </form>
            <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
              Cetak
            </button>
          </div>
          <div id="div1">
            <table class=" w-full ">
              <thead class="   ">
                <tr class=" bg-gray-200">
                  <th class=" px-1 border border-green-900 w-5" rowspan=" 2">Kel</th>
                  <th class=" px-1 border border-green-900" rowspan=" 2">Nama Mahasiswa</th>
                  <th class=" px-1 border border-green-900" colspan="4">Status Laporan</th>
                  <th class=" px-1 border border-green-900" colspan="4">Status Laporan</th>
                </tr>
                <tr class=" bg-gray-200">
                  <th class=" px-1 border border-green-900 ">Tot</th>
                  <th class=" px-1 border border-green-900 ">D</th>
                  <th class=" px-1 border border-green-900 ">V</th>
                  <th class=" px-1 border border-green-900 ">M</th>
                  <th class=" px-1 border border-green-900 ">SS</th>
                  <th class=" px-1 border border-green-900 ">S</th>
                  <th class=" px-1 border border-green-900 ">TS</th>
                  <th class=" px-1 border border-green-900 ">STS</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cek_lap as $lap)
                <tr class=" even:bg-gray-100 hover:bg-green-200">
                  <td class=" border text-center">{{ $lap->nama_kelompok }}</td>
                  <td class=" border">{{ $lap->nama_mhs }}</td>
                  <td class=" border text-center">{{ $lap->total_laporan }}</td>
                  <td class=" border text-center">{{ $lap->jumlah_draf }}</td>
                  <td class=" border text-center">{{ $lap->jumlah_valid }}</td>
                  <td class=" border text-center">{{ $lap->jumlah_menunggu }}</td>
                  <td class=" border text-center">{{ $lap->ss }}</td>
                  <td class=" border text-center">{{ $lap->s }}</td>
                  <td class=" border text-center">{{ $lap->ts }}</td>
                  <td class=" border text-center">{{ $lap->sts }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>
</x-app-layout>