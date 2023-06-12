<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Dafta Validasi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" bg-white p-4">

  </div>
  <div class=" mt-2 bg-white p-4">
    <div class=" p-4">
      {{$daftarLapMhs}}
    </div>
  </div>
  </div>
</x-app-layout>