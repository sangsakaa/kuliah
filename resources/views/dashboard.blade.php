<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class=" w-full py-2 px-2 ">
        <div class=" overflow-hidden shadow-sm sm:rounded-lg">
            @role('pengawas')
            <div class=" grid grid-cols-1 gap-2">
                <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                    <div class=" p-4">
                        Pengawas : <p class=" capitalize">{{strtolower(Auth::user()->name)}}</p>
                    </div>
                </div>
                <div class="  grid w-full  bg-blue-200  gap-2">
                    <div class=" p-4">
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <select id="namaDosenDropdown" style="font-size: 12px; padding: 1px 1px;"></select>
                        <canvas id="grafikStatusLaporan" style="height: 15px;"></canvas>

                        <script>
                            // Data jumlah status_laporan dari PHP
                            var dataLaporan = <?php echo json_encode($jumlahStatusLaporan); ?>;
                            var nama_dosen = Object.keys(dataLaporan);

                            // Populate dropdown options based on nama_dosen array
                            var namaDosenDropdown = document.getElementById('namaDosenDropdown');
                            nama_dosen.forEach(function(nama) {
                                var option = document.createElement('option');
                                option.text = nama;
                                namaDosenDropdown.add(option);
                            });

                            // Function to update chart data and redraw the chart
                            function updateChart(selectedNama) {
                                var jumlahValid = [dataLaporan[selectedNama].valid];
                                var jumlahMenunggu = [dataLaporan[selectedNama].menunggu];
                                var jumlahDraf = [dataLaporan[selectedNama].draf];

                                myChart.data.labels = [selectedNama];
                                myChart.data.datasets[0].data = jumlahValid;
                                myChart.data.datasets[1].data = jumlahMenunggu;
                                myChart.data.datasets[2].data = jumlahDraf;
                                myChart.update();
                            }

                            // Event listener for dropdown change
                            namaDosenDropdown.addEventListener('change', function() {
                                var selectedNama = this.value;
                                updateChart(selectedNama);
                            });

                            // Initial chart setup
                            var ctx = document.getElementById('grafikStatusLaporan').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: [], // Empty labels for initial setup
                                    datasets: [{
                                            label: 'Valid',
                                            data: [],
                                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                            borderColor: 'rgba(75, 192, 192, 1)',
                                            borderWidth: 1,
                                        },
                                        {
                                            label: 'Menunggu',
                                            data: [],
                                            backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                            borderColor: 'rgba(255, 206, 86, 1)',
                                            borderWidth: 1,
                                        },
                                        {
                                            label: 'Draf',
                                            data: [],
                                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                            borderColor: 'rgba(255, 99, 132, 1)',
                                            borderWidth: 1,
                                        },
                                    ],
                                },
                                options: {
                                    indexAxis: 'x', // Display labels on the bottom side of the y-axis
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                        },
                                    },
                                },
                            });

                            // Initialize the chart with the first option
                            updateChart(nama_dosen[0]);
                        </script>



                    </div>

                </div>
            </div>
        </div>
        @endrole
        @role('mahasiswa')
        <div class=" grid grid-cols-1 sm:grid-cols-1 gap-2">
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-4">
                    <p class=" ">Selamat Datang di </p>
                    <p class=" font-serif   text-4xl bold "> SIP-K</p>
                    <p class=" font-serif sm:text-sm text-xs">(Sistem Informasi Pelaporan Kegiatan)</p>
                    <div>
                        @foreach($dataMhs as $detail)
                        <p>{{$detail->nama_mhs}} </p>
                        <p class=" text-sm">{{$detail->nim}} - {{$detail->prodi}}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class=" py-2">
                <div class=" w-full py-2 px-2  grid grid-cols-1 gap-2 sm:grid-cols-4">
                    @if (Auth::user()->hasRole('mahasiswa') && Auth::user()->hasRole('ketua kelompok'))
                    <div class="grid grid-cols-2 gap-2">
                        <a href="/sesi-laporan-mahasiswa">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Sesi laporan</div>
                        </a>
                        <a href="/rekap-laporan-mahasiswa">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Rekap laporan</div>
                        </a>
                        <a href="/sesi-harian">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Presensi</div>
                    </div>
                    @elseif (Auth::user()->hasRole('mahasiswa'))
                    <div class=" grid grid-cols-2 gap-2">
                        <a href="/sesi-laporan-mahasiswa">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Sesi laporan </div>
                        </a>
                        <a href="/rekap-laporan-mahasiswa">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Rekap laporan </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-4">
                    <div>
                        <div class=" p-2">
                            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                            <canvas id="statusChart"></canvas>
                        </div>
                        <script>
                            // Access the chart data passed from the controller
                            var statusChartData = @json($statusChartData);

                            // Create the bar chart
                            var ctx = document.getElementById('statusChart').getContext('2d');
                            var statusChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: statusChartData.labels,
                                    datasets: [{
                                        label: 'Status Laporan',
                                        data: statusChartData.data,
                                        backgroundColor: [
                                            'rgba(255, 99, 132, 0.5)',
                                            'rgba(54, 162, 235, 0.5)',
                                            'rgba(255, 206, 86, 0.5)',
                                        ],
                                        borderColor: [
                                            'rgba(255, 99, 132, 1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)',
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
        @endrole
        @role('dosen')
        <!-- DOSEN -->
        <div class=" grid grid-cols-1 gap-2">
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-4">
                    <p class=" ">Selamat Datang di </p>
                    <p class="  sm:text-5xl bold  text-2xl"> SIP-K</p>
                    <p class=" sm:text-sm text-xs">(Sistem Informasi Pelaporan Kegiatan)</p>
                    <div>

                    </div>
                </div>
            </div>
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-2">
                    <div>
                        <div class=" w-full py-2 px-2  grid grid-cols-2 gap-2 sm:grid-cols-6">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <a href="/sesi-validasi-laporan-mhs">
                                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Val Laporan</div>
                                </a>
                            </div>
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <a href="/data-anggota">
                                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase"> Data Anggota</div>
                                </a>
                            </div>
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <a href="/supervisi-dosen">
                                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase"> Supervisi</div>
                                </a>
                            </div>
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <a href="/daftar-nilai">
                                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase"> Nilai</div>
                                </a>
                            </div>
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <a href="/time-line">
                                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase"> Time Line</div>
                                </a>
                            </div>
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <a href="/rekap-laporan-mhs">
                                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase"> Cek Lap</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  sm:flex grid  bg-gray-200 gap-2 sm:grid-cols-1">
                <div class=" p-4 w-full">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <canvas id="statusChartDosen"></canvas>
                    <script>
                        // Assuming $statusChartData contains the data for the chart

                        // Get the canvas element
                        const statusChartCanvas = document.getElementById('statusChartDosen');

                        // Create the bar chart
                        const statusChart = new Chart(statusChartCanvas, {
                            type: 'bar',
                            data: {
                                labels: @json($statusChartDataDosen['labels']),
                                datasets: [{
                                    label: 'Status Laporan',
                                    data: @json($statusChartDataDosen['data']),
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)', // Menunggu - Red
                                        'rgba(54, 162, 235, 0.2)', // Valid - Blue
                                        'rgba(255, 206, 86, 0.2)', // Draf - Yellow
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
        @endrole
        @role('siaca')
        <div class=" grid grid-cols-1 gap-2">
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-4 text-center w-full">
                    <p class=" ">Selamat Datang di </p>
                    <p class="  text-5xl bold "> SIP-K</p>
                    <p class=" sm:text-sm text-xs">(Sistem Informasi Pelaporan Kegiatan)</p>
                    <div>

                    </div>
                </div>
            </div>
            <div class="  sm:flex grid bg-white  gap-2 sm:grid-cols-1">
                <div class=" overflow-auto p-4 text-center w-full">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <canvas id="grafikStatusLaporan" style="width: 600px; height: 400px;"></canvas>
                    <script>
                        // Data jumlah status_laporan dari PHP
                        var dataLaporan = <?php echo json_encode($jumlahStatusLaporan); ?>;

                        // Mengambil nama-nama dosen sebagai label grafik
                        var namaDosen = Object.keys(dataLaporan);

                        // Mengambil data jumlah status_laporan valid, menunggu, dan draf untuk setiap dosen
                        var jumlahValid = [];
                        var jumlahMenunggu = [];
                        var jumlahDraf = [];

                        namaDosen.forEach(function(nama) {
                            jumlahValid.push(dataLaporan[nama].valid);
                            jumlahMenunggu.push(dataLaporan[nama].menunggu);
                            jumlahDraf.push(dataLaporan[nama].draf);
                        });

                        // Membuat grafik bar
                        var ctx = document.getElementById('grafikStatusLaporan').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: namaDosen,
                                datasets: [{
                                    label: 'Valid',
                                    data: jumlahValid,
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Menunggu',
                                    data: jumlahMenunggu,
                                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                    borderColor: 'rgba(255, 206, 86, 1)',
                                    borderWidth: 1
                                }, {
                                    label: 'Draf',
                                    data: jumlahDraf,
                                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                indexAxis: 'y', // Display labels on the right side of the x-axis
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                    <div>
                        <!-- Tambahkan library Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <!-- Buat elemen canvas untuk menampilkan grafik -->
                        <canvas id="grafikLaporan"></canvas>

                        <!-- Script untuk inisialisasi grafik -->
                        <script>
                            var ctx = document.getElementById('grafikLaporan').getContext('2d');
                            var data = @json($data);
                            var labels = @json($labels);
                            var statusColors = data.map(function(value) {
                                return value === 0 ? 'rgba(75, 192, 192, 0.2)' : 'rgba(75, 192, 192, 0.2)';
                            });

                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: labels, // Placed on the x-axis (horizontal axis)
                                    datasets: [{
                                        label: 'Jumlah Laporan Valid',
                                        data: data, // Placed on the y-axis (vertical axis)
                                        backgroundColor: statusColors,
                                        borderColor: statusColors.map(function(color) {
                                            return color.replace('0.2', '1');
                                        }),
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        x: {
                                            position: 'right', // Display x-axis labels on the right side
                                            beginAtZero: true
                                        },
                                        y: { // Configure the y-axis (vertical axis)
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
            @endrole
            @role('super admin')
            <div class=" w-full  px-2 ">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-4 bg-white  border-gray-200">
                        <div>
                            <div class=" w-full grid grid-cols-1 gap-2 sm:grid-cols-4">
                                <div class=" w-full grid grid-cols-2 bg-red-500 text-white rounded-md">
                                    <div class=" px-4 py-2 grid grid-cols-1">
                                        <div>Mahaiswa Putra</div>
                                        <div>{{ $putra }} Mhs </div>
                                    </div>
                                    <div class="grid  px-4  justify-items-end  content-center  "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-bounding-box inline-block" viewBox="0 0 16 16">
                                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        </svg></div>
                                </div>
                                <div class=" w-full grid grid-cols-2 bg-pink-500 text-white rounded-md">
                                    <div class=" px-4 py-2 grid grid-cols-1">
                                        <div>Mahaiswa Putri</div>
                                        <div>{{ $putri }} Mhs </div>

                                    </div>
                                    <div class=" grid  px-4  justify-items-end  content-center   ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-hearts inline-block" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M11.5 1.246c.832-.855 2.913.642 0 2.566-2.913-1.924-.832-3.421 0-2.566ZM9 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h10s1 0 1-1-1-4-6-4-6 3-6 4Zm13.5-8.09c1.387-1.425 4.855 1.07 0 4.277-4.854-3.207-1.387-5.702 0-4.276ZM15 2.165c.555-.57 1.942.428 0 1.711-1.942-1.283-.555-2.281 0-1.71Z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endrole

</x-app-layout>