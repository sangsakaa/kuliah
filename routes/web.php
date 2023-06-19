<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\KelompokController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\LaporanMahasiswaController;
use App\Http\Controllers\UserDosenController;
use App\Http\Controllers\UserManagemetController;
use App\Http\Controllers\UserPerMhsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/setting', [MahasiswaController::class, 'index'])->middleware(['auth'])->name('setting');
Route::get('/mahasiswa', [MahasiswaController::class, 'dataMahahsiswa'])->middleware(['auth'])->name('mahasiswa');
Route::get('/sinkronisasi', [MahasiswaController::class, 'sinkronisasi']);
Route::get('/cek-nim-ganda', [MahasiswaController::class, 'deteksiDuplikasi']);
// Route::get('/dosen-get', [DosenController::class, 'index'])->middleware(['auth']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');
// dosen
Route::get('/Singkron-Dosen', [DosenController::class, 'SingkronDosen'])->middleware(['auth']);
Route::get('/data-Dosen', [DosenController::class, 'dataDosen'])->middleware(['auth'])->name('data-Dosen');
Route::delete('/data-Dosen/{dosen}', [DosenController::class, 'Destroy'])->middleware(['auth']);
Route::get('/export-excel', [MahasiswaController::class, 'exportExcel'])->middleware(['auth']);
// Program Studi
Route::get('/Singkron-Prodi', [ProdiController::class, 'SingkronProdi'])->middleware(['auth']);
Route::get('/data-Prodi', [ProdiController::class, 'dataProdi'])->middleware(['auth']);
Route::get('/get-test', [TestingController::class, 'sinkronisasi']);



// LAPORAN MAHASISWA
Route::get('/laporan-mahasiswa', [LaporanMahasiswaController::class, 'LaporanDataMahasiswa']);
// userManajement
Route::get('/data-user', [UserManagemetController::class, 'UserAdmin'])->middleware(['auth'])->name('data-user');
Route::post('/create-user', [UserManagemetController::class, 'CreateUserAdmin'])->middleware(['auth']);
Route::post('/create-user-dosen', [UserManagemetController::class, 'CreateUserDosen'])->middleware(['auth']);



// 

Route::get('/akun-mahasiswa', [UserPerMhsController::class, 'User'])->middleware(['auth'])->name('akun-mahasiswa');
// sesiLap
Route::get('/sesi-laporan-mahasiswa', [UserPerMhsController::class, 'sesiLap'])->middleware(['auth'])->name('sesi-laporan-mahasiswa');
Route::post('/sesi-laporan-mahasiswa', [UserPerMhsController::class, 'createSesiLap'])->middleware(['auth'])->name('sesi-laporan-mahasiswa');
Route::get('/laporan-mahasiswa/{sesi_Laporan_Harian}', [UserPerMhsController::class, 'laporan'])->middleware(['auth'])->name('laporan-mahasiswa');
Route::post('/laporan-mahasiswa/{sesi_Laporan_Harian}', [UserPerMhsController::class, 'BuatLap'])->middleware(['auth']);


Route::get('/rekap-laporan-mahasiswa', [UserPerMhsController::class, 'RekapLapHarian'])->middleware(['auth'])->name('rekap-laporan-mahasiswa');
Route::get('/unduh-file/{sesi_Laporan_Harian}', [UserPerMhsController::class, 'unduhFile'])->middleware(['auth'])->name('unduh-file');







// User Dosen

Route::get('/sesi-validasi-laporan-mhs', [UserDosenController::class, 'validasiLaporan'])->middleware(['auth'])->name('sesi-validasi-laporan-mhs');
Route::get('/daftar-validasi-laporan-mhs/{sesi_Laporan_Harian}', [UserDosenController::class, 'DaftaValidasi'])->middleware(['auth'])->name('daftar-validasi-laporan-mhs');
Route::get('/data-anggota', [UserDosenController::class, 'dataAnggota'])->middleware(['auth'])->name('data-anggota');
Route::get('/time-line', [UserDosenController::class, 'timeLine'])->middleware(['auth'])->name('time-line');

// LAPORAN
Route::get('/laporan-harian-mahasiswa', [LaporanController::class, 'LaporanMahasiswa'])->middleware(['auth'])->name('laporan-harian-mahasiswa');



// KELOMPOK
Route::get('/kelompok-mahasiswa', [KelompokController::class, 'index'])->middleware(['auth'])->name('kelompok-mahasiswa');
Route::post('/kelompok-mahasiswa', [KelompokController::class, 'store']);
Route::get('/detail-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'view'])->middleware(['auth']);
Route::get('/kolektif-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'insert']);
Route::post('/kolektif-kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'storeAnggota']);
Route::delete('/detail-kelompok-mahasiswa/{anggota_Kelompok}', [KelompokController::class, 'DestroAnggota']);
Route::delete('/kelompok-mahasiswa/{kelompok}', [KelompokController::class, 'destroy']);


require __DIR__ . '/auth.php';
