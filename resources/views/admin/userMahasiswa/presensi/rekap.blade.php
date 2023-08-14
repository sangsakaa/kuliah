<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Rekap Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-4">
        <div class=" grid grid-cols-2 gap-2">

          <div>
            <form action="/rekap-sesi-harian" method="get" class="mr-auto">
              <input type="date" name="tanggal" class="py-1 dark:bg-dark-bg" value="{{ $tanggal->toDateString() }}">
              <button class=" bg-red-600 py-1 dark:bg-purple-600 mt-1 my-1 rounded-sm hover:bg-purple-600 text-white px-4 ">
                Pilih Tanggal
              </button>
            </form>
            <table class=" w-full">
              <thead>
                <tr class="  uppercase text-sm">
                  <th rowspan="2" class=" border">No</th>
                  <th rowspan="2" class=" border">Absen</th>
                  <th rowspan="2" class=" border">Hari</th>
                  <th rowspan="2" class=" border">tanggal</th>
                  <th rowspan="2" class=" border">Kel</th>
                  <th colspan="4" class=" border">Keterangan</th>
                  <th rowspan="2" class=" border">Act</th>

                </tr>
                <tr class="  uppercase text-sm">

                  <th class=" border">H</th>
                  <th class=" border">I</th>
                  <th class=" border">S</th>
                  <th class=" border">A</th>


                </tr>
              </thead>
              <tbody>
                @if($SesiHarian->count()!= null)
                @foreach($SesiHarian as $sesi)
                <tr class=" hover:bg-green-200 even:bg-gray-200">
                  <td class=" py-1 border  text-center">{{$loop->iteration}}</td>
                  <td class=" border  text-center"><a href="/daftar-sesi-harian/{{$sesi->id}}" class=" bg-blue-700 px-2  py-1 text-white">absen</a></td>
                  <td class=" border  text-center"><a href="/daftar-sesi-harian/{{$sesi->id}}">
                      {{ \Carbon\Carbon::parse($sesi->tanggal)->isoFormat('dddd') }}
                    </a></td>
                  <td class=" border  text-center"><a href="/daftar-sesi-harian/{{$sesi->id}}">
                      {{ \Carbon\Carbon::parse($sesi->tanggal)->isoFormat('DD MMMM Y') }}
                    </a></td>
                  <td class=" border  text-center">{{$sesi->nama_kelompok}}</td>
                  <td class=" border  text-center">
                    {{$sesi->Kelompok->where('keterangan','hadir')->count()}}
                  </td>
                  <td class=" border  text-center">
                    {{$sesi->Kelompok->where('keterangan','izin')->count()}}
                  </td>
                  <td class=" border  text-center">
                    {{$sesi->Kelompok->where('keterangan','sakit')->count()}}
                  </td>
                  <td class=" border  text-center">
                    {{$sesi->Kelompok->where('keterangan','alfa')->count()}}
                  </td>
                  <td class=" border  text-center">
                    <form action="rekap-sesi-harian/{{$sesi->id}}" method="post">
                      @csrf
                      @method('delete')
                      <button class=" bg-red-700 py-1 px-2 text-white">H</button>
                    </form>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="10" class=" border text-center">
                    <span class=" text-red-700  uppercase text-sm">Belum ada sesi</span>
                  </td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
          <div>
            <table class=" w-full">
              <thead>
                <tr>
                  <th class=" border px-1 w-5">No</th>
                  <th class=" border px-1">Tanggal</th>
                  <th class=" border px-1">Kelompok</th>
                  <th class=" border px-1">Keterangan</th>
                  <th class=" border px-1">Alasan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($dataAnggota as $anggota)
                <tr class=" border ">
                  <th class=" border  capitalize px-1">{{ $loop->iteration }}</th>
                  <td class=" border  capitalize px-1">{{ strtolower($anggota->nama_mhs) }}</td>
                  <td class=" border  capitalize px-1">{{ $anggota->nama_kelompok}}</td>
                  <td class=" border  capitalize px-1">{{ $anggota->keterangan }}</td>
                  <td class=" border  capitalize px-1">{{ $anggota->alasan }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
</x-app-layout>