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
                <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Submit</button>
                <button class=" bg-red-600  dark:bg-purple-600 py-2  rounded-sm hover:bg-purple-600 text-white px-4 " onclick="printContent('surat-ket')">
                  Cetak Kartu Kesehatan
                </button>
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
        <div id="surat-ket" class=" text-xs sm:text-xs font-serif px-5">
          <div>
            <div class="  gap-2 ">
              <div class=" flex">
                <div class=" py-2">
                  <img src="{{ asset('img/logo.png') }}" alt="Logo" class="     " width="120px" height="120px">
                </div>
                <div class="  text-center w-full">
                  <p class=" uppercase font-new font-semibold">
                    yayasan perjuangan wahidiyah dan pondok pesantren kedunglo
                  </p>
                  <style>
                    .font-new {
                      font-family: sans-serif
                    }
                  </style>
                  <p class=" uppercase font-semibold  font-new ">universitas wahidiyah</p>
                  <p class=" uppercase  font-semibold font-new   ">panitia pelaksanaan kuliah kerja nyata (KKN)</p>
                  <p class=" text-sm ">SK Kemendikbud RI. Nomor 608/E/O/2014 Tanggal 17 Oktober 2014</p>
                  <p class="  text-xs capitalize ">Sekretariat : pon-pes kedunglo Jl KH. Wahid Hasyim Kota Kediri Jawa Timur 64114 Telp. (0354) 771018</p>
                  <p class="  text-xs  ">Email : rektorat@uniwa.ac.id</p>
                </div>
              </div>
              <hr class=" mt-2 border-b-2 border-black">
              <hr class=" mt-0.5 border border-black">
            </div>
            <div class=" ">
              <div class=" mt-2 text-md-center  text-center  uppercase  font-serif">
                <p class="  font-semibold">Surat pernyataan kesehatan diri</p>
                <p class="  font-semibold">peserta kuliah kerja nyata (KKN)</p>
                <p class="  font-semibold">universitas wahidiyah kediri</p>
              </div>
              <p class=" text-sm text-justify">
                Dengan Hormat, <br> sehubungan dengan Persyatan Peserta KKN yang ditetapkan Panitia KKN UNIWA, dengan ini saya memberikan pertanyaan-pertanyaan atau informasi sebagai berikut :
              </p>
              <span class="font-semibold">1. Data Pribadi</span>
              <div class="grid grid-cols-2 text-xs">
                <div class="flex">
                  <div class="w-32 ">
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
                  <div class="w-32 ">
                    Nama
                  </div>
                  <div class="">
                    : {{$detail->nama_mhs}} <br>
                    <input hidden type="text" name="mahasiswa_id" value="{{$detail->id}}" class="w-full border border-gray-300 p-2">
                  </div>
                </div>
                <div class="flex">
                  <div class="w-32 ">
                    Prodi
                  </div>
                  <div class="">
                    :
                    {{$detail->prodi}}
                    <input hidden type="text" name="mahasiswa_id" value="{{$detail->id}}" class="w-full border border-gray-300 p-2">
                  </div>
                </div>
                <div class="flex">
                  <div class="w-32 ">
                    Tgl Lahir
                  </div>
                  <div class=" capitalize">
                    : {{ \Carbon\Carbon::parse($detail->tgl_lahir)->isoFormat(' DD MMMM Y') }}| <?php
                                                                                                $dateOfBirth = \Carbon\Carbon::parse($detail->tgl_lahir);
                                                                                                $age = $dateOfBirth->age;
                                                                                                echo "$age"
                                                                                                ?>
                  </div>
                </div>
              </div>
              <div class=" ">
                <span class="font-semibold">2. Kondisi Khusus Peserta</span>
                <div class=" pl-4">
                  <table class="  table-auto w-full border-collapse border border-gray-300 text-sm capitalize">
                    <thead>
                      <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-2 py-1">Pertanyaan</th>
                        <th class="border border-gray-300 px-2 py-1">Jawaban</th>
                        <th class="border border-gray-300 px-2 py-1">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Tabel untuk kategori 2 -->
                      @foreach($jawaban as $item)
                      @if($item->mahasiswa_id == $mahasiswa->first()->id && $item->kategori == 2)
                      <tr>
                        <td class="border border-gray-300 px-2 py-1">{{$item->soal}}</td>
                        <td class="border border-gray-300 px-2 py-1 capitalize">{{$item->jawaban}}</td>
                        <td class="border border-gray-300 px-2 py-1 capitalize">
                          <?php
                          if (!is_null($item->keterangan)) {
                            echo $item->keterangan;
                          } else {
                            echo ".........................................";
                          }
                          ?>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <span class="font-semibold">3. Riwayat Penyakit Peserta dalam 6 bulan terakhir</span>
                <div class=" pl-4">
                  <table class="  table-auto w-full border-collapse border border-gray-300 text-sm capitalize">
                    <thead>
                      <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-2 py-1">Pertanyaan</th>
                        <th class="border border-gray-300 px-2 py-1">Jawaban</th>
                        <th class="border border-gray-300 px-2 py-1">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Tabel untuk kategori 3 -->
                      @foreach($jawaban as $item)
                      @if($item->mahasiswa_id == $mahasiswa->first()->id && $item->kategori == 3)
                      <tr>
                        <td class="border border-gray-300  px-2 py-1">{{$item->soal}}</td>
                        <td class="border border-gray-300  px-2 py-1 capitalize">{{$item->jawaban}}</td>
                        <td class="border border-gray-300  px-2 py-1 capitalize">
                          <?php
                          if (!is_null($item->keterangan)) {
                            echo $item->keterangan;
                          } else {
                            echo ".........................................";
                          }
                          ?>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="  text-justify text-sm  mt-4">
                <p class=" ">
                  <span class=" pl-16">Saya menyatakan dengan sebenar-benarnya bahwa seluruh pernyataan yang saya nyatakan</span> dalam Surat dan jawaban-jawaban Pernyataan Kesehatan Diri ini telah diberikan secara benar, lengkap dan sesuai dengan keadaan/kondisi yang sebenarnya.
                </p>
                <p>
                  <span class=" pl-16">Apabila ada pernyataan atau jawaban saya yang bertentangan</span> dengan keadaan sebenarnya atau adanya penyembunyian fakta-fakta/keterangan-keterangan yang seharusnya di kemukakan dalam Surat Pernyataan ini, maka saya sanggup menerima sanksi sesuai peraturan yang berlaku.
                </p>
              </div>
              <div class=" grid grid-cols-2 mt-4">
                <div>
                  Mengetahui,<br>
                  Ketua RT/RW/Klinik,OK,
                  <p class=" mt-20">..................................................</p>
                </div>
                <div class=" text-xs">
                  Kediri, {{ now()->locale('id')->isoFormat('LL') }} <br>
                  <!-- <br> yang membuat pernyataan <br> -->
                  Mahasiswa,
                  <p class=" mt-20 underline">{{$mahasiswa->first()->nama_mhs}}

                  <p class=" ">NIM {{$mahasiswa->first()->nim}}
                  </p>
                </div>
              </div>
              <div class=" mt-6 px-4">
                <ul class=" list-disc">
                  <li>
                    Peserta yang berstatus bukan santri Ponpes Kedunglo mengetahui ketua RT/RW
                  </li>
                  <li>
                    Peserta yang berstatus santri Ponpes Kedunglo mengetahui ketua Klinik Wahidiyah
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        @endif
        @endforeach
        @endif
      </div>
    </div>
  </form>
  <script>
    function printContent(el) {
      var fullbody = document.body.innerHTML;
      var printContent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printContent;
      window.print();
      document.body.innerHTML = fullbody;
    }
  </script>


</x-app-layout>