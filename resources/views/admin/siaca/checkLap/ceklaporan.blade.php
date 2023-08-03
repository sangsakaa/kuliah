<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Cek Lap Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div>

        @foreach($ScoreDosen as $list)
        <ul>
          <li>


            {{$loop->iteration}} .
            {{$list->nama_mhs}}
            {{$list->status_laporan}}
          </li>
        </ul>
        @endforeach
      </div>
    </div>
  </div>
</x-app-layout>