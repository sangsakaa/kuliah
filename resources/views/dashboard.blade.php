<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>
    <div class=" w-full py-2 px-2 ">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4 bg-white  border-gray-200">
                @role('super admin')
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
                @endrole
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
                            @role('super admin')
                            <div class=" grid justify-items-end content-end">
                                <form action="/mahasiswa" method="get">
                                    <input type="text" name="cari" value="{{ request('cari') }}" class=" border border-green-800 text-green-800 rounded-md py-1 px-4" placeholder=" Cari ..">
                                    <button type="submit" class="  bg-green-800 py-1 px-2 rounded-md text-white">
                                        Cari</button>
                                </form>
                            </div>
                            @endrole
                        </div>
                        <div class="mb-2 w-full  ">
                            <div class=" text-center">
                                @role('mahasiswa')
                                <p class=" capitalize">Selamat datang di </p>
                                <p class="  text-9xl bold "> SPK</p>
                                <p class=" sm:text-sm text-xs">(Sistem Pelaporan Kegiatan)</p>

                                <div>
                                    @foreach($data as $detail)
                                    <p>{{$detail->nama_mhs}}</p>
                                    <p class=" text-sm">{{$detail->nim}}</p>
                                    {{$detail->prodi}} ({{$detail->jenis_kelamin}})
                                    @endforeach
                                </div>
                                @endrole
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" px-2">
        <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
            <div class="flex justify-center items-center w-1   bg-green-800"></div>
            @role('mahasiswa')
            <div class=" w-full py-2 px-2  grid grid-cols-1 gap-2 sm:grid-cols-4">
                <a href="/sesi-laporan-mahasiswa">
                    <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">Sesi laporan Harian</div>
                </a>
            </div>
            @endrole
            @role('dosen')
            <div class=" w-full py-2 px-2  grid grid-cols-1 gap-2 sm:grid-cols-4">
                <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">
                    <a href="/sesi-validasi-laporan-mhs">
                        <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase"> Laporan Harian Mahasiswa</div>
                    </a>
                </div>

                <div class=" w-full bg-blue-800 px-2 py-1 text-white text-center uppercase">presensi</div>
            </div>
            @endrole
        </div>

    </div>
    </div>




</x-app-layout>