<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Validasi Dokumen Screening') }}
    </h2>
  </x-slot>
  <div class=" w-full p-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-6">
        <!-- @foreach($dataScreening as $item)
        <ul>
          <li>
            <a href="{{ Storage::url('screenings/' . $item['file']) }}" target="_blank">
              Lihat File: {{ $item['file'] }}
            </a>
          </li>
        </ul>
        @endforeach -->
        </ul>
        <table class=" w-full">
          <thead class=" border">
            <tr>
              <th>File</th>
              <th>Mahasiswa</th>
              <th>Prodi</th>
            </tr>
          </thead>
          <tbody class=" border">
            @foreach($dataScreening as $item)
            <tr class=" hover:bg-green-200">
              <td>
                <a href="{{ Storage::url('screenings/' . $item['file']) }}" target="_blank">
                  {{ $item['file'] }}
                </a>
              </td>
              <td>{{ $item->nama_mhs }}</td>

              <td>{{ $item->prodi }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>