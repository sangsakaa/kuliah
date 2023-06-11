<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>


  <div class=" p-4">
    <div class=" py-1 mt-2 bg-white">

      <div class=" p-4">
        <form action="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}" id="uploadForm" method="post" enctype="multipart/form-data">
          @csrf
          <label for="">Sesi</label>
          <input class="w-full" type="text" name="sesi_laporan_harian_id" value="{{$sesi_Laporan_Harian->id}}">
          @foreach($dataMhs as $item)
          <label for="">Nama Mhs</label>
          <input class="w-full" type="text" name="anggota_kelompok_id" value="{{$item->anggota_kelompok_id}}">
          <label for="">Lokasi</label>
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