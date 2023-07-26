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
          <div class="  ">
            <div class="  grid grid-cols-2 sm:grid-cols-4">
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

        </div>
      </div>
    </div>
    <div class="px-2 mt-2   bg-white ">
      <div class="px-2 py-2">
        <div> Status Laporan :
          dibuat : {{\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)->isoformat('dddd D MMMM Y')}}
          <!-- <td class="border text-center px-1">
            @if (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->diffInDays(\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)) > 0) <span class=" bg-red-700 text-white px-1 uppercase">Telat</span> laporan : {{\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->isoformat('dddd D MMMM Y')}}
            @elseif (\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)->isSameDay(\Carbon\Carbon::now()))
            <span class=" bg-green-800 text-white px-1 rounded-sm uppercase"> on time</span>
            @else
            <span class=" bg-red-700 text-white px-1 rounded-sm uppercase">telat</span>
            @endif
          </td> -->
          @foreach ($dataMhs as $mhs)
          @if ($mhs->status_laporan === 'menunggu')
          <span class=" rounded-md bg-yellow-300 text-black  capitalize font-semibold px-2">
            menunggu validasi dosen
          </span>
          @elseif ($mhs->status_laporan === 'draf')
          belum laporan atau ada revisi
          @endif
          @endforeach



        </div>
        <form action="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}" method="post" enctype="multipart/form-data">
          @csrf
          <input class="w-full" type="hidden" name="sesi_laporan_harian_id" value="{{$sesi_Laporan_Harian->id}}">
          @foreach($dataMhs as $item)

          <div class=" grid grid-cols-1 sm:grid-cols-2  gap-2">
            <div class=" grid-cols-1 grid">
              <div class=" grid-cols-1 grid">
                <span>Status Validasi Laporan</span>
                <select name="status_laporan" id="" class="py-1 px-1 text-white <?php echo ($item->status_laporan == 'draf') ? 'bg-yellow-500 text-black' : (($item->status_laporan == 'menunggu') ? 'bg-red-700 text-white' : 'bg-green-700 text-white'); ?>">
                  <option value="draf" <?php if ($item->status_laporan == 'draf') echo 'selected'; ?>>Draf</option>
                  <option value="menunggu" <?php if ($item->status_laporan == 'menunggu') echo 'selected'; ?> <?php echo ($item->status_laporan == 'valid' || $item->status_laporan == 'menunggu') ? 'disabled' : ''; ?>>Menunggu</option>
                  <option class="hidden" value="valid" <?php if ($item->status_laporan == 'valid') echo 'selected'; ?> <?php echo ($item->status_laporan == 'valid' || $item->status_laporan == 'menunggu') ? 'disabled' : ''; ?>>Valid</option>
                </select>
              </div>
            </div>
            <div class=" grid grid-cols-1">
              <span>Catatan Validasi </span>
              <input class="w-full" type="text" placeholder=" Catatan Sesui revisi" readonly name="note_laporan" value="{{$item->note_laporan}}">
            </div>
          </div>
          <label for="">Institusi / Tempat Kegiatan</label>
          <input class="w-full" type="text" name="lokasi_praktik" placeholder="Contoh : SDS Wahidiyah Karangrejo" required value="{{ old('lokasi_praktik', $item->lokasi_praktik ?? '') }}">

          @if($item->bukti_laporan == null)
          <p class=" text-red-600">Bukti Kegiatan Belum di uploud dan di simpan</p>
          @else

          <img class=" p-2" src="{{ asset('storage/' .$item->bukti_laporan) }}" alt="" width="500" height="600">
          @endif
          <label for="" class="capitalize">Deskripsi Laporan Harian (Min : 500 Max : 1000 Karakter) <span> jumlal : {{strlen($item->deskripsi_laporan)}} Karakter</span></label>
          @if(strlen($item->deskripsi_laporan)>499)
          <span class=" text-green-700 uppercase font-semibold text-sm"> Sudah Sesuai</span>
          @else
          <span class=" text-red-700 uppercase font-semibold text-sm">Tidak Sesuai</span>
          @endif
          <textarea name="deskripsi_laporan" id="" class="w-full" cols="30" rows="10" required>{{ old('deskripsi_laporan', $item->deskripsi_laporan ?? '') }}</textarea>
          <h1>Unggah Bukti Kegiatan <span class=" font-semibold`">( Max : 1 MB)</span></h1>
          <input type="file" id="fileInput" accept="image/*" name="bukti_laporan" value="{{ asset($item->bukti_laporan) }}">
          @error('bukti_laporan')
          <p class="text-red-800 font-semibold text-xs italic mt-4">
            {{ $message }}
          </p>
          @enderror
          @if (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->diffInDays(\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)) > 0)
          @elseif (\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)->isSameDay(\Carbon\Carbon::now()))
          @if($item->status_laporan == "valid")
          <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          @elseif($item->status_laporan == "menunggu")
          <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          @else
          <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          @endif

          @endif
          <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-laporan-mahasiswa">Kembali</a>
          <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}">Batal</a>

          @endforeach
        </form>
      </div>
    </div>
  </div>
</x-app-layout>