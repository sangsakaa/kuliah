<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Validasi Laporan ' )
    <h2 class="font-semibold text-lg text-gray-800 leading-tight">
      {{ __('Sesi Validasi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" p-2">
    <div class=" p-4   bg-white w-full py-2 px-2 ">
      <div class=" p-1 sm:p-4 grid grid-cols-2 sm:grid-cols-4">
        <div class=" capitalize">NIDN</div>
        <div class=" capitalize"> :
          {{ $dataDosen->nidn ?? 'Data Dosen not found.' }}
        </div>
        <div class=" capitalize">Pembimbing</div>
        <div class=" capitalize"> :
          {{ strtolower(substr($dataDosen->nama_dosen, 0, 20)) }}{{ strtolower(strlen($dataDosen->nama_dosen) > 15 ? '...' : '') }}
        </div>
        <div class=" capitalize">Kelompok</div>
        <div class=" capitalize"> : {{$dataDosen->nama_kelompok}}</div>

      </div>
    </div>
    <style>
      .marquee {
        width: 100%;
        overflow: hidden;
        white-space: nowrap;
        box-sizing: border-box;
      }

      .marquee span {
        display: inline-block;
        padding-left: 100%;
        animation: marquee 20s linear infinite;
      }

      @keyframes marquee {
        0% {
          transform: translate(0, 0);
        }

        100% {
          transform: translate(-100%, 0);
        }
      }
    </style>
    <div class=" mt-2  bg-white w-full py-2 px-2 ">
      <div class=" capitalize">
        {{ \Carbon\Carbon::parse($tanggal->toDateString())->isoFormat('dddd , DD MMMM Y') }}
        <div class="clock text-md" id="clock"></div>
        <div class="marquee">
          <span>Jangan Lupa dijiwai dengan Ajaran Wahidiyah dan Bacalah Nida "YAA SAYYIDI YAA RASULLAH"</span>
        </div>
        <script>
          function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const currentTime = `Jam : ${hours}:${minutes}:${seconds}`;
            document.getElementById('clock').textContent = currentTime;
          }

          setInterval(updateClock, 1000);
          updateClock();
        </script>
      </div>

    </div>
    <div class=" mt-2  bg-white w-full py-2 px-2 ">
      <div class=" sm:justify-end justify-start grid">
        <form action="/sesi-validasi-laporan-mhs" method="get" class=" py-1 ">
          <input type="date" name="tanggal" value="{{ $tanggal->toDateString() }}" class=" border border-green-800 text-green-800   dark:bg-dark-bg py-1 " placeholder=" Cari ..">
          <button type="submit" class=" px-2 py-1   bg-blue-700  text-white">
            Cari Tanggal </button>
        </form>
      </div>
      <div class=" overflow-auto">
        <table class=" w-full">
          <thead>
            <tr class=" uppercase text-xs">
              <th class="border border-green-700 px-2 py-1 text-center">No</th>
              <th class="border border-green-700 px-2 py-1 text-center">Status</th>
              <th class="border border-green-700 px-2 py-1 text-center">Mahasiswa</th>
              <!-- <th class="border border-green-700 px-2 py-1 text-center">Tanggal</th> -->
              <th class="border border-green-700 px-2 py-1 text-center">Jam</th>
              <th class="border border-green-700 px-2 py-1 text-center">File</th>
            </tr>
          </thead>
          <tbody class=" text-xs">
            @if($dataLaporan->count() != null)
            @foreach($dataLaporan as $data)
            <tr class=" hover:bg-gray-100">

              <td class=" border border-green-700 px-2 py-1 text-center">{{ $loop->iteration }}</td>
              <td class=" border border-green-700 px-2 py-1 text-center capitalize">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  @foreach($data->laporanMahasiswa as $status)
                  @if($status->status_laporan === 'menunggu')
                  <span class="text-red-700 font-semibold grid justify-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </span>
                  @elseif($status->status_laporan === 'valid')
                  <span class="text-green-700 font-semibold grid justify-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                  </span>
                  @elseif($status->status_laporan === null)
                  <span class="text-black">Belum melakukan laporan</span>
                  @else
                  {{$status->status_laporan}}
                  @endif
                  @endforeach
                  @if(count($data->laporanMahasiswa) === 0)
                  <span class="text-red-700">Invalid</span>
                  @endif
                </a>
              </td>
              <td class=" capitalize border border-green-700 px-2 py-1 text-left">
                <a href="/daftar-validasi-laporan-mhs/{{$data->id}}">
                  @foreach($data->Mahasiswa as $list)
                  @foreach($list->Mahasiswa as $detil)
                  {{strtolower($detil->nama_mhs)}}
                  @endforeach
                  @endforeach
                  <br>
                  @foreach($data->Mahasiswa as $list)
                  @foreach($list->Mahasiswa as $detil)
                  {{strtolower($detil->prodi)}}
                  @endforeach
                  @endforeach
                </a>

              </td>
              <!-- <td class=" border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($data->tanggal)->isoFormat('dddd , DD MMMM Y') }}
              </td> -->
              <td class="border border-green-700 px-2 py-1 text-center">
                {{ \Carbon\Carbon::parse($data->created_at)->isoFormat('H:m') }}
              </td>
              <td class=" border border-green-700 px-2 py-1 text-center capitalize">
                @foreach($data->laporanMahasiswa as $status)
                <a href="{{asset('storage/' .$status->bukti_laporan) }}" target="_blank" class="text-blue-500 hover:text-blue-800">Lihat</a>
                @endforeach
              </td>

            </tr>
            @endforeach
            @else
            <tr>
              <td class=" py-1 border-black text-center text-red-700 uppercase border" colspan="9">
                Belum ada Laporan
              </td>
            </tr>
            @endif

          </tbody>
        </table>
      </div>
    </div>
    <div class=" rounded-md  bg-sky-200  mt-1 py-4 px-4  ">
      <p class=" px-2">Note Status :</p>
      <div class="  grid-cols-2">

      </div>
    </div>
  </div>
</x-app-layout>