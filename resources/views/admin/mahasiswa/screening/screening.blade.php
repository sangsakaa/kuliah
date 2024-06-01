<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('SCREENING') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class=" w-full py-4 px-4 gap-2">
        <form action="/screening-mahasiswa" method="get" class="  text-sm gap-1 ">
          <div class=" w-full px-4 py-2 gap-2">
            <span class=" uppercase"> ( Nomor Induk Mahasiswa )</span>
            <div class=" py-1">
              <input type="text" max="8" name="cari" value="{{ request('cari') }}" class=" border w-full  py-2 px-2 " placeholder=" Masukan NIM : 20205110108" autofocus>
            </div>
            <button type="submit" class=" hover:bg-blue-800 px-2 py-2 rounded-md w-full    bg-blue-500   text-white">
              Cari By NIM </button>
          </div>
        </form>
        <div class=" grid ">
          <div class=" grid ">
            @if($mahasiswa->isEmpty())
            <p>No data available.</p>
            @else
            @foreach($mahasiswa as $detail)
            @if($detail->id == request('cari') || is_null(request('cari')))
            @else
            <div class="  justify-items-center grid grid-cols-1">
              <p>data sudah di temukan</p>
            </div>
          </div>
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
  <form action="/screening-mahasiswa" method="post">
    @csrf

    <div class="w-full py-2 px-2">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        @if(!$mahasiswa->isEmpty())
        <div class="w-full py-4 px-4 gap-2">
          <div class="grid">

            <div class="grid">
              @foreach($mahasiswa as $detail)
              @if($detail->id == request('cari') || is_null(request('cari')))
              @else
              <span class="font-semibold">1. Data Pribadi</span>
              <div class="grid grid-cols-1">
                <div class="flex">
                  <div class="w-16 ">
                    NIM
                  </div>
                  <div class="">
                    : @if($detail->nim != null)
                    {{$detail->nim}}
                    @else
                    <span class="text-red-600 font-semibold capitalize"> belum ada nis </span>
                    @endif
                  </div>
                </div>
                <div class="flex">
                  <div class="w-16 ">
                    Nama
                  </div>
                  <div class="">
                    : {{$detail->nama_mhs}} <br>

                    <input hidden type="text" name="mahasiswa_id" value="{{$detail->id}}" class="w-full border border-gray-300 p-2">
                  </div>
                </div>
                <div class="flex">
                  <div class="w-16 ">
                    Prodi
                  </div>
                  <div class="">
                    :
                    {{$detail->prodi}}
                    <input hidden type="text" name="mahasiswa_id" value="{{$detail->id}}" class="w-full border border-gray-300 p-2">
                  </div>
                </div>
                <div class="flex">
                  <div class="w-16 ">
                    Tgl Lahir
                  </div>
                  <div class=" capitalize">
                    : {{ \Carbon\Carbon::parse($detail->tgl_lahir)->isoFormat(' DD MMMM Y') }}
                  </div>
                </div>
                <div class="flex">
                  <div class="w-16 ">
                    Usia
                  </div>
                  <div class=" capitalize">
                    :
                    <?php
                    $dateOfBirth = \Carbon\Carbon::parse($detail->tgl_lahir);
                    $age = $dateOfBirth->age;
                    echo "$age"
                    ?>

                  </div>
                </div>
              </div>
              <span class="font-semibold">2. Kondisi Khusus Peserta</span>
              <div class=" overflow-auto">
                <table class="w-full">
                  <thead>
                    <tr class=" border bg-gray-50">
                      <th>Pertanyaan</th>
                      <th>Jawaban</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($soal as $list)

                    <tr class=" border">
                      <td class=" bg-gray-200 border px-2">
                        {{$list->soal}}
                        <input type="text" hidden name="screening_id[]" value="{{$list->id}}" class="w-full border border-gray-300 p-2">
                      </td>
                      <td class=" border ">
                        <input type="radio" name="jawaban[{{$list->id}}]" value="ya" class=" border border-gray-300 p-2" {{isset($jawaban[$list->id]) ? $jawaban[$list->id]->jawaban == 'ya' ? 'checked' : '' : ''}}>
                        <label for="">Ya</label> <br>
                        <input type="radio" name="jawaban[{{$list->id}}]" value="tidak" class=" border border-gray-300 p-2" {{isset($jawaban[$list->id]) ? $jawaban[$list->id]->jawaban == 'tidak' ? 'checked' : '' : ''}}>

                        <label for="">Tidak</label>
                      </td>

                    </tr>
                    <tr>
                      <td class=" border" colspan="3">
                        <input type="text" placeholder=" jika (YA) sebutkan" name="keterangan[{{$list->id}}]" class="w-full border border-gray-300 p-2">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Submit</button>
                </table>

              </div>
              <div class=" overflow-auto">
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
        @endif
        @if($mahasiswa->isEmpty())
        <p>No data available.</p>
        @else
        @foreach($mahasiswa as $detail)
        @if($detail->id == request('cari') || is_null(request('cari')))
        @else
        <div class=" px-5">
          <div>
            <table class="table-auto w-full border-collapse border border-gray-300">
              <thead>
                <tr>
                  <th class="border border-gray-300 px-4 py-2">Pertanyaan</th>
                  <th class="border border-gray-300 px-4 py-2">Jawaban</th>
                </tr>
              </thead>
              <tbody>
                @foreach($jawaban as $item)
                @if($item->mahasiswa_id == $mahasiswa->first()->id)
                <tr>
                  <td class="border border-gray-300 px-4 py-2">{{$item->soal}}</td>
                  <td class="border border-gray-300 px-4 py-2 capitalize">{{$item->jawaban}}</td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        @endif
        @endforeach
        @endif
      </div>
    </div>
  </form>

</x-app-layout>