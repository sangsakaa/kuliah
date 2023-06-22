<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class="p-2">
    <div class=" grid grid-cols-2 sm:grid-cols-4 bg-white p-4">
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
  <div class="px-2 mt-2   bg-white ">
    <div class="px-2 py-2">
      <form action="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}" method="post" enctype="multipart/form-data">
        @csrf
        <input class="w-full" type="hidden" name="sesi_laporan_harian_id" value="{{$sesi_Laporan_Harian->id}}">
        @if($dataMhs->count()!= null)
        @foreach($dataMhs as $item)
        <div class=" grid grid-cols-1 sm:grid-cols-2 gap-2">
          <div class=" grid-cols-1 grid">
            <span>Status Validasi Laporan</span>
            <select name="status_laporan" id="" class="py-1 px-1 <?php echo ($item->status_laporan == 'menunggu') ? 'bg-red-700' : ' text-white bg-green-700'; ?>">
              <option value="menunggu" <?php if ($item->status_laporan == 'menunggu') echo 'selected'; ?>>Menunggu</option>
              <option value="valid" <?php if ($item->status_laporan == 'valid') echo 'selected'; ?>>Valid</option>
            </select>

          </div>
          <div class=" grid grid-cols-1">
            <span>Catatan Validasi Laporan</span>
            <input class="w-full" type="text" placeholder=" Contoh : banyak yang typo" name="note_laporan" value="{{$item->note_laporan}}">
          </div>
        </div>
        <label for="">Institusi / Tempat Kegiatan</label>
        <input class="w-full" readonly type="text" name="lokasi_praktik" placeholder="Contoh : SDS Wahidiyah Karangrejo" required value="{{ $item->lokasi_praktik ?? '' }}">
        @if($item->bukti_laporan == null)
        <p class=" text-red-600">Bukti Kegiatan Belum di uploud dan di simpan</p>
        @else
        <img class=" p-2" src="{{ asset('storage/' .$item->bukti_laporan) }}" alt="" width="500" height="600">
        @endif

        <label for="" class="capitalize">Deskripsi Laporan Harian (Min : 500 Max : 1000) <span> jumlah : {{strlen($item->deskripsi_laporan)}} Karakter</span></label>
        @if(strlen($item->deskripsi_laporan)>499)
        <span class=" text-green-700 uppercase font-semibold text-sm">sudah Sesuai</span>
        @else
        <span class=" text-red-700 uppercase font-semibold text-sm">Tidak Sesuai</span>
        @endif
        <textarea name="deskripsi_laporan" id="" class="w-full mt-2 " cols="30" rows="10" required readonly><?php echo !empty($item->deskripsi_laporan) ? $item->deskripsi_laporan : ""; ?></textarea>
        <h1 hidden class="">Unggah Bukti Kegiatan</h1>
        <input hidden type="file" id="fileInput" accept="image/*" name="bukti_laporan" value="{{ asset($item->bukti_laporan) }}">
        <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
        <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-validasi-laporan-mhs">Kembali</a>
        <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}">Batal</a>
        <a class=" text-white hover:bg-red-500 bg-red-700 rounded-sm py-1 px-2 capitalize" href="{{ asset('storage/' . $item->bukti_laporan) }}" download>
          unduh
        </a>
        @endforeach
        @else
        <center>
          <img src="{{ asset('img/gk.png') }}" alt="">
          <div class=" text-center uppercase text-red-700">Belum Mengirim Laporan</div>
        </center>
        @endif
      </form>
    </div>
  </div>
  </div>
</x-app-layout>