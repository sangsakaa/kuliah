<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mahasiswa') }}
        </h2>
    </x-slot>
    <div class=" w-full py-2 px-2 ">
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
                        <div class=" w-full grid grid-cols-2 bg-yellow-500 text-white rounded-md">
                            <div class=" px-4 py-2 grid grid-cols-1">
                                <div>Total Mahasiswa</div>
                                <div>{{ $total }} Mhs </div>

                            </div>
                            <div class=" grid  px-4  justify-items-end  content-center  "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-bounding-box inline-block" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg></div>
                        </div>
                        <div class=" w-full grid grid-cols-2 bg-blue-500 text-white rounded-md">
                            <div class=" px-4 py-4 grid grid-cols-1">
                                <div>Total Kelulusan</div>
                                <div>{{ $lulus }} Mhs</div>
                            </div>
                            <div class=" grid  px-4  justify-items-end  content-center ">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-mortarboard-fill inline-block" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
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
                            <div class=" grid content-end">
                                <a href="/export-excel">Export Excel</a>
                            </div>
                            <div class=" grid justify-items-end content-end">
                                <form action="/mahasiswa" method="get">
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
                                            <th class=" px-2 border text-center">#</th>
                                            <th class=" px-2 border text-center">NIM</th>
                                            <th class=" px-2 border text-center">Nama</th>
                                            <th class=" px-2 border text-center">JK</th>
                                            <th class=" px-2 border text-center">Tanggal Lahir</th>
                                            <th class=" px-2  border text-center"> Agama</th>
                                            <th class="  border text-center">Program Studi</th>
                                            <th class=" px-2 border text-center">Angkatan</th>

                                            <th class=" px-2 border text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listMahasiswa as $mahasiswa)
                                        <tr class=" border hover:bg-gray-50 text-sm">
                                            <td class=" border text-center">{{ $loop->iteration }}</td>
                                            <td class=" border px-2 text-center ">{{ $mahasiswa['nim'] }}</td>
                                            <td class=" border   px-2">{{ $mahasiswa['nama_mhs'] }}</td>
                                            <td class=" border   px-2 text-center">{{ $mahasiswa['jenis_kelamin'] }}
                                            </td>
                                            <td class=" border   px-2 text-center">{{ $mahasiswa['tgl_lahir'] }}</td>
                                            <td class=" border text-center">{{ $mahasiswa['agama'] }}</td>
                                            <td class=" border text-center">{{ $mahasiswa['prodi'] }}</td>
                                            <td class=" border text-center">{{ $mahasiswa['periode_masuk'] }}</td>

                                            <td class=" border text-center">
                                                @if($mahasiswa['status'] == 'Lulus')
                                                <div class=" text-red-700">
                                                    {{ $mahasiswa['status'] }}
                                                </div>
                                                @else($mahasiswa['status']= 'AKTIF')
                                                <div class=" text-green-700">
                                                    {{ $mahasiswa['status'] }}
                                                </div>

                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class=" p-1">
                                    {{$listMahasiswa->links()}}
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