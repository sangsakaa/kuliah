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
    border-width: 2.5px;

  }

  span.label-lap {
    text-align: center;
    font-size: 14px;
    margin-bottom: 10px;
    text-transform: uppercase;
    /* Combine the text-transform properties */
    font-weight: bold;
    display: flex;
    /* Add this line */
    justify-content: center;
    /* Add this line */
    align-items: center;
    /* Add this line if you want vertical centering too */
  }


  .th {
    background-color: green;
    border: 1px;
  }

  .table {
    width: 100%;
    border-collapse: collapse;
    font-size: smaller;
  }

  .table th,
  .table td {
    border: 1px solid #ddd;
    padding: 3px;
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

  input {
    width: 90%;
    padding: 20px;
    margin: 10px;
    box-sizing: border-box;

  }

  .sekretariat {
    font-size: 12px;
    text-align: center;
  }

  .kop-1 {
    font-size: 14px;
    text-align: center;
    font-weight: bold;
    text-transform: uppercase;
  }

  .kop {
    text-align: center;
  }

  td.number {
    text-align: center;
  }

  td.rekap {
    text-align: center;
  }

  th.rekap-rekap {
    text-align: center;
  }
</style>
<table class="kop">
  <tr>
    <td>
      <img height="99px" width="99px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/logo.png'))) }}" alt="Logo">
    </td>
    <td>
      <span class=" kop-1">
        Yayasan Perjuangan Wahidiyah dan Pondok Pesantren Kedunglo <br>
        Universitas Wahidiyah <br>
        Panitia Pelaksanaan Kuliah Kerja Nyata (KKN) <br>
      </span>
      <span class="sekretariat ">SK Kemendikbud RI. Nomor 608/E/O/2014 Tanggal 17 Oktober 2014 <br>Sekretariat : Pon-Pes Kedunglo Jl KH. Wahid Hasyim Kota Kediri Jawa Timur 64114 Telp. (0354) 771018 <br>Email: rektorat@uniwa.ac.id</span>
    </td>
  </tr>
</table>

<hr class="line2">
<div>
  <span class=" label-lap">laporan pendaftaran
    <br>
    Kuliah Kerja Nyata (KKN) Universitas Wahidiyah <br>
    Tanggal Download {{\Carbon\Carbon::parse(now())->isoFormat(' DD MMMM Y')}}
  </span>
</div>
<div>
  <table class="table">
    <thead>
      <tr>
        <th class="rekap-rekap">Kelompok</th>
        <th class="rekap-rekap">Total</th>
        <th class="rekap-rekap">Valid Count</th>
        <th class="rekap-rekap">Invalid Count</th>
        <th class="rekap-rekap">Null Count</th>
      </tr>
    </thead>
    <tbody>
      @foreach($results as $kelompok => $result)
      <tr class=" ">
        <td>Kelompok {{ $kelompok ??'' }}</td>
        <td class="rekap">{{ $result['total'] }}</td>
        <td class="rekap">{{ $result['valid_count'] }}</td>
        <td class="rekap">{{ $result['invalid_count'] }}</td>
        <td class="rekap">{{ $result['null_count'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div>
  <span>Pendaftar dengan Status Valid</span>
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Mahasiswa</th>
        <th>Tanggal Pendaftaran</th>
        <th>Status File</th>
      </tr>
    </thead>
    <tbody id="dataTableValid">
      @php $no = 1; @endphp
      @foreach($groupedData as $key => $pendaftaran)
      @if ($pendaftaran[0]->status_file == 'Valid')
      <tr>
        <td class="number">{{ $no++ }}</td>
        <td>
          {{ $pendaftaran[0]->nim }} -
          {{ $pendaftaran[0]->nama_mhs }}
          <br>
          {{ $pendaftaran[0]->prodi }}
        </td>
        <td>
          <div>
            Daftar : {{\Carbon\Carbon::parse($pendaftaran[0]->tgl_daftar)->isoFormat(' DD MMMM Y')}}
          </div>
          <div>
            @if ($pendaftaran[0]->tgl_update_file)
            Uploud : {{\Carbon\Carbon::parse($pendaftaran[0]->tgl_update_file)->isoFormat(' DD MMMM Y')}}
            @else
            Belum upload file
            @endif
          </div>
        </td>
        <td class="number">
          Diterima
        </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
  <span>Pendaftar dengan Status belum Uploud file</span>
  <table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Mahasiswa</th>
        <th>Tanggal Pendaftaran</th>
        <th>Status File</th>
      </tr>
    </thead>
    <tbody id="dataTableNull">
      @php $no = 1; @endphp
      @foreach($groupedData as $key => $pendaftaran)
      @if (is_null($pendaftaran[0]->status_file) || $pendaftaran[0]->status_file != 'Valid')
      <tr>
        <td class="number">{{ $no++ }}</td>
        <td>
          {{ $pendaftaran[0]->nim }} -
          {{ $pendaftaran[0]->nama_mhs }}
          <br>
          {{ $pendaftaran[0]->prodi }}
        </td>
        <td>
          <div>
            Daftar :
            {{\Carbon\Carbon::parse($pendaftaran[0]->tgl_daftar)->isoFormat(' DD MMMM Y')}}
          </div>
          <div>
            @if ($pendaftaran[0]->tgl_update_file)
            Uploud :
            {{\Carbon\Carbon::parse($pendaftaran[0]->tgl_update_file)->isoFormat(' DD MMMM Y')}}
            @else
            Belum upload file
            @endif
          </div>
        </td>
        <td class="number">
          @if ($pendaftaran[0]->status_file == 'Invalid')
          Ditolak
          @else
          Belum Upload
          @endif
        </td>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
  <style>
    .ttd {
      width: 400px;
      height: 140px;
      margin-top: 0px;
      float: right;
    }
  </style>
  <img class="ttd" height="100px" width="100px" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('/img/ttd.jpeg'))) }}" alt="Logo">
  <script>
    function filterTable() {
      const searchInput = document.getElementById('search').value.toLowerCase();
      const tableRows = document.querySelectorAll('#dataTable tr');

      tableRows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        const namaMhs = cells[1].textContent.toLowerCase();
        const nim = cells[2].textContent.toLowerCase();
        const prodi = cells[3].textContent.toLowerCase();
        const createdAt = cells[4].textContent.toLowerCase();
        const statusFile = cells[5].textContent.toLowerCase();
        if (namaMhs.includes(searchInput) || nim.includes(searchInput) || prodi.includes(searchInput) || createdAt.includes(searchInput) || statusFile.includes(searchInput)) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>
</div>