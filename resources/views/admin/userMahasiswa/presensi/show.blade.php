<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Show Presensi Harian') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2  ">
    <div class="bg-white overflow-hidden shadow-sm ">
      <div class=" p-2">

      </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm mt-2 ">
      <div class=" w-full p-2">
        <form action="/daftar-sesi-harian/{{$sesi_Harian->id}}" method="post">
          <button class=" bg-blue-700 px-2 py-1 text-white ">Simpan Presensi</button>
          <a href="/sesi-harian" class=" bg-blue-700 px-2  py-1 text-white">kembali</a>
          @csrf

          <input type="hidden" name="sesi_harian_id" value="{{$sesi_Harian->id}}">
          <table class=" w-full mt-2">
            <thead>
              <tr class=" capitalize">
                <th class=" border px-1">No</th>
                <th class=" border px-1">mahasiswa</th>
                <th class=" border px-1">keterangan</th>
                <th class=" border px-1">alasan</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataAnggota as $item)
              <tr class=" text-xs capitalize">
                <td class=" border px-1 w-5 ">{{$loop->iteration}}
                  <input type="hidden" name="absen[]" value="{{$item->id}}">
                </td>
                <td class=" border px-1  ">
                  {{strtolower($item->nama_mhs)}}
                </td>
                <td class=" border justify-center text-center w-1/3 ">
                  <input type="radio" id="hadir[{{ $item->id }}]" value="hadir" name="keterangan[{{ $item->id }}]" {{ $item->keterangan === "hadir" || $item->keterangan === null ? "checked" : "" }}>
                  <label for="hadir[{{ $item->id }}]">H</label>
                  <input type="radio" id="izin[{{ $item->id }}]" value="izin" name="keterangan[{{ $item->id }}]" {{ $item->keterangan === "izin" ? "checked" : "" }}>
                  <label for="izin[{{ $item->id }}]">I</label>
                  <input type="radio" id="sakit[{{ $item->id }}]" value="sakit" name="keterangan[{{ $item->id }}]" {{ $item->keterangan === "sakit" ? "checked" : "" }}>
                  <label for="sakit[{{ $item->id }}]">S</label>
                  <input type="radio" id="alfa[{{ $item->id }}]" value="alfa" name="keterangan[{{ $item->id }}]" {{ $item->keterangan === "alfa" ? "checked" : "" }}>
                  <label for="alfa[{{ $item->id }}]">A</label>
                </td>
                <td class="  border text-center  px-1">
                  <input value="{{ $item->alasan }}" class=" border py-1 w-full text-center border-blue-600" name="alasan[{{ $item->id }}]" placeholder=" isi alasan">
                </td>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </form>




      </div>
    </div>
  </div>
</x-app-layout>