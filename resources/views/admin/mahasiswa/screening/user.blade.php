<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Mahasiswa') }}
    </h2>
  </x-slot>
  <div class=" w-full py-2 px-2 ">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div>
        <div id="surat-ket" class=" hidden text-xs sm:text-xs font-serif px-5">
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
            <div class=" font-serif ">
              <div class=" mt-2 text-md-center  text-center  uppercase  text-sm font-serif">
                <p class="  font-semibold">Surat pernyataan kesehatan diri</p>
                <p class="  font-semibold">peserta kuliah kerja nyata (KKN)</p>
                <p class="  font-semibold">universitas wahidiyah kediri</p>
              </div>
              <p class=" text-sm text-justify">
                Dengan Hormat, <br> Sehubungan dengan Persyatan Peserta KKN yang ditetapkan Panitia KKN UNIWA, dengan ini saya memberikan pertanyaan-pertanyaan atau informasi sebagai berikut :
              </p>
              <span class="font-semibold  text-sm">1. Data Pribadi</span>
              <div class=" px-4 grid grid-cols-2 text-xs">
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
                    Tinggi Badan
                  </div>
                  <div class=" capitalize">
                    : .......cm
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
                    Berat Badan
                  </div>
                  <div class=" capitalize">
                    : .......kg
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
                    : {{ \Carbon\Carbon::parse($detail->tgl_lahir)->isoFormat(' DD MMMM Y') }} | <?php
                                                                                                  $dateOfBirth = \Carbon\Carbon::parse($detail->tgl_lahir);
                                                                                                  $age = $dateOfBirth->age;
                                                                                                  echo "$age"
                                                                                                  ?>
                  </div>
                </div>


              </div>
              <div class=" ">
                <span class="font-semibold text-sm">2. Kondisi Khusus Peserta</span>
                <div class=" pl-4">
                  <table class=" text-xs  table-auto w-full border-collapse border border-gray-300  capitalize">
                    <thead>
                      <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-1 py-1">Pertanyaan</th>
                        <th class="border border-gray-300 px-1 py-1">Jawaban</th>
                        <th class="border border-gray-300 px-1 py-1">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Tabel untuk kategori 2 -->
                      @foreach($jawaban as $item)
                      @if($item->mahasiswa_id == $mahasiswa->first()->id && $item->kategori == 2)
                      <tr>
                        <td class="border border-gray-300 px-1 py-1  w-2/3">{{$item->soal}}</td>
                        <td class="border border-gray-300 px-1 py-1 capitalize text-center ">{{$item->jawaban}}</td>
                        <td class="border border-gray-300 px-1 py-1 capitalize">
                          <?php
                          if (!is_null($item->keterangan)) {
                            echo $item->keterangan;
                          } else {
                            echo "..............................";
                          }
                          ?>
                        </td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
                  </table>
                </div>
                <span class="font-semibold text-sm">3. Riwayat Penyakit Peserta dalam 6 bulan terakhir</span>
                <div class=" pl-4">
                  <table class="  table-auto w-full border-collapse border border-gray-300 text-xs capitalize">
                    <thead>
                      <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-1 py-1">Pertanyaan</th>
                        <th class="border border-gray-300 px-1 py-1">Jawaban</th>
                        <th class="border border-gray-300 px-1 py-1">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <!-- Tabel untuk kategori 3 -->
                      @foreach($jawaban as $item)
                      @if($item->mahasiswa_id == $mahasiswa->first()->id && $item->kategori == 3)
                      <tr>
                        <td class="border border-gray-300  px-1 py-1   w-2/3 ">{{$item->soal}}</td>
                        <td class="border border-gray-300  px-1 py-1 capitalize text-center ">{{$item->jawaban}}</td>
                        <td class="border border-gray-300  px-1 py-1 capitalize">
                          <?php
                          if (!is_null($item->keterangan)) {
                            echo $item->keterangan;
                          } else {
                            echo "..............................";
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
                  <span class="  pl-12">Saya menyatakan dengan sebenar-benarnya bahwa seluruh pernyataan yang saya nyatakan</span> dalam Surat dan jawaban-jawaban Pernyataan Kesehatan Diri ini telah diberikan secara benar, lengkap dan sesuai dengan keadaan/kondisi yang sebenarnya.
                </p>
                <p>
                  <span class="  pl-12">Apabila ada pernyataan atau jawaban saya yang bertentangan</span> dengan keadaan sebenarnya atau adanya penyembunyian fakta-fakta/keterangan-keterangan yang seharusnya di kemukakan dalam Surat Pernyataan ini, maka saya sanggup menerima sanksi sesuai peraturan yang berlaku.
                </p>
              </div>
              <div class=" text-xs grid grid-cols-2 mt-4">
                <div class="    pl-20">
                  Mengetahui,<br>
                  Ketua RT/RW/Klinik,
                  <p class=" mt-20">..................................................</p>
                </div>
                <div class="   pl-32  ">
                  Kediri, {{ now()->locale('id')->isoFormat('LL') }} <br>
                  <!-- <br> yang membuat pernyataan <br> -->
                  Mahasiswa,
                  <p class=" mt-20 underline">{{$mahasiswa->first()->nama_mhs}}

                  <p class=" ">NIM {{$mahasiswa->first()->nim}}
                  </p>
                </div>
              </div>
              <div class="  text-xs mt-6 px-4">
                <ul class=" list-disc">
                  <li>
                    Peserta yang berstatus
                    <span class=" font-semibold underline">
                      bukan santri
                    </span> Ponpes Kedunglo mengetahui ketua RT/RW
                  </li>
                  <li>
                    Peserta yang berstatus
                    <span class="  font-semibold underline">
                      santri
                    </span>
                    Ponpes Kedunglo mengetahui ketua Klinik Wahidiyah
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>