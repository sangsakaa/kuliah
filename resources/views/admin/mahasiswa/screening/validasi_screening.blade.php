<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">

      @section('title', ' | Validasi Dokumen Screening ')
    </h2>
  </x-slot>
  <div class=" w-full p-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" p-6">
        <table class=" w-full">
          <thead class=" border">
            <tr>
              <th>File</th>
              <th>Mahasiswa</th>
              <th>Prodi</th>
              <th>Status File</th>
              <th>Act</th>
            </tr>
          </thead>
          <tbody class=" border">
            @foreach($dataScreening as $item)
            <tr class=" hover:bg-green-200">
              <td>
                <a href="{{ Storage::url('screenings/' . $item['file']) }}" target="_blank">
                  {{ $item->file }}
                </a>
              </td>
              <td>{{ $item->nama_mhs }}</td>
              <td>{{ $item->prodi }}</td>
              <td class=" grid justify-items-center ">
                <!-- Check if the status_file is valid -->

                @if ($item->status_file == 'Valid')
                <!-- Display a green check icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                @else
                <!-- Display a red cross icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                @endif
              </td>
              <td class=" text-center">
                <a class=" bg-purple-700 px-2 py-1 text-white" href="/update-validasi-pendaftaran/{{$item->id}}">Validasi</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>