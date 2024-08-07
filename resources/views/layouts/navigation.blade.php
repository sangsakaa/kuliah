<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 ">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
        <div class="flex justify-between h-16 ">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="dashboard">
                        <x-application-logo class=" block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>
                <!-- Navigation Links -->
                @role('super admin')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('mahasiswa')" :active="request()->routeIs('mahasiswa')">
                        {{ __('Data Mahasiswa') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('data-Dosen')" :active="request()->routeIs('data-Dosen')">
                        {{ __('Data Dosen') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('kabupaten')" :active="request()->routeIs('kabupaten')">
                        {{ __('Lokasi') }}
                    </x-nav-link>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if(Auth::check())
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Screening</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Guest</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @endif
                        </x-slot>
                        <x-slot name="content">
                            <!-- Authentication -->
                            <div>
                                <x-dropdown-link :href="route('form-screening-mahasiswa')" :active="request()->routeIs('form-screening-mahasiswa')">
                                    {{ __('Form Screening') }}
                                </x-dropdown-link>
                            </div>
                            <div>
                                <x-dropdown-link :href="route('daftar-screening-mahasiswa')" :active="request()->routeIs('daftar-screening-mahasiswa')">
                                    {{ __('Daftar Screening ') }}
                                </x-dropdown-link>
                            </div>
                            <div>
                                <x-dropdown-link :href="route('validasi-screening')" :active="request()->routeIs('validasi-screening')">
                                    {{ __('Validasi Dokumen Screening') }}
                                </x-dropdown-link>
                            </div>
                        </x-slot>
                    </x-dropdown>
                </div>


                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if(Auth::check())
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Laporan</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Guest</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @endif
                        </x-slot>
                        <x-slot name="content">
                            <!-- Authentication -->
                            <div>
                                <x-dropdown-link :href="route('laporan-harian-mahasiswa')" :active="request()->routeIs('laporan-harian-mahasiswa')">
                                    {{ __('Laporan') }}
                                </x-dropdown-link>
                            </div>
                            <div>
                                <x-dropdown-link :href="route('kelompok-mahasiswa')" :active="request()->routeIs('kelompok-mahasiswa')">
                                    {{ __('Data Kelompok') }}
                                </x-dropdown-link>
                            </div>
                            <div>
                                <x-dropdown-link :href="route('setting')" :active="request()->routeIs('setting')">
                                    {{ __('Setting') }}
                                </x-dropdown-link>
                            </div>

                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if(Auth::check())
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Pengaturan</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>Guest</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @endif
                        </x-slot>
                        <x-slot name="content">
                            <!-- Authentication -->

                            <div>
                                <x-dropdown-link :href="route('periode-semester')" :active="request()->routeIs('periode-semester')">
                                    {{ __('Pengaturan Periode') }}
                                </x-dropdown-link>
                            </div>
                            <div>
                                <x-dropdown-link :href="route('data-user')" :active="request()->routeIs('data-user')">
                                    {{ __('User Management') }}
                                </x-dropdown-link>
                            </div>
                            <div>
                                <x-dropdown-link :href="route('setting')" :active="request()->routeIs('setting')">
                                    {{ __('Setting') }}
                                </x-dropdown-link>
                            </div>

                        </x-slot>
                    </x-dropdown>
                </div>
                @endrole
                @if (Auth::check())
                @if (Auth::user()->hasRole('mahasiswa') && Auth::user()->hasRole('ketua kelompok'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sesi-laporan-mahasiswa')" :active="request()->routeIs('sesi-laporan-mahasiswa')">
                        {{ __('Laporan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rekap-laporan-mahasiswa')" :active="request()->routeIs('rekap-laporan-mahasiswa')">
                        {{ __('Rekap Laporan ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sesi-harian')" :active="request()->routeIs('sesi-harian')">
                        {{ __('Presensi ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('detail-lap-mhs')" :active="request()->routeIs('detail-lap-mhs')">
                        {{ __('Detail Laporan ') }}
                    </x-nav-link>
                </div>
                @elseif (Auth::user()->hasRole('mahasiswa'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sesi-laporan-mahasiswa')" :active="request()->routeIs('sesi-laporan-mahasiswa')">
                        {{ __('Laporan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rekap-laporan-mahasiswa')" :active="request()->routeIs('rekap-laporan-mahasiswa')">
                        {{ __('Rekap Laporan ') }}
                    </x-nav-link>
                    <x-nav-link :href="route('detail-lap-mhs')" :active="request()->routeIs('detail-lap-mhs')">
                        {{ __('Detail Laporan ') }}
                    </x-nav-link>
                </div>
                @endif
                @endif
                @if (Auth::check())
                @if (Auth::user()->hasRole('validator'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('daftar-screening-mahasiswa')" :active="request()->routeIs('daftar-screening-mahasiswa')">
                        {{ __('Validasi Perserta') }}
                    </x-nav-link>
                    <x-nav-link :href="route('validasi-screening')" :active="request()->routeIs('validasi-screening')">
                        {{ __('Validasi File') }}
                    </x-nav-link>
                </div>
                @endif
                @endif

                @if (Auth::check())
                @if (Auth::user()->hasRole('pengawas'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cek-laporan')" :active="request()->routeIs('cek-laporan')">
                        {{ __('Cek Laporan Harian') }}
                    </x-nav-link>
                </div>
                @elseif (Auth::user()->hasRole('dosen'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('sesi-validasi-laporan-mhs')" :active="request()->routeIs('sesi-validasi-laporan-mhs')">
                        {{ __('Validasi Laporan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('data-anggota')" :active="request()->routeIs('data-anggota')">
                        {{ __('Data Anggota') }}
                    </x-nav-link>
                    <x-nav-link :href="route('time-line')" :active="request()->routeIs('time-line')">
                        {{ __('Time Line') }}
                    </x-nav-link>
                    <x-nav-link :href="route('supervisi-dosen')" :active="request()->routeIs('supervisi-dosen')">
                        {{ __('Supervisi') }}
                    </x-nav-link>
                    <x-nav-link :href="route('daftar-nilai')" :active="request()->routeIs('daftar-nilai')">
                        {{ __('Score') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rekap-laporan-mhs')" :active="request()->routeIs('rekap-laporan-mhs')">
                        {{ __('Cek Lap') }}
                    </x-nav-link>
                </div>
                @elseif (Auth::user()->hasRole('siaca'))
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cek-valid-dosen')" :active="request()->routeIs('cek-valid-dosen')">
                        {{ __('Validasi Dosen') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cek-laporan')" :active="request()->routeIs('cek-laporan')">
                        {{ __('Laporan Harian') }}
                    </x-nav-link>
                    <x-nav-link :href="route('score-dosen')" :active="request()->routeIs('score-dosen')">
                        {{ __('Score') }}
                    </x-nav-link>
                    <x-nav-link :href="route('cek-kualitas-fix')" :active="request()->routeIs('cek-kualitas-fix')">
                        {{ __('Lap Valid') }}
                    </x-nav-link>
                    <x-nav-link :href="route('rekap-sesi-harian')" :active="request()->routeIs('rekap-sesi-harian')">
                        {{ __('Rekap Presensi') }}
                    </x-nav-link>
                </div>
                @endif
                @endIf
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if(Auth::check())
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        @else
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>Guest</div>
                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                        @endif
                    </x-slot>
                    <x-slot name="content">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                    </x-slot>
                </x-dropdown>
            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @if(auth()->check())
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @else
                <div class="font-medium text-base text-gray-800">Guest</div>
                <div class="font-medium text-sm text-gray-500">You are not logged in.</div>
                @endif

            </div>
            <div class="mt-3 space-y-1">
                @if (Auth::check())
                @if (Auth::user()->hasRole('mahasiswa') && Auth::user()->hasRole('ketua kelompok'))
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sesi-laporan-mahasiswa')" :active="request()->routeIs('sesi-laporan-mahasiswa')">
                    {{ __('Laporan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rekap-laporan-mahasiswa')" :active="request()->routeIs('rekap-laporan-mahasiswa')">
                    {{ __('Rekap Laporan ') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sesi-harian')" :active="request()->routeIs('sesi-harian')">
                    {{ __('Presensi ') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('detail-lap-mhs')" :active="request()->routeIs('detail-lap-mhs')">
                    {{ __('Detail Laporan ') }}
                </x-responsive-nav-link>
                @elseif (Auth::user()->hasRole('mahasiswa'))
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sesi-laporan-mahasiswa')" :active="request()->routeIs('sesi-laporan-mahasiswa')">
                    {{ __('Detail Mahasiswa') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('rekap-laporan-mahasiswa')" :active="request()->routeIs('rekap-laporan-mahasiswa')">
                    {{ __('Rekap Laporan ') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('detail-lap-mhs')" :active="request()->routeIs('detail-lap-mhs')">
                    {{ __('Detail Laporan ') }}
                </x-responsive-nav-link>
                @endif
                @endif
                @if (Auth::check())
                @if (Auth::user()->hasRole('dosen') )
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    {{ __('Beranda') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('sesi-validasi-laporan-mhs')" :active="request()->routeIs('sesi-validasi-laporan-mhs')">
                    {{ __('Validasi Laporan') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('data-anggota')" :active="request()->routeIs('data-anggota')">
                    {{ __('Data Anggota Kelompok') }}
                </x-responsive-nav-link>


                @endif
                @endif
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>