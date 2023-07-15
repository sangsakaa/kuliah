<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Nilai ' )
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dafta Nilai Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-2">
        <form action="/daftar-nilai" method="post">
          @csrf
          <button class=" bg-blue-700 px-1  text-white py-1">Nilai KKN</button>
        </form>
      </div>
      <div class=" p-2">
        <table class=" w-full">
          <thead>
            <tr class=" border ">
              <th rowspan="2" class=" border ">No</th>
              <th rowspan="2" class=" border ">Kelompok</th>
              <th rowspan="2" class=" border ">Dosen Pembimbing Lapangan</th>
              <th rowspan="2" class=" border ">JMl</th>
              <th colspan="3" class=" border ">Status</th>
              <!-- Add more table headers for other columns if needed -->
            </tr>
            <tr class=" border  ">
              <th class=" border  justify-center text-green-700 px-2 "><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="  w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
              </th>
              <th class=" border text-center  px-2 text-red-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>

              </th>
            </tr>
          </thead>
          <tbody>
            @foreach ($daftarNilai as $nilai)
            <tr class=" border">
              <td class=" border text-center">{{ $loop->iteration }}</td>
              <td class=" border text-center"><a href="/nilai-peserta-kkn/{{$nilai->id}}">{{ $nilai->nama_kelompok }}</a></td>
              <td class=" border text-center">{{ $nilai->nama_dosen }}</td>
              <td class=" border text-center">{{ $nilai->Nilai->count() }}</td>
              <td class=" border text-center w-10">
                {{ $nilai->Nilai->whereNotNull('nilai_akhir')->count();}}
              </td>
              <td class=" border text-center w-10">
                {{$nilai->Nilai->whereNull('nilai_akhir')->count(); }}
              </td>
              <!-- Add more table cells for other columns if needed -->
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>