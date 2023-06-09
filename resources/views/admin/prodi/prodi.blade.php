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
                        <div class=" w-full grid grid-cols-2 bg-red-500 text-white rounded-md">
                            <div class=" px-4 py-2 grid grid-cols-1">
                                <div>Dosen</div>
                                <div> Mhs </div>

                            </div>
                            <div class="grid  px-4  justify-items-end  content-center  "><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-bounding-box inline-block" viewBox="0 0 16 16">
                                    <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                </svg></div>
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
                                <!-- <label for="">DAFTAR DATA MAHASISWA</label> -->
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
                                            <th class=" px-2 border text-center">NO</th>
                                            <th class=" px-2 border text-center">KODE PRODI</th>
                                            <th class=" px-2 border text-center">PROGRAM STUDI</th>
                                            <th class=" px-2 border text-center">STATUS</th>
                                            <th class=" px-2 border text-center">JENJANG</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($listMahasiswa as $mahasiswa)
                                        <tr class=" border hover:bg-gray-50 text-sm">
                                            <td class=" border text-center">{{ $loop->iteration }}</td>
                                            <td class=" border px-2 text-center ">{{ $mahasiswa['kode_program_studi'] }}</td>
                                            <td class=" border   px-2">{{ $mahasiswa['nama_program_studi'] }}</td>
                                            <td class=" border   px-2 text-center">{{ $mahasiswa['status'] }}
                                            </td>
                                            <td class=" border text-center">{{ $mahasiswa['nama_jenjang_pendidikan'] }}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



</x-app-layout>