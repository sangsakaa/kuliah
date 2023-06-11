<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>

  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-4 bg-white  border-gray-200">
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
  </div>
  <div class=" p-4">
    <div class=" py-1 mt-2 bg-white">
      <div class=" p-4">
        <form action="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}" id="uploadForm" method="post" enctype="multipart/form-sesi_Laporan_Harian">
          @csrf
          <label for="">Lokasi Pratektikum</label>
          <input class=" w-full" type="text" name="sesi_laporan_harian_id" value="{{$sesi_Laporan_Harian->id}}">
          <label for="">Nama Mhs</label>
          <input class=" w-full" type="text" name="anggota_kelompok_id" value="{{$data->mahasiswa_id}}">
          <label for="">Lokasi </label>
          <input class=" w-full" type="text" name="lokasi_praktik">
          <label for="" class=" capitalize">diskripsi Laporan Harian</label>
          <textarea name="deskrip_laporan" id="" class=" w-full" cols="30" rows="10"></textarea>
          <h1>Unggah Bukti Kegiatan</h1>
          <input type="file" id="fileInput" accept="image/*" name="butkti_laporan" capture="camera">
          <button class=" bg-blue-700 text-white px-2 mt-2" type="submit">Kirim Laporan</button>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>