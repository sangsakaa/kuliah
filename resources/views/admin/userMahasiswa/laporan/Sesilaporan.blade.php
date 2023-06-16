<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight sm:text-left text-center">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>

  <div class=" w-full py-2 px-2 ">
    <div class=" py-1 mt-2 bg-white">
      <div class="p-4 sm:p-2 bg-white  border-gray-200">
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
            <div class=" text-center  grid grid-cols-1 ">
              <div class=" text-2xl"> {{$data->nama_mhs}}</div>
              <div> {{$data->nim}}</div>
              <div class=" uppercase"> Kelompok {{$data->nama_kelompok}}</div>
              <div class=" uppercase"> {{$data->nama_dosen}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

    <head>
      <title>Unggah Gambar dengan Kamera</title>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <div class=" p-4 w-full">
      <form action="/sesi-laporan-mahasiswa" method="post" enctype="multipart/form-data">
        @csrf
        <div class=" grid grid-cols-1 sm:grid-cols-4 gap-2">
          <input type="date" name="tanggal" class=" w-full py-1" id="" required>
          <input type="hidden" name="kelompok_id" value="{{$dataKelompok->kelompok_id}}" class=" w-full py-1" id="">
          <button class=" px-2 py-1 bg-blue-700 text-white">Buat Laporan Harian</button>
        </div>
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

      <table class="w-full border border-green-700">
        <thead>
          <tr>
            <th class="border border-green-700 px-2 py-1 w-5 sm:w-3">No</th>

            <th class="border border-green-700 px-2 py-1">Tanggal</th>
            <th class="border border-green-700 px-2 py-1">Jam </th>
            <th class="border border-green-700 px-2 py-1">Laporan</th>
            <th class="border border-green-700 px-2 py-1">Status</th>
            <th class="border border-green-700 px-2 py-1">Catatan Pembimbing</th>
          </tr>
        </thead>
        <tbody>
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
          <!-- Tambahkan baris lainnya di sini -->
        </tbody>
      </table>
    </div>
  </div>






</x-app-layout>