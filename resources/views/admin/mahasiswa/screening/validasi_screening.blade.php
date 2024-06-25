<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Validasi Dokumen Screening')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Validasi Dokumen Screening
    </h2>

  </x-slot>
  <div class=" w-full p-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" overflow-auto p-6">
        <table class=" w-full">
          <thead class=" border">
            <tr>
              <th>No</th>
              <th>File</th>
              <th>Mahasiswa</th>
              <th>kelompok</th>
              <th>Prodi</th>
              <th>Status File</th>
              <th>Act</th>
            </tr>
          </thead>
          <tbody class=" border sm:overflow-auto">
            @foreach($dataScreening as $item)
            <tr class=" hover:bg-green-200 border">
              <th>
                {{$loop->iteration}}
              </th>
              <td class="">
                <div class=" grid  justify-items-center">
                  <a href="{{ Storage::url('screenings/' . $item['file']) }}" target="_blank" class=" bg-blue-700 px-2 py-1 text-white">
                    <span>
                      lihat
                    </span>
                  </a>
                </div>
              </td>
              <td>
                {{ $item->nama_mhs }} <br>
                {{ $item->nim }}
              </td>
              <td class=" text-center">{{ $item->kelompok }}</td>
              <td>{{ $item->prodi }}</td>
              <td>
                <!-- Check if the status_file is valid -->
                <div class=" grid justify-items-center items-center ">
                  @if ($item->status_file == 'Valid')
                  <!-- Display a green check icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  @elseif ($item->status_file == 'Invalid')
                  <!-- Display a red cross icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                  @else
                  <!-- Display a message indicating the file has not been uploaded -->
                  <span class="text-gray-500">File belum di-upload</span>
                  @endif
                </div>
              </td>
              <td class=" text-center">
                <div class=" flex gxrid-cols-2 gap-2">
                  <a class=" bg-purple-700 px-2 py-1 text-white" href="/update-validasi-pendaftaran/{{$item->id}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                  </a>
                  <form action="/hapus-data-file/{{$item->id}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="bg-red-700 px-2 py-1 text-white" @if($item->status_file == 'Valid')
                      disabled
                      @endif>
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                      </svg>
                    </button>

                  </form>
                </div>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>