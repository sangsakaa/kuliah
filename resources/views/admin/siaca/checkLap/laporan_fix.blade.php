<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Laporan')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class="p-2">
    <div class=" grid  bg-white p-4">
      <div class="px-2 mt-2   bg-white ">
        <div class="px-2 py-2">

          <table class=" w-full">
            <thead>
              <tr>
                <th class=" px-1 border w-5" rowspan=" 2">Kel</th>
                <th class=" px-1 border" rowspan=" 2">Nama Mahasiswa</th>
                <th class=" px-1 border" colspan="4">Status Laporan</th>
                <th class=" px-1 border" colspan="4">Status Laporan</th>
              </tr>
              <tr>
                <th class=" px-1 border ">Tot</th>
                <th class=" px-1 border ">D</th>
                <th class=" px-1 border ">V</th>
                <th class=" px-1 border ">M</th>
                <th class=" px-1 border ">SS</th>
                <th class=" px-1 border ">S</th>
                <th class=" px-1 border ">TS</th>
                <th class=" px-1 border ">STS</th>
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
          </body>

        </div>
      </div>
    </div>
</x-app-layout>