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
        <table>
          <thead>
            <tr>
              <th class=" border">Bukti Lap</th>
              <th class=" border">Detail Lapran</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($dataLap as $item)
            <tr>
              <td class=" border w-1/2 ">
                <img class=" p-2" src="{{ asset('storage/' .$item->bukti_laporan) }}" alt="" width="600" height="100">
              </td>
              <td class=" border">
                <div class=" grid grid-cols-2 ">
                  <div>Lokasi</div>
                  <div> : {{$item->lokasi_praktik}}</div>
                  <div>Status Laporan </div>
                  <div>: {{$item->status_laporan}} </div>
                  <div>Status Laporan </div>
                  <div>: {{$item->nama_mhs}} </div>
                  <div>Status Laporan </div>
                  <div>: </div>
                </div>
                <div>
                  <p class="  text-left ">{{$item->deskripsi_laporan}}</p>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>
  </div>
</x-app-layout>