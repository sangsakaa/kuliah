<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" bg-white p-4">
    <div>
      <div class=" w-full grid ">
        <div class=" hidden sm:block ">
          <div class="  grid grid-cols-4 sm:grid-cols-4">
            <div>NIM</div>
            <div class="">: {{$data->nim}}
            </div>
            <div>Pembimbing</div>
            <div> : {{$data->nama_dosen}}</div>
            <div>Nama Mahasiswa</div>
            <div> : {{$data->nama_mhs}}</div>
            <div>Nama Kelompok</div>
            <div> : Kelompok {{$data->nama_kelompok}}</div>
          </div>
        </div>
        <div class=" bloc sm:hidden ">
          <div class=" text-center  grid grid-cols-1 ">
            <div class=" text-2xl"> {{$data->nama_mhs}}</div>
            <div> {{$data->nim}}</div>
            <div class=" uppercase"> Kelompok {{$data->nama_kelompok}}</div>
            <div> {{$data->nama_dosen}}</div>
            <div>
              Desa . {{$data->nama_desa}}
              Kec . {{$data->nama_kecamatan}}
              <p>Kab . {{$data->nama_kabupaten}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class=" mt-2 bg-white p-4">
    <div class=" p-4">
      <form action="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}" id="uploadForm" method="post" enctype="multipart/form-data">
        @csrf

        <input class="w-full" type="hidden" name="sesi_laporan_harian_id" value="{{$sesi_Laporan_Harian->id}}">
        @foreach($dataMhs as $item)

        <input class="w-full" type="hidden" name="anggota_kelompok_id" value="{{$item->mahasiswa_id}}">
        <label for="">Lokasi Pratikum</label>
        <input class="w-full" type="text" name="lokasi_praktik" value="{{ $item->lokasi_praktik ?? '' }}">
        <label for="" class="capitalize">Deskripsi Laporan Harian</label>
        <textarea name="deskrip_laporan" id="" class="w-full" cols="30" rows="10"><?php echo !empty($item->deskrip_laporan) ? $item->deskrip_laporan : ""; ?></textarea>
        <h1>Unggah Bukti Kegiatan</h1>
        <input type="file" id="fileInput" accept="image/*" name="butkti_laporan" capture="camera" value="">
        <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
        @endforeach
      </form>
    </div>
  </div>
  </div>
</x-app-layout>