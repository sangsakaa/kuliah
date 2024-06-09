<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>bukti screen - {{$mahasiswa->first()->nama_mhs}}</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
  .custom-border {
    border: 2px solid black;
    /* Adjust thickness and color as needed */
  }

  .custom-border th,
  .custom-border td {
    border: 1px solid black;
    /* Adjust thickness and color as needed */
  }

  .custom-border thead tr {
    background-color: #f0f0f0;
    /* Adjust background color for header */
  }

  .custom-border tbody tr:nth-child(even) {
    background-color: #f9f9f9;
    /* Adjust background color for even rows */
  }

  .justified-text {
    text-align: justify;
  }
</style>

<body>
  <img src="{{ asset('img/ori.png') }}" alt="Logo" class="     " width="120px" height="120px">
  <div>
    <div class=" container">
      {{$mahasiswa->first()->nim}}
      {{$mahasiswa->first()->nama_mhs}}
      {{$mahasiswa->first()->prodi}}
    </div>

    <hr>
    <div class=" font-serif ">

      <center>
        Surat pernyataan kesehatan diri <br>
        peserta kuliah kerja nyata (KKN) <br>
        universitas wahidiyah kediri
      </center>

    </div>
    <p class=" justified-text">
      Dengan Hormat, <br> Sehubungan dengan Persyatan Peserta KKN yang ditetapkan Panitia KKN UNIWA, dengan ini saya memberikan pertanyaan-pertanyaan atau informasi sebagai berikut :
    </p>
    <p>
      1. Data Pribadi <br>
      a. Nama Lengkap :{{$mahasiswa->first()->nim}} <br>
      b. Tanggal Lahir : {{$mahasiswa->first()->nama_mhs}} <br>
      c. Program Studi :{{$mahasiswa->first()->prodi}} <br>
      d. Tinggidan Berat Badan dalam 3 tahun terakhir <br>
      1.Tinggi Badan :.......... <br>
      2. Berat Badan :.......... <br>
    </p>
  </div>
  <table class="table text-xs table-auto w-full  custom-border capitalize">
    <thead>
      <tr>
        <th class="px-1 py-1">Pertanyaan</th>
        <th class="px-1 py-1">Jawaban</th>
        <th class="px-1 py-1">Keterangan</th>
      </tr>
    </thead>
    <tbody>
      <!-- Tabel untuk kategori 2 -->
      @foreach($jawaban as $item)
      @if($item->mahasiswa_id == $mahasiswa->first()->id && $item->kategori == 2)
      <tr>
        <td class="px-1 py-1 w-2/3">{{$item->soal}}</td>
        <td class="px-1 py-1 capitalize text-center ">{{$item->jawaban}}</td>
        <td class="px-1 py-1 capitalize">
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

  </table>
  <table class="table text-xs table-auto w-full border-collapse custom-border capitalize">
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
  <div class="  text-justify text-sm  mt-4">
    <p class=" justified-text ">
      <span class="  pl-12">Saya menyatakan dengan sebenar-benarnya bahwa seluruh pernyataan yang saya nyatakan</span> dalam Surat dan jawaban-jawaban Pernyataan Kesehatan Diri ini telah diberikan secara benar, lengkap dan sesuai dengan keadaan/kondisi yang sebenarnya.
    </p>
    <p class="justified-text">
      <span class="  pl-12">Apabila ada pernyataan atau jawaban saya yang bertentangan</span> dengan keadaan sebenarnya atau adanya penyembunyian fakta-fakta/keterangan-keterangan yang seharusnya di kemukakan dalam Surat Pernyataan ini, maka saya sanggup menerima sanksi sesuai peraturan yang berlaku.
    </p>
  </div>


  <div>
    <table>
      <tr>
        <td>
          <div class=" ttd text-xs grid grid-cols-2 mt-4">
            <div class="    pl-20">
              Mengetahui,<br>
              Ketua RT/RW/Klinik,
              <p class=" mt-20">..................................................</p>
            </div>

          </div>
        </td>
        <td>
          <div class="   pl-32  ">
            Kediri, {{ now()->locale('id')->isoFormat('LL') }} <br>
            <!-- <br> yang membuat pernyataan <br> -->
            Mahasiswa,
            <p class=" mt-20 underline">{{$mahasiswa->first()->nama_mhs}} <br> NIM {{$mahasiswa->first()->nim}}</p>

          </div>
          </th>
      </tr>
    </table>
  </div>
  <div class="  text-xs ">
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>