<x-app-layout>
  <x-slot name="header">
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
              <th class=" border ">No</th>
              <th class=" border ">Kelompok</th>
              <th class=" border ">Dosen Pembimbing Lapangan</th>
              <!-- Add more table headers for other columns if needed -->
            </tr>
          </thead>
          <tbody>
            @foreach ($daftarNilai as $nilai)
            <tr class=" border">
              <td class=" border text-center">{{ $loop->iteration }}</td>
              <td class=" border text-center"><a href="/nilai-peserta-kkn/{{$nilai->id}}">{{ $nilai->nama_kelompok }}</a></td>
              <td class=" border text-center">{{ $nilai->nama_dosen }}</td>
              <!-- Add more table cells for other columns if needed -->
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</x-app-layout>