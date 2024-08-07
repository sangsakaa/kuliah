<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      @section('title', ' | SCREENING ' . ($mahasiswa->first()->nama_mhs ?? ''))
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
        <div class=" grid  ">

          @if($mahasiswa->isEmpty())
          <p>No data available.</p>
          @else
          @foreach($mahasiswa as $detail)
          @if($detail->id == request('cari') || is_null(request('cari')))
          @else
          <div class="  justify-items-center grid grid-cols-1">
            <p>data sudah di temukan</p>
            <div>
              <div class=" px-6">
                @if (session('success'))
                <div class=" bg-green-400 text-white px-4 py-2">
                  {{ session('success') }}
                </div>
                @endif

                <!-- Notifikasi Error -->
                @if (session('error'))
                <div class=" bg-red-500 text-white px-6 py-2">
                  {{ session('error') }}
                </div>
                @endif
              </div>
            </div>
          </div>
          @endif
          @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
  @if(!$mahasiswa->isEmpty())
  @foreach($mahasiswa as $detail)
  @if($detail->id == request('cari') || is_null(request('cari')))
  @else
  <form action="/screening-mahasiswa-jawab" method="post">
    @csrf
    <div class="w-full py-2 px-2">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-full py-4 px-4 gap-2">
          <div class="grid">
            <div class="grid">
              <span class="font-semibold">1. Data Pribadi</span>
              <div class="grid grid-cols-1 sm:grid-cols-2">
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
                    : {{ \Carbon\Carbon::parse($detail->tgl_lahir)->isoFormat(' DD MMMM Y') }} | <?php
                                                                                                  $dateOfBirth = \Carbon\Carbon::parse($detail->tgl_lahir);
                                                                                                  $age = $dateOfBirth->age;
                                                                                                  echo "$age"
                                                                                                  ?>
                  </div>
                </div>
              </div>
              <div class=" overflow-auto">
                <span class="font-semibold">2. Kondisi Khusus Peserta</span>
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
                        <input required type="radio" name="jawaban[{{$list->id}}]" value="ya" class=" border border-gray-300 p-2" {{isset($jawaban[$list->id]) ? $jawaban[$list->id]->jawaban == 'ya' ? 'checked' : '' : ''}}>
                        <label for="">Ya</label> <br>
                        <input required type="radio" name="jawaban[{{$list->id}}]" value="tidak" class=" border border-gray-300 p-2" {{isset($jawaban[$list->id]) ? $jawaban[$list->id]->jawaban == 'tidak' ? 'checked' : '' : ''}}>
                        <label for="">Tidak</label>
                      </td>
                    </tr>
                    <tr>
                      <td class=" border" colspan="3">
                        <input type="text" placeholder="jika (YA) sebutkan" name="keterangan[{{$list->id}}]" class="w-full border border-gray-300 p-2" value="{{ isset($jawaban[$list->id]) ? $jawaban[$list->id]->keterangan : '' }}">
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @if(count($dataScreening) > 0)
                @foreach($dataScreening as $item)
                <div class=" w-full  flex grid-cols-1 gap-2">
                  <span class="  flex text-red-700 m-2   ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Jawaban
                  </span>
                  @endforeach
                  @else
                  @if($jawaban->count() <= 1 ) <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Submit</button>
                    @else
                    <div class=" flex gap-2  ">
                      <div>
                        <span class="  flex text-red-700 m-2   ">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                          </svg>
                          jawaban
                        </span>
                      </div>
                      <div class="mt-2">
                        @if($jawaban->count() >= 1 )
                        <a target="_blank" class=" bg-red-600  dark:bg-purple-600 py-2  rounded-sm hover:bg-purple-600 text-white px-4 " href="pdf/screen/{{$mahasiswa->first()->nim}}">Cetak Kartu Pendaftaran</a>
                        @else
                        <span class=" bold  mt-6 mx-4 font-semibold">Kartu Akan muncul Ketikan form sudah terisi</span>
                        @endif
                      </div>
                    </div>
                    @endif
                    @endif
                </div>
              </div>
              @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    @endif
  </form>
  <div class="w-full py-2 px-2">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="w-full py-4 px-2 gap-2">
        @if($mahasiswa->isEmpty())
        <p>No data available.</p>
        @else
        @foreach($mahasiswa as $detail)
        @if($detail->id == request('cari') || is_null(request('cari')))
        @else
        <div>
          @if(count($dataScreening) > 0)
          @foreach($dataScreening as $item)
          <div class=" justify-items-center grid grid-cols-1 text-xs">
            <div>
              {{ $item->nim }} -
              {{ $item->nama_mhs }}
            </div>
            <div> {{ $item->prodi }}</div>
            @if ($item->status_file == 'Valid')
            <div>
              <!-- Display a green check icon -->
              <div class=" justify-items-center grid">
                <span class=" flex">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </span>
              </div>
              <div>
                <span class="">
                  Data anda Sudah Valid
                </span>
              </div>
              @elseif ($item->status_file == 'Invalid')
              <!-- Display a red cross icon -->
              <span class=" flex">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </span>
              @else
              <!-- Display a message indicating the file has not been uploaded -->
              <span class="text-red-700">File sudah di-upload <br> menunggu validasi</span>
            </div>
            @endif
          </div>
          @endforeach
          @else
          @if($jawaban->count() >= 1 ) <tr>
            <form action="/uploud-screening-mahasiswa" method="post" enctype="multipart/form-data">
              @csrf
              <input hidden type="text" name="mahasiswa_id" value="{{$detail->id}}">
              <input required type="file" name="file">
              <div class=" py-1">
                <select required name="kelompok" id="" class="py-1 w-full">
                  <option value="">-- Pilih Kelompok --</option>
                  <option value="1">-- Kelompok 1 --</option>
                  <option value="2">-- Kelompok 2 --</option>
                  <option value="3">-- Kelompok 3 --</option>
                  <option value="4">-- Kelompok 4 --</option>
                  <option value="5">-- Kelompok 5 --</option>
                  <option value="6">-- Kelompok 6 --</option>
                  <option value="7">-- Kelompok 7 --</option>
                  <option value="8">-- Kelompok 8 --</option>
                  <option value="9">-- Kelompok 9 --</option>
                </select>
              </div>
              <p class="py-2">
                <button class="bg-red-600 dark:bg-purple-600 py-2 rounded-sm hover:bg-purple-600 text-white px-4">Upload File</button>
              </p>
            </form>
            <td colspan="3" class="text-center">Data sudah di submit dan file belum diupload <br>
              <b>Wajib melampirkan Bukti Pembayaran</b>
            </td>
          </tr>
          @else
          <tr>
            <td colspan="3" class="text-center">
              Data belum diisi dan form upload tidak tersedia
            </td>
          </tr>
          @endif
          @endif
        </div>
        @endif
        @endforeach
        @endif
      </div>
    </div>
  </div>
</x-app-layout>