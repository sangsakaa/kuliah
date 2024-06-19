<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Daftar screening') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" px-4 py-4">
        <div>

          <div class="grid sm:grid-cols-6 gap-2">
            @foreach($countProdi as $prodi => $counts)
            <div class="p-2 border rounded-md 
                @if(strpos($prodi, 'Teknik') !== false) bg-blue-200 
                @elseif(strpos($prodi, 'Pendidikan') !== false) bg-pink-200 
                @elseif(strpos($prodi, 'Akuntansi') !== false || strpos($prodi, 'Manajemen') !== false) bg-yellow-200
                @endif">
              <p class="text-xs">
                @if ($prodi === 'S1 Pendidikan Guru Pendidikan Anak Usia Dini')
                Pend. PG PAUD
                @elseif ($prodi === 'S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)')
                Pend. Hukum Keluarga Islam
                @elseif ($prodi === 'S1 Pendidikan Matematika')
                Pend. Matematika
                @elseif ($prodi === 'S1 Pendidikan Bahasa Inggris')
                Pend. Bahasa Inggris
                @elseif ($prodi === 'S1 Pendidikan Kimia')
                Pend. Kimia
                @else
                {{ $prodi }}
                @endif
              </p>
              <p class="text-sm">Jumlah Mahasiswa : {{ $counts['unique_mahasiswa_id'] }}</p>
            </div>
            @endforeach
          </div>
          <div>
            <table hidden class="border-collapse border border-gray-500">
              <thead>
                <tr>
                  <th class="border border-gray-500 ">Program Studi</th>
                  <th class="border border-gray-500 ">Jumlah Mahasiswa</th>
                </tr>
              </thead>
              <tbody>
                @foreach($countProdi as $prodi => $counts)
                <tr>
                  <td class="border border-gray-500 ">{{ $prodi }}</td>
                  <td class="border border-gray-500 ">{{ $counts['unique_mahasiswa_id'] }}</td>

                </tr>
                @endforeach
              </tbody>
            </table>
            <table hidden class="border-collapse border border-gray-500">
              <thead>
                <tr>
                  @foreach($countProdi as $prodi => $counts)
                  <th class="border border-gray-500">

                    @if ($prodi === 'S1 Hukum Keluarga Islam (Ahwal Syakhshiyyah)')
                    S1 HKI
                    @elseif ($prodi === 'S1 Pendidikan Guru Pendidikan Anak Usia Dini')
                    S1 PG PAUD
                    @elseif ($prodi === 'S1 Pendidikan Bahasa Inggris')
                    S1 PG PAUD
                    @else
                    {{ $prodi }}
                    @endif
                  </th>
                  @endforeach

                </tr>
              </thead>
              <tbody>
                <tr>
                  @foreach($countProdi as $prodi => $counts)
                  <td class="border border-gray-500">{{ $counts['unique_mahasiswa_id'] }}</td>

                  @endforeach
                </tr>
              </tbody>
            </table>

          </div>
        </div>
        <hr class=" mt-1 border-2 border-black">
        <hr class=" mt-0.5 border-black">

        <table class=" mt-2 w-full">
          <thead>
            <tr class=" border">
              <th class=" px-2 border ">No</th>
              <th class=" px-2 border text-left ">NIM</th>
              <th class=" px-2 border text-left ">Daftar Mahasiswa</th>
              <th class=" px-2 border text-left ">Program Studi</th>
              <th class=" px-2 border ">Status File</th>
              <th class=" px-2 border ">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($groupedData as $mahasiswaId => $data)
            @if ($data->isNotEmpty())
            <tr class=" border even:bg-gray-100 hover:bg-green-200">

              <th class=" px-2">
                {{$loop->iteration}}
              </th>
              <td class=" px-2">
                {{$data[0]->nim}}
              </td>
              <td class=" px-2">
                {{$data[0]->nama_mhs}}
              </td>
              <td class=" px-2">
                {{$data[0]->prodi}}
              </td>
              <td class=" px-2">

                <div class=" justify-items-center grid">
                  @if ($data[0]->status_file == 'Valid')
                  <!-- Display a green check icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                  @elseif ($data[0]->status_file == 'Invalid')
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
              <td>
                <div class="  flex  justify-center">
                  <form action="/daftar-screening-mahasiswa/{{$data[0]->mahasiswa_id}}" method="post">
                    @csrf
                    @method('delete')
                    <button class="  text-red-700" title="hapus file">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </form>
                  <a href="/update-validasi-pendaftaran/{{$data[0]->idfile}}" class=" text-yellow-400" title="Validasi File">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                  </a>
                </div>


              </td>

            </tr>
            @endif
            @endforeach

          </tbody>
        </table>


      </div>
    </div>
  </div>

</x-app-layout>