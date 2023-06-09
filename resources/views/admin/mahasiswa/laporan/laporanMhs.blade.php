<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('LAPORAN MAHASISWA') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <button class="  w-10 justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
        x
      </button>
    </div>
  </div>
  <script>
    function printContent(el) {
      var fullbody = document.body.innerHTML;
      var printContent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = fullbody;
    }
  </script>
  <div id="div1" class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 bg-white  border-gray-200">
        <div>
          <div>
          </div>
          <div class=" text-black">
            <p class=" uppercase text-center font-semibold">data kelompok kkn universitas wahidiyah</p>
            <p class=" uppercase text-center font-semibold">tahun 2023</p>
          </div>
          <table class="w-full">
            <thead>
              <tr>
                <th class=" border border-black px-1">No</th>
                <th class=" border border-black px-1">NIM</th>
                <th class=" border border-black px-1">Nama </th>
                <th class=" border border-black px-1 w-1/3">Program Studi</th>
                <th class=" border border-black px-1">Tahun Masuk</th>
              </tr>
            </thead>
            <tbody>
              @php
              $prodiTotals = array();
              @endphp
              @foreach ($data as $row)
              <tr class=" text-sm sm:text-sm">
                <td class=" border border-black px-1 text-center">{{ $loop->iteration }}</td>
                <td class=" border border-black px-1 text-center">{{ $row->nim }}</td>
                <td class=" border border-black px-1 text-left  capitalize">{{ strtolower($row->nama_mhs) }}</td>
                <td class=" border border-black px-1 text-center  capitalize">

                  @if ($row->prodi === 'S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)')
                  HKI
                  @elseif ($row->prodi === 'S1 Pendidikan Guru Pendidikan Anak Usia Dini')
                  S1 PG PAUD
                  @else
                  {{ $row->prodi }}
                  @endif


                </td>

                <td class=" border border-black px-1 text-center">{{ $row->periode_masuk }}</td>
              </tr>
              @php
              // Menghitung jumlah mahasiswa berdasarkan prodi
              if (isset($prodiTotals[$row->prodi])) {
              $prodiTotals[$row->prodi]++;
              } else {
              $prodiTotals[$row->prodi] = 1;
              }
              @endphp
              @endforeach
            </tbody>
          </table>
          <h2>Total Mahasiswa per Program Studi</h2>
          <table>
            <thead>
              <tr>
                <th class="border px-1">No</th>
                <th class="border px-1">Program Studi</th>
                <th class="border px-1">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($prodiTotals as $prodi => $total)
              <tr>
                <td class="border px-1 text-left">{{ $loop->iteration }}</td>
                <td class="border px-1 text-left">{{ $prodi }}</td>
                <td class="border px-1 text-center">{{ $total }}</td>

              </tr>
              @endforeach
            </tbody>
          </table>










        </div>
      </div>
    </div>

  </div>
</x-app-layout>