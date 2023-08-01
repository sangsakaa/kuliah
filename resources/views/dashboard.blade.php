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
                <div class="  grid w-full bg-white  gap-2">
                    <div class=" p-4">
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <select id="namaDosenDropdown" style="font-size: 12px; padding: 1px 1px;"></select>

                        <canvas id="grafikStatusLaporan" style="width: 100px; height: 25px;"></canvas>

                        <script>
                            // Data jumlah status_laporan dari PHP
                            var dataLaporan = <?php echo json_encode($jumlahStatusLaporan); ?>;
                            var namaDosen = Object.keys(dataLaporan);

                            // Populate dropdown options based on namaDosen array
                            var namaDosenDropdown = document.getElementById('namaDosenDropdown');
                            namaDosen.forEach(function(nama) {
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
                                    indexAxis: 'y', // Display labels on the right side of the x-axis
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                        },
                                    },
                                },
                            });

                            // Initialize the chart with the first option
                            updateChart(namaDosen[0]);
                        </script>

                    </div>

                </div>
            </div>
        </div>
        @endrole
        @role('mahasiswa')
        <div class=" grid grid-cols-1 gap-2">
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-4">
                    <p class=" ">Selamat Datang di </p>
                    <p class="  text-5xl bold "> SIP-K</p>
                    <p class=" sm:text-sm text-xs">(Sistem Informasi Pelaporan Kegiatan)</p>
                    <div>
                        @foreach($dataMhs as $detail)
                        <p>{{$detail->nama_mhs}}</p>
                        <p class=" text-sm">{{$detail->nim}}</p>
                        {{$detail->prodi}} ({{$detail->jenis_kelamin}})
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="  sm:flex grid  bg-blue-200 gap-2 sm:grid-cols-1">
                <div class=" p-4">
                    <div class=" w-full py-2 px-2  grid grid-cols-1 gap-2 sm:grid-cols-4">
                        <a href="/sesi-laporan-mahasiswa">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Sesi laporan Harian</div>
                        </a>
                        <a href="/rekap-laporan-mahasiswa">
                            <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Rekap laporan Harian</div>
                        </a>
                    </div>
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

</x-app-layout>