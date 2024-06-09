<style>
  table {
    border-collapse: collapse;
  }

  .soal th,
  .soal td {
    border: 1px solid black;
    padding: 2px;
    text-align: left;
  }

  .tanya {

    width: 500px;
  }

  .ttd {
    padding-left: 20px;
  }

  * {
    font-family: 'Times New Roman', Times, serif !important;
  }

  .bio {

    width: 100%;
  }

  span {
    padding-left: 50px;
  }

  .nama {
    margin-top: 70px;
  }

  body {
    font-family: Arial, sans-serif;
    font-size: smaller;
  }
</style>
<div>

  <!-- <img  width="100px" height="100px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}"> -->
  <style>
    .font-new {
      font-family: sans-serif
    }

    .sekretariat {
      font-size: 12px;
      text-align: center;
    }

    .kop-1 {
      font-size: 19px;
      text-align: center;
      font-weight: bold;
    }

    .kop {
      text-align: center;
    }
  </style>
  <table class="  kop">
    <tr>
      <td>
        <img height="100px" width="100px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}" alt="Logo">
      </td>
      <td>
        <span class=" kop-1">
          Yayasan Perjuangan Wahidiyah dan Pondok Pesantren Kedunglo <br>
          Universitas Wahidiyah <br>
          Panitia Pelaksanaan Kuliah Kerja Nyata (KKN) <br>
        </span>
        <span class="sekretariat ">SK Kemendikbud RI. Nomor 608/E/O/2014 Tanggal 17 Oktober 2014</span> <br>
        <span class=" sekretariat">Sekretariat : Pon-Pes Kedunglo Jl KH. Wahid Hasyim Kota Kediri Jawa Timur 64114 Telp. (0354) 771018 <br>
          Email: rektorat@uniwa.ac.id </span>
      </td>
    </tr>
  </table>
  <hr>
  Surat Pernyataan Kesehatan Diri <br>
  peserta Kuliah Kerja Nyata (KKN) <br>
  Universitas Wahidiyah Kediri
  <p class=" justified-text">
    Dengan Hormat, <br> Sehubungan dengan Persyatan Peserta KKN yang ditetapkan Panitia KKN UNIWA, dengan ini saya memberikan pertanyaan-pertanyaan atau informasi sebagai berikut :
  </p>
  <table class=" bio">
    <tr>
      <td>NIM </td>
      <td>: {{$mahasiswa->first()->nim}}</td>
      <td>Tanggal Lahir </td>
      <td>
        : {{ \Carbon\Carbon::parse($mahasiswa->first()->tgl_lahir)->isoFormat(' DD MMMM Y') }}
      </td>
    </tr>
    <tr>
      <td>Nama Lengkap </td>
      <td>: {{$mahasiswa->first()->nama_mhs}}</td>
      <td>Tinggi Badan </td>
      <td> : .......... Cm</td>
    </tr>
    <tr>
      <td>Prodi </td>
      <td> : {{$mahasiswa->first()->prodi}}</td>
      <td>Berat Badan </td>
      <td>: .......... Kg</td>
    </tr>
  </table>
</div>
2. Kondisi Khusus Peserta
<table class=" bio soal table text-xs table-auto w-full  custom-border capitalize">
  <thead>
    <tr>
      <th class="tanya px-1 py-1">Pertanyaan</th>
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
          echo "...................";
        }
        ?>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
3. Riwayat Penyakit Peserta dalam 6 bulan terakhir
<table class=" bio  soal table text-xs table-auto w-full border-collapse custom-border capitalize">
  <thead>
    <tr class="bg-gray-100">
      <th class="tanya border border-gray-300 px-1 py-1">Pertanyaan</th>
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
          echo "...................";
        }
        ?>
      </td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
<style>
  p {
    text-align: justify;
  }
</style>
<div class="  text-justify text-sm  mt-4">
  <p class=" justified-text ">
    <span class="  pl-12">Saya menyatakan dengan sebenar-benarnya bahwa seluruh pernyataan yang saya nyatakan</span> dalam Surat dan jawaban-jawaban Pernyataan Kesehatan Diri ini telah diberikan secara benar, lengkap dan sesuai dengan keadaan/kondisi yang sebenarnya.
  </p>
  <p class="justified-text">
    <span class="  pl-12">Apabila ada pernyataan atau jawaban saya yang bertentangan</span> dengan keadaan sebenarnya atau adanya penyembunyian fakta-fakta/keterangan-keterangan yang seharusnya di kemukakan dalam Surat Pernyataan ini, maka saya sanggup menerima sanksi sesuai peraturan yang berlaku.
  </p>
</div>


<div>
  <table class=" ttd bio">
    <tr>
      <td class=" ">
        <div class=" ttd text-xs grid grid-cols-2 mt-4">
          <div class="    pl-20">
            Mengetahui,<br>
            Ketua RT/RW/Klinik,
            <p class="nama mt-20">..................................................</p>
          </div>

        </div>
      </td>
      <td class=" ">
        <div class="   pl-32  ">
          Kediri, {{ now()->locale('id')->isoFormat('LL') }} <br>
          <!-- <br> yang membuat pernyataan <br> -->
          Mahasiswa,
          <p class="nama mt-20 underline">{{$mahasiswa->first()->nama_mhs}} <br> NIM {{$mahasiswa->first()->nim}}</p>

        </div>
        </th>
    </tr>
  </table>
  <ul class=" ">
    <li>
      Peserta yang berstatus

      bukan santri
      Ponpes Kedunglo mengetahui ketua RT/RW
    </li>
    <li>
      Peserta yang berstatus

      santri

      Ponpes Kedunglo mengetahui ketua Klinik Wahidiyah
    </li>
  </ul>
</div>