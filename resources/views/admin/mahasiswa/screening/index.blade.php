<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Daftar screening') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" px-4 py-4">
        <table class=" w-full">
          <thead>
            <tr class=" border">
              <th class=" border ">No</th>
              <th class=" border text-left ">Daftar Mahasiswa</th>
              <th class=" border ">Action</th>
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
                {{$data[0]->nama_mhs}}
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