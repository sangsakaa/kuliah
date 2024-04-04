<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:text-left text-center uppercase">
      {{ __('Sesi Laporan Harian') }}
    </h2>
  </x-slot>

  <div class=" w-full py-2 px-2 ">
    <div class=" py-1  bg-white">
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
                    <div class="flex gap-2">
                      <div class="w-2/3">
                        <div class="">
                          <p>Pembimbing</p>
                          <p>NIM</p>
                          <p>Nama</p>
                          <p>Kelompok</p>
                        </div>
                      </div>
                      <div class="flex-1">
                        <div class="  w-80">
                          <p>: {{ strlen($data->nama_dosen) > 30 ? substr($data->nama_dosen, 0, 30) . '...' : $data->nama_dosen }}</p>
                          <p>: {{$data->nim}}</p>
                          <p>: {{ strlen($data->nama_mhs) > 30 ? substr($data->nama_mhs, 0, 30) . '...' : $data->nama_mhs }}</p>
                          <p>: {{$data->nama_kelompok}}</p>
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
    </div>
  </div>

  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class=" flex grid-cols-2 sm:grid-cols-2 px-2 gap-1 p-2">
      <div class=" ">
        <form action="/sesi-laporan-mahasiswa" method="post" enctype="multipart/form-data">
          @csrf
          <input hidden type="date" readonly name="tanggal" class="  py-1" id="" value="{{ $tanggal->toDateString() }}" required>
          <input type="hidden" name="kelompok_id" value="{{$dataKelompok->kelompok_id}}" class=" py-1 " id="">
          <button class=" rounded-md  px-2 py-1 bg-blue-700 text-white flex gap-2">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>

            </span>
            Laporan</button>
        </form>
      </div>
      <div class=" bg-sky-300 rounded-md justify-center  items-center grid">
        <div class=" px-2  flex gap-2   ">

          <span>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
            </svg>

          </span>
          {{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y | H:i') }}

        </div>
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
    <div class=" overflow-auto p-2">
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
          @if ($list->laporanMahasiswa != null)
          @foreach($list->laporanMahasiswa as $status)
          <div class="py-2 ">
            <div class="py-2 px-2 bg-yellow-500">
              <span>
                Note : {{$status->note_laporan}}
              </span>
            </div>
          </div>
          @endforeach
          @endif
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
  <div class=" p-2 text-sm">
    <div class=" mt-2 py-2 px-2 rounded-md bg-yellow-400">
      <p>Keterangan : </p>
      <ul>
        <li class=" flex grid-cols-2 gap-1">
          <p>1.</p>
          <p>Waktu pelaporan belum terlambat, jika telat belum lebih dari 24 Jam</p>
        </li>
        <li class=" flex grid-cols-2 gap-1">
          <p>1.</p>
          <p>Waktu pelaporan belum terlambat, jika telat belum lebih dari 24 Jam</p>
        </li>
        <li class=" flex grid-cols-2 gap-1">
          <p>1.</p>
          <p>Waktu pelaporan belum terlambat, jika telat belum lebih dari 24 Jam</p>
        </li>

      </ul>
    </div>
  </div>
</x-app-layout>