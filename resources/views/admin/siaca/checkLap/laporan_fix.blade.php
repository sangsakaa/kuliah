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
              <select name="cari" class="border border-green-800 text-green-800 rounded-md py-1 px-4">
                <option value="">Pilih Dosen</option>
                @foreach ($dataDosen as $dosen)
                <option value="{{ $dosen->nama_dosen }}" {{ old('cari') === $dosen->nama_dosen ? 'selected' : '' }}>
                  {{ $dosen->nama_kelompok }} - {{ $dosen->nama_dosen }}
                </option>
                @endforeach
              </select>

              <button type="submit" class="bg-green-800 py-1 px-2 rounded-md text-white">
                Cari
              </button>
            </form>




            <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
              Cetak
            </button>
          </div>
          <div id="div1">
            <div class=" block sm:hidden py-2">
              <div class=" w-full flex grid-cols-2 gap-2 text-green-700">
                <div class=" py-4">
                  <img src="{{ asset('img/ori.png') }}" alt="Logo" width="110px" height="110px">
                </div>
                <div class=" w-full ">
                  <p class=" text-center text-lg font-semibold uppercase">yayasan perjuangan wahidiyah dan pondok pesantren kedunglo</p>
                  <p class="text-center text-2xl font-semibold w-full spaced-text  tracking-widest   ">UNIVERSITAS WAHIDIYAH KEDIRI</p>
                  <p class=" text-center  text-4xl  tracking-widest space-x-2  font-black    font-sans    ">KULIAH KERJA NYATA</p>
                  <p class=" text-center text-xs font-semibold">Alamat : Pondok Pesantren Kedunglo Jl.KH. Wachid Hasyim Kota Kediri 64114 Jawa Timur Telp. (0354) 774511, 771018</p>
                </div>
              </div>
              <hr class=" border-b-2 border-b-green-700">
              <hr class=" border-b border-b-green-700">
            </div>
            <div>

            </div>
            <table class=" w-full ">

              <thead class="   ">
                <tr class=" bg-gray-200 text-xs uppercase">
                  <th class=" px-1 border border-green-900 w-5" rowspan=" 2">No</th>
                  <th class=" px-1 border border-green-900" rowspan=" 2">Nama Mahasiswa</th>
                  <th class=" px-1 border border-green-900 w-5" rowspan=" 2">Kel</th>
                  <th class=" px-1 border border-green-900" colspan="4">Status Laporan</th>
                  <th class=" px-1 border border-green-900 w-fit" colspan="5">Status Laporan</th>
                </tr>
                <tr class=" bg-gray-200 text-xs uppercase">
                  <th class=" px-1 border border-green-900 ">Tot</th>
                  <th class=" px-1 border border-green-900 ">D</th>
                  <th class=" px-1 border border-green-900 ">V</th>
                  <th class=" px-1 border border-green-900 ">M</th>
                  <th class=" px-1 border border-green-900 ">SS</th>
                  <th class=" px-1 border border-green-900 ">S</th>
                  <th class=" px-1 border border-green-900 ">TS</th>
                  <th class=" px-1 border border-green-900 ">STS</th>
                  <th class=" px-1 border border-green-900 ">Tot</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cek_lap as $lap)
                <tr class=" even:bg-gray-100 hover:bg-green-200 text-sm ">
                  <td class=" border border-green-900 text-center py-1">{{ $loop->iteration }}</td>
                  <td class=" border border-green-900">{{ $lap->nama_mhs }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->nama_kelompok }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->total_laporan }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->jumlah_draf }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->jumlah_valid }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->jumlah_menunggu }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->ss }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->s }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->ts }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->sts }}</td>
                  <td class=" border border-green-900 text-center">{{ $lap->sts + $lap->ts + $lap->s + $lap->ss }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>
</x-app-layout>