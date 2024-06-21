<style>
  .body {
    max-width: 100%;
    max-height: fit-content;
  }

  .container {
    display: flex;
    align-items: center;
    flex-direction: column;
    text-align: center;
  }

  .header {
    display: flex;
    align-items: center;
    margin-bottom: 0px;
  }

  .logo {
    flex: 0 0 100px;
    height: 100px;
  }

  .kop-1 {
    flex: 2;
    font-size: 18px;
    font-weight: bold;
  }

  .sekretariat {
    font-size: 14px;
    margin-top: 5px;
  }



  hr.line2 {

    /* Mengatur margin khusus untuk elemen <hr> dengan kelas "line2" */
    border-style: double;
  }

  p.label-lap {
    text-align: center;
    font-size: 14px;

    margin-bottom: 10px;
    text-transform: capitalize;

  }

  .th {
    background-color: green;
    border: 1px;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
  }

  .table th,
  .table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  .table th {
    background-color: #f2f2f2;
    color: black;
  }

  .table tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .table tr:hover {
    background-color: #ddd;
  }

  .table th,
  .table td {
    border-bottom: 1px solid #ddd;
  }

  .table th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
  }
</style>
<!-- <div hidden class="container">
  <div class="header">
    <div class="kop-1">
      <img class="logo" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}" alt="Logo">
    </div>
    <div>
      <span class=" kop-1">
        Yayasan Perjuangan Wahidiyah dan Pondok Pesantren Kedunglo <br>
        Universitas Wahidiyah <br>
        Panitia Pelaksanaan Kuliah Kerja Nyata (KKN) <br>
      </span>
      SK Kemendikbud RI. Nomor 608/E/O/2014 Tanggal 17 Oktober 2014 <br>
      Sekretariat: Pon-Pes Kedunglo Jl KH. Wahid Hasyim Kota Kediri Jawa Timur 64114 Telp. (0354) 771018 <br>
      Email: rektorat@uniwa.ac.id
    </div>
  </div>
</div> -->
<hr class="line2">
<div>
  <p class=" label-lap">
    laporan harian pendaftaran
    <br>
    Kegiatan Kuliah Kerja Nyata (KKN) Universitas Wahidiyah
  </p>
</div>
<div>
  <table class="table">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>NIM</th>
      <th>Prodi</th>
      <th>Tanggal Daftar</th>
      <th>Status</th>
    </tr>
    @foreach($groupedData as $key => $pendaftaran)
    <tr>
      <td>{{ $loop->iteration }}</td>
      <td>{{ $pendaftaran[0]->nama_mhs }}</td>
      <td>{{ $pendaftaran[0]->nim }}</td>
      <td>{{ $pendaftaran[0]->prodi }}</td>
      <td>{{ $pendaftaran[0]->created_at }}</td>
      <td>{{ $pendaftaran[0]->status_file }}</td>
    </tr>
    @endforeach
  </table>
</div>