<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class="p-2">
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
    <div class="px-2 mt-2   bg-white ">
      <div class="px-2 py-2">
        <form action="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}" method="post" enctype="multipart/form-data">
          @csrf
          <input class="w-full" type="hidden" name="sesi_laporan_harian_id" value="{{$sesi_Laporan_Harian->id}}">
          @foreach($dataMhs as $item)
          <input class="w-full" type="hidden" name="anggota_kelompok_id" value="{{$item->mahasiswa_id}}">
          <label for="">Institusi / Tempat Kegiatan</label>
          <input class="w-full" type="text" name="lokasi_praktik" placeholder="Contoh : SDS Wahidiyah Karangrejo" required value="{{ $item->lokasi_praktik ?? '' }}">

          @if($item->butkti_laporan == null)
          <p class=" text-red-600">Bukti Kegiatan Belum di uploud dan di simpan</p>
          @else
          <img class=" p-2" src="{{ asset('storage/' .$item->butkti_laporan) }}" alt="" width="500" height="600">
          @endif
          <label for="" class="capitalize">Deskripsi Laporan Harian (min : 1000) <span> jumlal : {{strlen($item->deskrip_laporan)}} Karakter</span></label>

          @if(strlen($item->deskrip_laporan)>1000)
          <span class=" text-green-700 uppercase font-semibold text-sm">Tidak Sesui</span>
          @else
          <span class=" text-red-700 uppercase font-semibold text-sm">Tidak Sesui</span>
          @endif

          <textarea name="deskrip_laporan" id="" class="w-full" cols="30" rows="10" required><?php echo !empty($item->deskrip_laporan) ? $item->deskrip_laporan : ""; ?></textarea>
          <h1>Unggah Bukti Kegiatan</h1>
          <input type="file" id="fileInput" accept="image/*" name="butkti_laporan" value="{{ asset($item->butkti_laporan) }}">
          <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-laporan-mahasiswa">Kembali</a>
          <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}">Batal</a>

          @endforeach
        </form>
      </div>
    </div>
  </div>
</x-app-layout>