<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Supervisi ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Supervisi') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/supervisi-dosen" method="post">
          @csrf
          <button class="bg-blue-700 text-white px-2 py-1 mt-2" type="submit">Buat Supervisi</button>
        </form>
      </div>
      <div class=" p-2">
        <div>

        </div>
        <table class=" w-full">
          <thead>
            <tr class=" border px-1 border-black py-1">
              <th class=" border px-1 border-black py-1">Tanggal</th>
              <th class=" border px-1 border-black py-1">Kelompok</th>
              <th class=" border px-1 border-black py-1">Nama Dosen</th>
              <th class=" border px-1 border-black py-1">Lokasi</th>
              <th class=" border px-1 border-black py-1">File</th>
              <th class=" border px-1 border-black py-1">Status</th>
              <th class=" border px-1 border-black w-3">Act</th>
            </tr>
          </thead>
          <tbody>
            @foreach($dataSupervisi as $supervisi)
            <tr class=" border px-1 border-black py-1">
              <td class=" border px-1 border-black py-1 text-center">
                <a href="/laporan-supervisi-dosen/{{$supervisi->id}}">

                  {{ \Carbon\Carbon::parse($supervisi->tanggal)->isoFormat('DD MMMM Y') }}
                </a>
              </td>
              <td class=" border px-1 border-black py-1 text-center">{{ $supervisi->nama_kelompok }}</td>
              <td class=" border px-1 border-black py-1 text-center">{{ $supervisi['nama_dosen'] }}</td>
              <td class=" border px-1 border-black py-1 text-center capitalize">
                Desa.{{ $supervisi->nama_desa }}
                Kec.{{ $supervisi->nama_kecamatan }}
                Kab.{{ $supervisi->nama_kabupaten }}
              </td>
              <td class=" border px-1 border-black py-1 text-center capitalize">
                <a href="/cetak-laporan-supervisi/{{$supervisi->id}}">
                  Cetak
                </a>
              </td>
              <td class=" border px-1 border-black py-1 text-center capitalize">
                @if ($supervisi->Super->whereNull('Bukti_laporan_supervisi')->count() == 1)
                Tuntas Supervisi
                @else
                Belum Tuntas
                @endif

              </td>
              <td>
                <form action="/supervisi-dosen/{{$supervisi->id}}" method="post">
                  @csrf
                  @method('delete')
                  <button class=" bg-red-700 text-white px-1 py-1"> Hapus</button>
                </form>
              </td>
            </tr>

            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>