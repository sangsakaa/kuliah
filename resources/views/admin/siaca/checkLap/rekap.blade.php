<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Cek Laporan Harian') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <div>
        </div>
        <div class=" overflow-auto ">
          <div class=" grid justify-items-end content-end">
            <form action="/cek-laporan" method="get">
              <input type="text" name="cari" value="{{ request('cari') }}" class=" border border-green-800 text-green-800 rounded-md py-1 px-4" placeholder=" Cari ..">
              <button type="submit" class="  bg-green-800 py-1 px-2 rounded-md text-white">
                Cari</button>
            </form>
          </div>
          <table class=" mt-2 w-full">
            <thead>
              <tr>
                <th class=" border-black border">Bukti Lap</th>
                <th class=" border-black border">Detail Laporan</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dataLap as $item)
              <tr>
                <td class=" border-black border w-1/3  ">
                  <img class=" " src="{{ asset('storage/' .$item->bukti_laporan) }}" alt="">
                </td>
                <td class=" border-black border ">
                  <div class=" px-1 grid grid-cols-2 ">
                    <div>Nama Mahasiswa </div>
                    <div>: {{$item->nama_mhs}} </div>
                    <div>Program Studi </div>
                    <div>: {{$item->prodi}} </div>
                    <div>Lokasi</div>
                    <div> : {{$item->lokasi_praktik}}</div>
                    <div>Status Laporan </div>
                    <div class=" capitalize text-green-700">: {{$item->status_laporan}} </div>
                  </div>
                  <div class=" px-1">
                    <hr class=" border-b-2 border-black">
                    {{$item->deskripsi_laporan}}
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class=" py-1">
          {{$dataLap}}
        </div>
      </div>

    </div>
  </div>
</x-app-layout>