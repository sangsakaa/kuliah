<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:text-left text-center uppercase">
      {{ __('Sesi Laporan Harian') }}
    </h2>
  </x-slot>

  <div class=" w-full py-2 px-2 ">
    <div class=" py-1 mt-2 bg-white">
      <div class="p-2 sm:p-2 bg-white  border-gray-200">
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
          <div class=" block sm:hidden ">
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
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class=" flex grid-cols-2 sm:grid-cols-2 px-2 gap-1 p-2">
      <a href="/dashboard" class=" py-2 px-2 text-white bg-blue-700 flex" title="Beranda">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
        </svg>
      </a>
      <div class=" py-1">
        <form action="/sesi-laporan-mahasiswa" method="post" enctype="multipart/form-data">
          @csrf
          <input hidden type="date" readonly name="tanggal" class="  py-1" id="" value="{{ $tanggal->toDateString() }}" required>
          <input type="hidden" name="kelompok_id" value="{{$dataKelompok->kelompok_id}}" class=" py-1 " id="">
          <button class="  px-2 py-1 bg-blue-700 text-white">Buat Laporan</button>
        </form>
      </div>
      <div class=" py-2 ">
        <span class=" py-2 text-sm">Tgl :
          {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}
        </span>
      </div>
      <div class=" sm:justify-end justify-start flex gap-2">
        <form action="/sesi-laporan-mahasiswa" method="get" class=" py-1 ">
          <input hidden type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" disabled class="  border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <!-- <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari </button> -->
        </form>
      </div>
    </div>
  </div>
  @if(session('succes'))
  <div class="bg-red-700 text-white grid justify-center mt-2 ">
    <span class=" px-2 py-1">{{ session('succes') }}</span>
  </div>
  @endif
  @if(session('warning'))
  <div class="bg-yellow-200  grid justify-center mt-2 ">
    <span class=" px-2 py-1">{{ session('warning') }}</span>
  </div>
  @endif

  <div class=" py-1 mt-2 bg-white">
    <div class=" overflow-auto p-4">
      <div>

        @if($DataSesiLap->count() != null)
        @foreach($DataSesiLap as $list)
        <a href="/laporan-mahasiswa/{{$list->id}}">
          <div class=" flex grid-cols-2 gap-2 ">
            <div class="   justify-center  items-center grid  bg-blue-200 rounded-md  w-16 ">
              @foreach($list->laporanMahasiswa as $status)
              @if($status->status_laporan === 'menunggu')
              <span class="text-red-700 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
              </span>
              @elseif($status->status_laporan === 'valid')
              <span class="text-green-700 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>

              </span>
              @elseif($status->status_laporan === null)
              <span class="text-black">
                Belum melakukan laporan
              </span>
              @else
              {{$status->status_laporan}}
              @endif
              @endforeach
              @if(count($list->laporanMahasiswa) === 0)
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-red-700">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
              </svg>

              @endif
            </div>
            <div class=" bg-blue-200  rounded-md w-full">
              @if($DataSesiLap->count() != null)
              @foreach($DataSesiLap as $list)
              <div class=" p-2">
                <span class=" text-xs sm:text-sm">
                  <td class="border border-green-700 px-2 py-1 text-center">
                    {{ \Carbon\Carbon::parse($list->tanggal)->isoFormat('dddd , DD MMMM Y') }}
                  </td>
                  <td class="border border-green-700 px-2 py-1 text-center">
                    | Jam : {{ \Carbon\Carbon::parse($list->created_at)->isoFormat('H:m') }}
                  </td>
                  <span class="">
                    @php
                    // Ambil waktu sekarang dalam timezone tertentu, misalnya 'Asia/Jakarta'
                    $now = \Carbon\Carbon::now('Asia/Jakarta');

                    // Parse waktu dari database atau sumber lainnya ke dalam objek Carbon
                    $created_at = \Carbon\Carbon::parse($list->created_at);

                    // Hitung selisih waktu antara waktu sekarang dan waktu dari database
                    $diff = $created_at->diffForHumans($now);
                    @endphp
                    <p> {{ $diff }}</p>

                  </span>
                  <span hidden class="">
                    <span class=" font-semibold capitalize">
                      @foreach($list->laporanMahasiswa as $status)
                      @if($status->status_laporan === 'menunggu')
                      Status : <span class="text-red-700 font-semibold">{{$status->status_laporan}}</span>
                      @elseif($status->status_laporan === 'valid')
                      Status : <span class="text-green-700 font-semibold">{{$status->status_laporan}}</span>
                      @elseif($status->status_laporan === null)
                      Status : <span class="text-black">Belum melakukan laporan</span>
                      @else
                      Status : {{$status->status_laporan}}
                      @endif
                      @endforeach
                      @if(count($list->laporanMahasiswa) === 0)
                      Status : <span class="text-black">Belum Laporan</span>
                      @endif
                    </span> <br>
                    <span>
                      @foreach($list->laporanMahasiswa as $status)
                      {{$status->note_laporan}}
                      @endforeach
                    </span>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                      <td class=" text-red-700 text-center py-1 font-semibold uppercase" colspan="6">tidak ada sesi Laporan</td>
                    </tr>
                    @endif
              </div>
            </div>
          </div>
          <div class="py-2 ">
            @foreach($list->laporanMahasiswa as $status)
            <div class=" py-2 px-2 bg-yellow-500">
              <span>

                Note : {{$status->note_laporan}}

              </span>
            </div>
            @endforeach
          </div>
          @endforeach
        </a>
        @else
        <div class=" grid justify-center">
          <span class=" text-red-700 uppercase font-semibold">Sesi Laporan Belum dibuat</span>
        </div>
        @endif

      </div>
    </div>
  </div>
  <div class=" p-2">
    <div class=" mt-2 py-2 px-2 rounded-md bg-blue-200">
      <p>Keterang : </p>
      <p>
        1. Waktu pelaporan belum terlambat, jika telat belum lebih dari 24 Jam
      </p>
    </div>
  </div>
</x-app-layout>