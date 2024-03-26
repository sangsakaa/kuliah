<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:text-left text-center">
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
    <div class=" flex grid-cols-2 sm:grid-cols-2 px-2">
      <div class=" p-1">
        <form action="/sesi-laporan-mahasiswa" method="post" enctype="multipart/form-data">
          @csrf
          <input hidden type="date" readonly name="tanggal" class="  py-1" id="" value="{{ $tanggal->toDateString() }}" required>
          <input type="hidden" name="kelompok_id" value="{{$dataKelompok->kelompok_id}}" class=" py-1 " id="">
          <button class="  px-2 py-1 bg-blue-700 text-white">Buat Laporan</button>
        </form>
      </div>
      <div class=" sm:justify-end justify-start flex">
        <form action="/sesi-laporan-mahasiswa" method="get" class=" py-1 ">
          <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari </button>
        </form>
      </div>
    </div>
  </div>
  <div class=" py-1 mt-2 bg-white">
    <div class=" overflow-auto p-4">
      <div>
        @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
        @endif
      </div>
      <div>
        <div class=" ">
          <div class=" grid grid-cols-1 sm:grid-cols-1">
          </div>
        </div>
        <table hidden class="w-full border border-green-700">
          <thead>
            <tr>
              <th class="border border-green-700 px-2 py-1 w-5 sm:w-3">No</th>

              <th class="border border-green-700 px-2 py-1">Tanggal</th>
              <th class="border border-green-700 px-2 py-1">Jam </th>
              <th class="border border-green-700 px-2 py-1">updated_at </th>
              <th class="border border-green-700 px-2 py-1">Laporan</th>
              <th class="border border-green-700 px-2 py-1">Status</th>
              <th class="border border-green-700 px-2 py-1">Catatan Pembimbing</th>
            </tr>
          </thead>
          <tbody>
            @if($DataSesiLap->count() != null)
            @foreach($DataSesiLap as $list)
            <tr class=" text-xs sm:text-sm">
              <td class="border border-green-700 px-2 py-1 text-center">{{$loop->iteration}}</td>
              <td class="border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($list->tanggal)->isoFormat('dddd , DD MMMM Y') }}
              </td>
              <td class="border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($list->created_at)->isoFormat('H:m') }}
              </td>
              <td class="border border-green-700 px-2 py-1 text-center">
                @php
                // Ambil waktu sekarang dalam timezone tertentu, misalnya 'Asia/Jakarta'
                $now = \Carbon\Carbon::now('Asia/Jakarta');

                // Parse waktu dari database atau sumber lainnya ke dalam objek Carbon
                $created_at = \Carbon\Carbon::parse($list->created_at);

                // Hitung selisih waktu antara waktu sekarang dan waktu dari database
                $diff = $created_at->diffForHumans($now);
                @endphp
                <p> {{ $diff }}</p>
              </td>
              <td class="border border-green-700 px-2 py-1 text-center">
                <a href="/laporan-mahasiswa/{{$list->id}}">Laporan </a>
              </td>
              <td class="border border-green-700 px-2 py-1 text-center capitalize">
                @foreach($list->laporanMahasiswa as $status)
                @if($status->status_laporan === 'menunggu')
                <span class="text-red-700 font-semibold">{{$status->status_laporan}}</span>
                @elseif($status->status_laporan === 'valid')
                <span class="text-green-700 font-semibold">{{$status->status_laporan}}</span>
                @elseif($status->status_laporan === null)
                <span class="text-black">Belum melakukan laporan</span>
                @else
                {{$status->status_laporan}}
                @endif
                @endforeach

                @if(count($list->laporanMahasiswa) === 0)
                <span class="text-black">Belum Laporan</span>
                @endif
              </td>
              <td class=" border border-green-700 px-2 py-1">
                @foreach($list->laporanMahasiswa as $status)
                {{$status->note_laporan}}
                @endforeach
              </td>
            </tr>

            @endforeach
            @else
            <tr>
              <td class=" text-red-700 text-center py-1 font-semibold uppercase" colspan="6">tidak ada sesi Laporan</td>
            </tr>
            @endif
            <!-- Tambahkan baris lainnya di sini -->
          </tbody>
        </table>
        @if($list->id->count() === null)
        <a href="/laporan-mahasiswa/{{$list->id}}">
          <div class="  flex gap-2 ">
            <div class=" bg-blue-200 rounded-md ">
              <div class="flex justify-center items-center">
                <span class="grid">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class=" text-blue-500  w-20 h-20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                  </svg>

                </span>
              </div>

            </div>
            <div class=" bg-blue-200 w-full rounded-md">
              @if($DataSesiLap->count() != null)
              @foreach($DataSesiLap as $list)
              <div class=" p-2">
                <tr class=" text-xs sm:text-sm">

                  <td class="border border-green-700 px-2 py-1 text-center">
                    {{ \Carbon\Carbon::parse($list->tanggal)->isoFormat('dddd , DD MMMM Y') }}
                  </td>
                  <td class="border border-green-700 px-2 py-1 text-center">
                    | Jam : {{ \Carbon\Carbon::parse($list->created_at)->isoFormat('H:m') }}
                  </td>
                  <td class="border border-green-700 px-2 py-1 text-center">
                    @php
                    // Ambil waktu sekarang dalam timezone tertentu, misalnya 'Asia/Jakarta'
                    $now = \Carbon\Carbon::now('Asia/Jakarta');

                    // Parse waktu dari database atau sumber lainnya ke dalam objek Carbon
                    $created_at = \Carbon\Carbon::parse($list->created_at);

                    // Hitung selisih waktu antara waktu sekarang dan waktu dari database
                    $diff = $created_at->diffForHumans($now);
                    @endphp
                    <p> {{ $diff }}</p>
                  </td>
                  <td class="border border-green-700 px-2 py-1 text-center">

                  </td>
                  <td class="border border-green-700 px-2 py-1 text-center capitalize">
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
                  </td>
                  <td class=" border border-green-700 px-2 py-1">
                    @foreach($list->laporanMahasiswa as $status)
                    {{$status->note_laporan}}
                    @endforeach
                  </td>
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
        </a>
        @else
        y
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