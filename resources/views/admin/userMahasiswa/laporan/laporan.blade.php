<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Laporan Harian') }}
    </h2>
  </x-slot>
  <div class="p-2">
    <div class="   p-4 bg-blue-200">
      <div>
        <div class=" w-full grid ">
          <div class="  ">
            <div class="text-sm  capitalize grid grid-cols-2 sm:grid-cols-2  ">
              <div class=" ">
                Pembimbing
              </div>
              <div class=" ">
                :
                {{ strlen($data->nama_dosen) > 15 ? substr($data->nama_dosen, 0, 15) . '...' : $data->nama_dosen }}
              </div>
              <div class=" ">
                NIM
              </div>
              <div class="">
                :
                {{$data->nim}}
              </div>
              <div class=" ">
                Nama
              </div>
              <div class="">
                :
                {{ strlen($data->nama_mhs) > 18 ? substr($data->nama_mhs, 0, 18) . '...' : $data->nama_mhs }}
              </div>
              <div class=" ">
                Kelompok
              </div>
              <div class="">
                : Kelompok {{$data->nama_kelompok}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="px-1 mt-2  text-sm  bg-white ">
      <div class="px-1 py-2">
        <div> Tanggal Laporan :
          @if (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->diffInDays(\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)) > 0)
          <span class="bg-red-700 text-white px-1 uppercase">Terlambat</span>
          @elseif (\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)->isSameDay(\Carbon\Carbon::now()))
          @if (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->diffInDays(\Carbon\Carbon::tomorrow()) == 0)
          <span class="bg-red-700 text-white px-1 rounded-sm uppercase">Forbidden</span>
          @else
          <span class="bg-green-800 text-white px-1 rounded-sm uppercase">On time</span>
          @endif
          @else
          <span class="bg-green-800 text-white px-1 rounded-sm uppercase">On time</span>
          @endif


          <div class=" grid grid-cols-2">
            <div class=" grid grid-cols-1">

              <div>dibuat : </div>
              <div>{{\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)->isoformat('dddd D MMMM Y')}}</div>
            </div>
            <div class=" grid grid-cols-1">
              <div>Laporan : </div>
              <div>{{ \Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->isoformat('dddd D MMMM Y') }}</div>
            </div>

          </div>

          @foreach ($dataMhs as $mhs)
          @if ($mhs->status_laporan === 'menunggu')
          <span class=" rounded-md bg-yellow-500 text-black  capitalize font-semibold px-2">
            menunggu validasi dosen
          </span>
          @elseif ($mhs->status_laporan === 'draf')
          <span class=" rounded-md bg-yellow-500 text-black  capitalize font-semibold px-2">
            belum laporan atau ada revisi
          </span>
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
              @if($item->note_laporan <= null) <span>-</span>
                @else
                <input class="w-full" type="text" placeholder=" Catatan Sesui revisi" disabled readonly name="note_laporan" value="{{$item->note_laporan}}">
                @endif
            </div>
          </div>
          <label for="">Institusi / Tempat Kegiatan</label>
          <input class="w-full" type="text" name="lokasi_praktik" placeholder="Contoh : SDS Wahidiyah Karangrejo" required value="{{ old('lokasi_praktik', $item->lokasi_praktik ?? '') }}">
          @if($item->bukti_laporan == null)
          <p class=" text-red-600">Bukti Kegiatan Belum di uploud dan di simpan</p>
          @else
          <img class=" p-2" src="{{ asset('storage/' .$item->bukti_laporan) }}" alt="" width="500" height="600">
          @endif



          <label for="" class="capitalize">syarat Laporan (Min : 500 Max : 1000 Karakter) <br> <span> jumlal : {{strlen($item->deskripsi_laporan)}} Karakter</span></label>
          @if(strlen($item->deskripsi_laporan)>499)
          <span class=" text-green-700 uppercase font-semibold text-sm"> Sudah Sesuai</span>
          @else
          <span class=" text-red-700 uppercase font-semibold text-sm">Tidak Sesuai</span>
          @endif
          <textarea name="deskripsi_laporan" id="" class="w-full" cols="30" rows="10" required>{{ old('deskripsi_laporan', $item->deskripsi_laporan ?? '') }}</textarea>
          <h1>Unggah Bukti Kegiatan <span class=" font-semibold`">( Max : 1 MB)</span></h1>
          @if(!$item->bukti_laporan)
          <input type="file" id="fileInput" required accept="image/*" name="bukti_laporan">
          @else
          <input type="file" name="bukti_laporan" value="{{ $item->bukti_laporan }}">

          @endif

          @error('bukti_laporan')
          <p class="text-red-800 font-semibold text-xs italic mt-4">
            {{ $message }}
          </p>
          @enderror
          <!-- @if (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->diffInDays(\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)) > 0)
          @elseif (\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)->isSameDay(\Carbon\Carbon::now()))
          @if($item->status_laporan == "valid")
          <div>
            <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          </div>
          @elseif($item->status_laporan == "menunggu")
          <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          @else
          <div>
            <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
            <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-laporan-mahasiswa">Kembali</a>
            <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}">Batal</a>
          </div>
          @endif
          @endif -->
          @if (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->diffInDays(\Carbon\Carbon::parse($sesi_Laporan_Harian->created_at)) > 0)
          {{-- Jika laporan untuk hari berikutnya --}}
          <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          @elseif (\Carbon\Carbon::parse($sesi_Laporan_Harian->tanggal)->isSameDay(\Carbon\Carbon::now()))
          {{-- Jika laporan untuk hari ini --}}
          @if($item->status_laporan == "valid")
          <div>
            <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          </div>
          @elseif($item->status_laporan == "menunggu")
          <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-laporan-mahasiswa">Kembali</a>
          @else
          <div>
            <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
            <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-laporan-mahasiswa">Kembali</a>
            <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/laporan-mahasiswa/{{$sesi_Laporan_Harian->id}}">Batal</a>
          </div>
          @endif
          @else
          {{-- Jika laporan untuk hari sebelumnya --}}
          <button disabled class="bg-red-700 text-white px-2 py-1 mt-2" type="submit">Kirim Laporan</button>
          <a class="bg-blue-700 text-white px-2 py-1 mt-2" href="/sesi-laporan-mahasiswa">Kembali</a>
          @endif

          @endforeach
        </form>
      </div>
    </div>
  </div>
</x-app-layout>