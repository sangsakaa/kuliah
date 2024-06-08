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
              <td class=" text-center">

                <form action="/daftar-screening-mahasiswa/{{$data[0]->mahasiswa_id}}" method="post">
                  @csrf
                  @method('delete')
                  <button class=" px-2 bg-red-700 text-white">H</button>
                </form>
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