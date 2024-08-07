<x-app-layout>
  <x-slot name="header">
    @section('title', ' | Laporan')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Sesi Laporan Harian Mahasiswa') }}
    </h2>
  </x-slot>
  <div class="p-2">
    <div class="   bg-white">
      <div class="p-2   bg-white ">
        <form action="" method="post">
          @csrf
          @method('patch')
          <div class=" flex gap-2">
            <button class=" bg-blue-700 text-white px-2 py-1">update kualistas Laporan</button>
            <div class=" p-1 gap-2 flex">
              <span class=" bg-blue-700 px-2 py-1 text-white">
                {{$cek_lap->count()}}
              </span>
              <span class=" bg-blue-700 px-2 py-1 text-white">
                periode Aktif {{$dataPeriode->nama_periode}}
              </span>
            </div>
          </div>
          <div class="  overflow-auto ">
            <table class=" mt-2  w-full ">
              <thead>
                <tr>
                  <!-- <th class=" border px-1 w-3 ">ID</th> -->
                  <th class=" border px-1 ">No</th>
                  <th class=" border px-1   ">Bukti Laporan</th>
                  <th class=" border px-1  ">Detail Lap</th>
                  <th class=" border px-1 w-20  ">Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($cek_lap as $list)

                <tr>

                  <input type="hidden" name="id[]" value="{{$list->id}}" readonly class=" text-center  w-11 py-1 px-1">
                  <th class=" border">
                    {{$loop->iteration}}
                  </th>
                  <td class=" border w-1/3 ">
                    <img class=" " src="{{ asset('storage/' .$list->bukti_laporan) }}" alt="">
                  </td>
                  <td class=" border">

                    <div class=" grid grid-cols-1 ">
                      <div class=" grid grid-cols-2 capitalize">
                        <div>Nama Mahasiswa </div>
                        <div>
                          : {{strtolower($list->nama_mhs)}}

                        </div>
                        <div>DPL </div>
                        <div>
                          : {{strtolower($list->nama_dosen)}}
                        </div>
                        <div>Status Laporan </div>
                        <div>
                          : {{strtolower($list->status_laporan)}}
                        </div>
                        <div>Tanggal Laporan </div>
                        <div>
                          :
                          {{ \Carbon\Carbon::parse($list->tanggal)->isoFormat('dddd , DD MMMM Y') }}
                        </div>
                      </div>
                      <hr>
                      <div>
                        <textarea name="deskripsi_laporan" id="" class="w-full mt-2 " cols="100" rows="15" required readonly>{{$list->deskripsi_laporan}}
                        </textarea>
                      </div>

                    </div>
                  </td>
                  <td class=" border text-center capitalize">
                    <select name="kualitas_lap[]" id="" class=" py-1 text-sm">
                      <option value=""> Belum di Validasi </option>
                      <option value="ss" {{ $list->kualitas_lap == "ss" ? 'selected' : '' }}> 1 sangat sesuai </option>
                      <option value="s" {{ $list->kualitas_lap == "s" ? 'selected' : '' }}> 2 sesuai</option>
                      <option value="ts" {{ $list->kualitas_lap == "ts" ? 'selected' : '' }}> 3 tidak sesuai </option>
                      <option value="sts" {{ $list->kualitas_lap == "sts" ? 'selected' : '' }}> 4 sangat tidak sesuai</option>
                    </select>
                  </td>
                </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </form>

      </div>
    </div>
</x-app-layout>