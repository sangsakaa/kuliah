<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('SCREENING') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" w-full py-4 px-4 gap-2">
        <form action="/screening-mahasiswa" method="get" class="  text-sm gap-1 ">
          <div class=" w-full px-4 py-2 gap-2">
            <span class=" uppercase"> ( Nomor Induk Mahasiswa )</span>
            <div class=" py-1">
              <input type="text" max="8" name="cari" value="{{ request('cari') }}" class=" border w-full  py-2 px-2 " placeholder=" Masukan NIM : 20205110108" autofocus>
            </div>
            <button type="submit" class=" hover:bg-blue-800 px-2 py-2 rounded-md w-full    bg-blue-500   text-white">
              Cari By NIM </button>
          </div>
        </form>
        <div class=" grid ">
          <div class=" grid ">
            @if($mahasiswa->isEmpty())
            <p>No data available.</p>
            @else
            @foreach($mahasiswa as $detail)
            @if($detail->id == request('cari') || is_null(request('cari')))
            @else
            <div class=" grid grid-cols-1">
              <div class=" flex">
                <div class="  w-16 py-2">
                  NIM
                </div>
                <div class=" py-2">
                  : @if($detail->nim != null)
                  {{$detail->nim}}
                  @else
                  <span class=" text-red-600 font-semibold capitalize"> belum ada nis </span>
                  @endif
                </div>
              </div>
              <div class=" flex">
                <div class="  w-16 py-2">
                  Nama
                </div>
                <div class=" py-2">
                  : {{$detail->nama_mhs}}
                </div>
              </div>
              <div class=" flex">
                <div class="  w-16 py-2">
                  Tgl Lahir
                </div>
                <div class=" py-2  capitalize">
                  : {{ \Carbon\Carbon::parse($detail->tgl_lahir)->isoFormat(' DD MMMM Y') }}
                </div>
              </div>
            </div>
          </div>
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
  <form action="" method="post">
    <div class=" w-full py-2 px-2 ">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class=" w-full py-4 px-4 gap-2">
          <div class=" grid ">
            <span class=" font-semibold">1. Data Pribadi</span>
            <div class=" grid ">
              @if($mahasiswa->isEmpty())
              <p>No data available.</p>
              @else
              @foreach($mahasiswa as $detail)
              @if($detail->id == request('cari') || is_null(request('cari')))
              @else
              <div class=" grid grid-cols-1">
                <div class=" flex">
                  <div class="  w-16 py-2">
                    NIM
                  </div>
                  <div class=" py-2">
                    : @if($detail->nim != null)
                    {{$detail->nim}}
                    @else
                    <span class=" text-red-600 font-semibold capitalize"> belum ada nis </span>
                    @endif
                  </div>
                </div>
                <div class=" flex">
                  <div class="  w-16 py-2">
                    Nama
                  </div>
                  <div class=" py-2">
                    : {{$detail->nama_mhs}}
                  </div>
                </div>
                <div class=" flex">
                  <div class="  w-16 py-2">
                    Tgl Lahir
                  </div>
                  <div class=" py-2  capitalize">
                    : {{ \Carbon\Carbon::parse($detail->tgl_lahir)->isoFormat(' DD MMMM Y') }}
                  </div>
                </div>
              </div>
            </div>
            @endif
            @endforeach
            @endif
            <span class=" font-semibold">2. Kondisi Khusus Peserta</span>
            <div>
              <table class=" overflow-auto w-full">
                <thead>
                  <tr class=" border">
                    <th class=" border px-4 py-2">Pertanyaan</th>
                    <th class=" border px-4 py-2">Peryataan</th>
                    <th class=" border px-4 py-2">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class=" border">
                    <td class=" border">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, iusto.</td>
                    <td class=" border   w-fit">
                      <input type="radio"> Ya <br>
                      <input type="radio"> Tidak
                    </td>
                  </tr>
                  <tr class=" border">
                    <td class=" border">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, iusto.</td>
                    <td class=" border   w-fit">
                      <input type="radio"> Ya <br>
                      <input type="radio"> Tidak
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
</x-app-layout>