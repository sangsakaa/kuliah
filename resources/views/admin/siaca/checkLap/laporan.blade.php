<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Laporan')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class="p-2">
    <div class=" grid  bg-white p-4">
      <div class="px-2 mt-2   bg-white ">
        <div class="px-2 py-2">
          <form action="" method="post">
            @csrf
            @method('patch')
            <div>
              <button class=" bg-blue-700 text-white px-2 py-1">update kualistas Laporan</button>
              <div>
                {{$cek_lap->count()}}
              </div>
            </div>
            <table class=" mt-2 w-full">
              <thead>
                <tr>
                  <!-- <th class=" border px-1 w-3 ">ID</th> -->
                  <th class=" border px-1 ">No</th>
                  <th class=" border px-1 w-1/4 ">Bukti Laporan</th>
                  <th class=" border px-1 ">Detail Lap</th>
                  <th class=" border px-1 ">Deskripsi Laporan</th>
                  <th class=" border px-1 ">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cek_lap as $list)

                <tr>

                  <input type="hidden" name="id[]" value="{{$list->id}}" readonly class=" text-center  w-11 py-1 px-1">

                  <th class=" border">
                    {{$loop->iteration}}
                  </th>
                  <td class=" border">

                    <img class=" " src="{{ asset('storage/' .$list->bukti_laporan) }}" alt="" height="100px" width="100px">
                  </td>
                  <td class=" border">
                    {{$list->deskripsi_laporan}}
                  </td>
                  <td class=" border text-center capitalize">
                    {{$list->kualitas_lap}}
                  </td>
                  <td class=" border text-center capitalize">
                    <select name="kualitas_lap[]" id="" class=" py-1">
                      <option value=""> Kosong </option>
                      <option value="sangat sesui" {{ $list->kualitas_lap == "sangat sesui" ? 'selected' : '' }}> 1 sangat sesui </option>
                      <option value=" sesui" {{ $list->kualitas_lap == "sesui" ? 'selected' : '' }}> 2 sesui</option>
                      <option value="tidak sesuai" {{ $list->kualitas_lap == "tidak sesuai" ? 'selected' : '' }}> 3 tidak sesuai </option>
                      <option value="sangat tidak sesuai" {{ $list->kualitas_lap == "sangat tidak sesuai" ? 'selected' : '' }}> 4 sangat tidak sesuai</option>
                    </select>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
</x-app-layout>