<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dosen') }}
        </h2>
    </x-slot>
    <div class=" w-full py-2 px-2 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white  border-gray-200">
                <div>
                    <div class=" w-full grid grid-cols-1 gap-2 sm:grid-cols-4">
                        @foreach($jenis_kelamin as $jenis_kelamin => $count)
                        <div class="w-full grid grid-cols-2 {{ $jenis_kelamin == 'L' ? 'bg-blue-800' : ($jenis_kelamin == 'P' ? 'bg-red-800' : '') }} text-white rounded-md">
                            <div class="px-4 py-2 grid grid-cols-1">
                                <div>Dosen {{ $jenis_kelamin == 'L' ? 'Putra' : 'Putri' }}</div>
                                <div>{{ $jenis_kelamin }} : {{ $count }}</div>
                            </div>
                            <div class="grid px-4 justify-items-end content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-bounding-box inline-block" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg>
                            </div>
                        </div>
                        @endforeach
                        <div class="w-full grid grid-cols-2 {{ $jenis_kelamin == 'L' ? 'bg-blue-800' : ($jenis_kelamin == 'P' ? 'bg-red-800' : '') }} text-white rounded-md">
                            <div class="px-4 py-2 grid grid-cols-1">
                                <div>Total Dosen </div>
                                <div> {{ $totalDosen }}</div>
                            </div>
                            <div class="grid px-4 justify-items-end content-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-bounding-box inline-block" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" px-2">
        <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
            <div class="flex justify-center items-center w-1   bg-green-800">
            </div>
            <div class=" w-full py-2  ">
                <div class=" font-semibold  ">
                    <div class=" px-2 ">
                        <div class=" mb-2 grid sm:grid-cols-2  ">
                            <div class=" flex content-end">
                                <a href="/Singkron-Dosen"><button class=" bg-blue-800 rounded-md text-white py-1 px-4 hover:bg-blue-400 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-arrow-repeat inline-block" viewBox="0 0 16 16">
                                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                        </svg> Singkronisasi</button></a>
                                <div class=" flex px-2">
                                    @if(session('success'))
                                    <div class=" bg-green-300 px-4 py-1 " id="success-alert">
                                        {{ session('success') }}
                                    </div>
                                    <script>
                                        setTimeout(function() {
                                            $('#success-alert').fadeOut('fast');
                                        }, 5000); // Timer selama 5 detik (5000 milidetik)
                                        // Tambahkan event listener untuk menghilangkan pesan sukses secara manual
                                        $('#success-alert').click(function() {
                                            $(this).fadeOut('fast');
                                        });
                                    </script>
                                    @endif
                                </div>
                            </div>
                            <div class=" grid justify-items-end content-end">
                                <form action="/data-Dosen" method="get">
                                    <input type="text" name="cari" value="{{ request('cari') }}" class=" border border-green-800 text-green-800 rounded-md py-1 px-4" placeholder=" Cari ..">
                                    <button type="submit" class="  bg-green-800 py-1 px-2 rounded-md text-white">
                                        Cari</button>
                                </form>
                            </div>
                        </div>
                        <div class="overflow-hidden mb-2 w-full rounded-lg border shadow-xs">
                            <div class="overflow-x-auto w-full">
                                <table class="    w-full table border">
                                    <thead class=" bg-gray-50">
                                        <tr class=" border bg-gray-50">
                                            <th class=" px-2 border text-center">No</th>
                                            <th class=" px-2 border text-center">NIDN</th>
                                            <th class=" px-2 border text-center">Nama</th>
                                            <th class=" px-2 border text-center">JK</th>
                                            <th class=" px-2 border text-center">Status</th>
                                            <th class=" px-2 border text-center">ACT</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listDosen as $dosen)
                                        <tr class=" border hover:bg-gray-50 text-sm even:bg-gray-100">
                                            <td class=" border text-center">{{ $loop->iteration }}</td>
                                            <td class=" border px-2 text-center ">{{ $dosen['nidn'] }}</td>
                                            <td class=" border   px-2">{{ $dosen['nama_dosen'] }}</td>
                                            <td class=" border   px-2 text-center">{{ $dosen['jenis_kelamin'] }}
                                            </td>
                                            <td class=" border text-center">{{ $dosen['nama_status_aktif'] }}</td>
                                            <td class=" text-center ">
                                                <form action="/data-Dosen/{{$dosen->id}}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button>Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class=" py-1 px-1">
                                    {{$listDosen}}
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



</x-app-layout>