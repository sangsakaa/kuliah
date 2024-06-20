<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Daftar Pedaftar') }}
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
                @elseif(strpos($prodi, 'S1 Agroteknologi') !== false || strpos($prodi, 'S1 Agribisnis') !== false) bg-green-200
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
            Jumlah total : {{$jumlahTotal}}
            Jumlah Valid : {{$jumlahTotalValid}}
            Jumlah Belum Upload : {{$jumlahTotalList}}
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
        <div class=" overflow-auto rounded-md">
          <table class=" mt-2 w-full">
            <thead>
              <tr class=" border">
                <th class=" px-2 border ">No</th>
                <th class=" px-2 border text-left ">File</th>
                <th class=" px-2 border text-left ">Daftar Mahasiswa</th>

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
                  <a href="{{ $data[0]->file ? Storage::url('screenings/' . $data[0]->file) : '#' }}" target="{{ $data[0]->file ? '_blank' : '_self' }}" class="{{ $data[0]->file ? 'hover:bg-blue-400 bg-blue-700' : 'bg-red-500' }} px-2 py-1 text-white">
                    <span>
                      Dokumen
                    </span>
                  </a>
                </td>
                <td class=" px-2">
                  {{$data[0]->nim}} -
                  {{$data[0]->nama_mhs}}
                  <br>
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
                    @elseif ($data[0]->file == '')
                    <span class="text-red-500">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                      </svg>
                    </span>
                    @else
                    <!-- Display a message indicating the file has not been uploaded -->
                    <span class=" text-green-700">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                      </svg>
                    </span>
                    @endif
                  </div>
                </td>
                <td>
                  <div class="  flex justify-center gap-2">
                    <form action="/daftar-screening-mahasiswa/{{$data[0]->mahasiswa_id}}" method="post">
                      @csrf
                      @method('delete')
                      <button class=" bg-red-700 px-2 py-1 text-white" title="hapus file">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                      </button>
                    </form>
                    <a href="/update-validasi-pendaftaran/{{$data[0]->idfile}}" class="{{ $data[0]->idfile ? 'bg-blue-700 text-white' : 'bg-red-600 text-white' }} py-1 px-2" title="Validasi File">
                      <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                      </span>
                    </a>

                    <form action="/hapus-data-file/{{$data[0]->idfile}}" method="post">
                      @csrf
                      @method('delete')
                      <button class=" bg-red-700 px-2 py-1 text-white" title="hapus file">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endif
              @endforeach
              <tr>
                <td colspan="5">

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>