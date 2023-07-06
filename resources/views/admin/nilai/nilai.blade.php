<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Input Nilai ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Nilai Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/nilai-peserta-kkn/{{$daftarNilai->id}}" method="post">
          @csrf
          <div class=" grid justify-end">
            <button class=" bg-blue-700 text-white py-1 px-1">Simpan Nilai</button>
          </div>
          <input type="text" name="daftar_nilai_id" hidden value="{{$daftarNilai->id}}">
          <table class=" mt-2 w-full">
            <thead>
              <tr class=" border uppercase text-sm">
                <th class=" border ">No</th>
                <th class=" border ">Nama</th>
                <th class=" border text-center w-15">Program Studi</th>
                <th class=" border text-center  w-5 px-1">Kel</th>
                <th class=" border text-center w-15">nilai</th>
                <th class=" border text-center w-15">Predikat</th>
              </tr>
            </thead>
            <tbody>
              @foreach($dataAnggota as $anggota)
              <tr class=" border">
                <td class=" border px-1 text-center">
                  {{ $loop->iteration }}
                </td>
                <input type="hidden" name="mahasiswa_id[]" value="{{$anggota->id}}">
                <td class=" border px-1 capitalize">{{strtolower( $anggota->nama_mhs) }}</td>
                <td class=" border px-1 text-center">{{ $anggota->prodi }}</td>
                <td class=" border px-1 text-center">{{ $anggota->nama_kelompok }}</td>
                <td class=" border px-1 text-center">
                  <input value="{{$anggota->nilai_akhir}}" class="sm:text-sm text-xs px-1 py-1 w-full text-center" type="text" name="nilai_akhir[{{$anggota->id}}]" default="0" placeholder="min: 50 max:100">
                </td>
                <td class=" border px-1 text-center">
                  @if($anggota->nilai_akhir >= 90 && $anggota->nilai_akhir <= 100) "A" @elseif($anggota->nilai_akhir >= 80 && $anggota->nilai_akhir <= 89) "B" @elseif($anggota->nilai_akhir >= 70 && $anggota->nilai_akhir <= 79) "C" @elseif($anggota->nilai_akhir >= 60 && $anggota->nilai_akhir <= 69) "D" @elseif($anggota->nilai_akhir < 60) "E" @else "Nan" @endif </td>

              </tr>
              @endforeach
            </tbody>
          </table>
        </form>

      </div>
    </div>
  </div>
</x-app-layout>