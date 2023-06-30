<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Supervisi '.\Carbon\Carbon::parse($title->tanggal)->isoFormat('DD MMMM Y') )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Cetak Supervisi') }}
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
    <button class="   justify-center text-white   bg-green-800 px-2 py-1 " onclick="printContent('div1')">
      Cetak
    </button>
    <div id="div1" class=" mt-2 bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" block sm:hidden">
        <div class=" w-full flex grid-cols-2 gap-2 text-green-700">
          <div class=" py-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="110px" height="110px">
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
      <div class=" p-2">
        <h1 class=" uppercase font-semibold">laporan supervisi dosen pembimbing</h1>
        <div class=" grid grid-cols-2">
          <div>Dosen Pembimbing</div>
          <div> :
            {{ $title->nama_dosen }}

          </div>
          <div>Kelompok Dosen Pembimbing</div>
          <div> :
            {{ $title->nama_kelompok }}

          </div>

          <div>Alamat</div>
          <div> :
            Desa.{{ $title->nama_desa }}
            Kec.{{ $title->nama_kecamatan }}
            Kab.{{ $title->nama_kabupaten }}
          </div>
          <div>Tanggal Supervisi</div>
          <div> :
            {{ \Carbon\Carbon::parse($title->tanggal)->isoFormat('DD MMMM Y') }}
          </div>
        </div>
      </div>
      <div class=" px-2 ">
        <table class=" w-full">
          <thead>
            <tr class=" border px-1 border-black py-1">
              <th class=" border px-1 border-black py-1 w-10">No</th>
              <th class=" border px-1 border-black py-1 w-1/4">Indikator</th>
              <th class=" border px-1 border-black py-1">Deskripsi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($lapSupervisi as $lap)
            <tr class=" border border-black px-1">
              <td class=" text-center border border-black px-1">1</td>
              <td class=" border border-black px-1">Indikator Umumu</td>
              <td class=" border border-black px-1">{{$lap->kondisi_umum}}</td>
            </tr>
            <tr class=" border border-black px-1">
              <td class=" text-center border border-black px-1" rowspan="2">2</td>
              <td class=" border border-black px-1">
                Kegiatan Kelompok : <br>
                Realisasi Kegiatan Sesui Program</td>
              <td class=" border border-black px-1">{{$lap->realisasi_kegiatan}}</td>
            </tr>
            <tr class=" border border-black px-1">

              <td class=" border border-black px-1">

                Program yang belum terlaksana</td>
              <td class=" border border-black px-1">{{$lap->tidak_realisasi_kegiatan}}</td>
            <tr class=" border border-black px-1">
              <td class=" text-center border border-black px-1">3</td>
              <td class=" border border-black px-1">Kendala</td>
              <td class=" border border-black px-1">{{$lap->kendala}}</td>
            </tr>
            <tr class=" border border-black px-1">
              <td class=" text-center border border-black px-1">4</td>
              <td class=" border border-black px-1">rencana_tindak_lanjut Tidak Lanjut</td>
              <td class=" border border-black px-1">{{$lap->rencana_tindak_lanjut}}</td>
            </tr>
            <tr class=" border border-black px-1">
              <td class=" text-center border border-black px-1">5</td>
              <td class=" border border-black px-1">Bukti Supervisi</td>
              <td class=" border border-black px-1"><img class=" p-2" src="{{ asset('storage/' . $lap->bukti_laporan_supervisi) }}" alt="" width="500" height="600"></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class=" grid grid-cols-2">
          <div class=" w-full"></div>
          <div class=" ">
            <p>Mengetahui,
              {{ \Carbon\Carbon::parse(now())->isoFormat('DD MMMM Y') }}
            </p>
            <p>Pembimbing </p>
            <br><br><br>
            <p class=" "> {{ $title->nama_dosen }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>