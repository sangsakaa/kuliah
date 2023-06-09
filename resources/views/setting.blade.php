<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengaturan Umum') }}
        </h2>
    </x-slot>
    <div class=" w-full py-2 px-2 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white  border-gray-200">
                <div>
                    <div class=" w-full grid grid-cols-1 gap-2 sm:grid-cols-4">
                        <div class=" w-full grid grid-cols-2 bg-red-500 text-white rounded-md">
                            <div class=" px-4 py-4 grid grid-cols-1">
                                <div>Total Aktif</div>
                                <div>{{ $total }} Mhs</div>
                            </div>
                            <div class=" py-6 px-4 text-right "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-bounding-box inline-block" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg></div>
                        </div>
                        <div class=" h-50 grid grid-cols-2 bg-blue-500 text-white rounded-md">
                            <div class=" px-4 py-4 grid grid-cols-1">
                                <div>Total Aktif</div>
                                <div>{{ $total }} Mhs</div>
                            </div>
                            <div class=" py-6 px-4 text-right "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-mortarboard-fill inline-block" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
                                </svg></div>
                        </div>
                        <div class=" h-50 grid grid-cols-2 bg-blue-500 text-white rounded-md">
                            <div class=" px-4 py-4 grid grid-cols-1">
                                <div>Total Aktif</div>

                            </div>
                            <div class=" py-6 px-4 text-right "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-mortarboard-fill inline-block" viewBox="0 0 16 16">
                                    <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z" />
                                    <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z" />
                                </svg></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" w-full py-2 px-2 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white  border-gray-200">
                <div>

                    <a href="/sinkronisasi"><button class=" bg-blue-800 rounded-md text-white py-1 px-4 hover:bg-blue-400 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-arrow-repeat inline-block" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                            </svg> Singkronisasi</button></a>
                    <a href="/cek-nim-ganda"><button class=" bg-red-600 rounded-md text-white py-1 px-4 hover:bg-blue-400 ">
                            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="currentColor" class="bi bi-arrow-repeat inline-block" viewBox="0 0 16 16">
                                <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                            </svg> Cek Nim Ganda</button></a>


                    <table class=" w-full  mt-2   table border">
                        <thead class=" bg-gray-50">
                            <tr class=" border bg-gray-50">
                                <th class=" px-2 border text-center">#</th>
                                <th class=" px-2 border text-center">NIM</th>
                                <th class=" px-2 border text-center">Nama</th>
                                <th class=" px-2 border text-center">JK</th>
                                <th class=" px-2  border text-center"> Agama</th>
                                <th class="  border text-center">Program Studi</th>
                                <th class=" px-2 border text-center">Angkatan</th>
                                <th class=" px-2 border text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listMahasiswa as $mahasiswa)
                            <tr class=" border hover:bg-gray-50">
                                <td class=" border text-center">{{ $loop->iteration }}</td>
                                <td class=" border px-2 ">{{ $mahasiswa['nim'] }}</td>
                                <td class=" border   px-2">{{ $mahasiswa['nama_mahasiswa'] }}</td>
                                <td class=" border   px-2 text-center">{{ $mahasiswa['jenis_kelamin'] }}</td>
                                <td class=" border text-center">{{ $mahasiswa['nama_agama'] }}</td>
                                <td class=" border text-center">{{ $mahasiswa['nama_program_studi'] }}</td>
                                <td class=" border text-center">{{ $mahasiswa['id_periode'] }}</td>
                                <td class=" border text-center">
                                    @if($mahasiswa['nama_status_mahasiswa'] == 'Lulus')
                                    <div class=" text-red-700">
                                        {{ $mahasiswa['nama_status_mahasiswa'] }}
                                    </div>
                                    @else($mahasiswa['nama_status_mahasiswa']= 'AKTIF')
                                    <div class=" text-green-700">
                                        {{ $mahasiswa['nama_status_mahasiswa'] }}
                                    </div>

                                    @endif
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>