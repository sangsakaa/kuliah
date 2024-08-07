<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class=" w-full mt-2 px-2  ">
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





                    </div>

                </div>
            </div>
        </div>
        @endrole
        @role('mahasiswa')
        <style>
            .new-font {
                font-family: sans-serif;
            }
        </style>
        <div class=" grid grid-cols-1 sm:grid-cols-1 gap-2">
            <div class="  sm:flex grid  bg-sky-200 gap-2 sm:grid-cols-1">
                <div class=" p-4">
                    <p class=" font-serif ">Selamat Datang di </p>
                    <p class=" font-serif   text-4xl bold new-font "> SIP-K</p>
                    <p class=" font-serif sm:text-sm text-xs">(Sistem Informasi Pelaporan Kegiatan)</p>
                    <div>
                        @foreach($dataMhs as $detail)
                        <p class=" font-semibold">{{$detail->nama_mhs}} </p>
                        <p class=" text-sm">{{$detail->nim}} - {{$detail->prodi}}</p>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="  sm:flex grid  bg-sky-200 gap-2 sm:grid-cols-1">
                <div class=" p-4 capitalize">
                    <p>Note :</p>
                    <p>1. Jam pelaporan mulai dari 19:00 - 21:00 WIB</p>
                </div>
            </div>
            <div class=" ">
                <div class=" w-full  px-2  grid grid-cols-1 gap-2 sm:grid-cols-4">
                    @if (Auth::user()->hasRole('mahasiswa') && Auth::user()->hasRole('ketua kelompok'))
                    <div class="flex  gap-2 justify-center items-center">
                        <a href="/sesi-laporan-mahasiswa">
                            <div class=" flex bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <span class=" py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </span>
                                <span class=" py-1">
                                    laporan
                                </span>
                            </div>
                        </a>
                        <a href="/rekap-laporan-mahasiswa">
                            <div class=" flex  bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <span class=" py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                    </svg>

                                </span>
                                <span class=" py-1">
                                    Rekap
                                </span>
                            </div>
                        </a>
                        <a href="/sesi-harian">
                            <div class=" flex bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <span class=" py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                    </svg>

                                </span>
                                <span class=" py-1">
                                    Presensi
                                </span>
                            </div>
                    </div>
                    @elseif (Auth::user()->hasRole('mahasiswa'))
                    <div class="flex  gap-2 justify-center items-center">
                        <a href="/sesi-laporan-mahasiswa">
                            <div class=" flex w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <span class=" py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </span>
                                <span class=" py-1">
                                    Sesi laporan
                                </span>
                            </div>
                        </a>
                        <a href="/rekap-laporan-mahasiswa">
                            <div class=" flex w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                                <span class=" py-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                    </svg>

                                </span>
                                <span class=" py-1">
                                    Sesi laporan
                                </span>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="  sm:flex grid  bg-sky-200 gap-1 sm:grid-cols-1">
                <div class=" px-4 ">
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
                        {{Auth::user()->name}}
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

                    <div>
                        <!-- Tambahkan library Chart.js -->
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                        <!-- Buat elemen canvas untuk menampilkan grafik -->
                        <canvas id="grafikLaporan"></canvas>

                        <!-- Script untuk inisialisasi grafik -->

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