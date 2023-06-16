<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Laporan User Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="  flex bg-blue-300">
        <div>

        </div>
        <div>

        </div>
      </div>
    </div>
    <div class="p-4 mt-2 bg-white  border-gray-200">
      <div>
        {{$LapMhs}}
        <table class=" w-full">
          <thead>
            <tr>

              <th class=" border">No</th>
              <th class=" border">Nama</th>
              <th class=" border">Email</th>

            </tr>
          </thead>
          <tbody>

      </div>
    </div>
  </div>
  </div>
</x-app-layout>